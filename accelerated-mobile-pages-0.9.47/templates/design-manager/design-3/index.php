<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php
	if ( is_home() || is_front_page()  || ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) ){
		global $wp;
		$current_archive_url = home_url( $wp->request );
		$amp_url 	= trailingslashit($current_archive_url);
		$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
		$amp_url 	= str_replace($remove, '', $amp_url) ;
	} ?>
	<link rel="canonical" href="<?php echo $amp_url ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="amp_home_body design_3_wrapper">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<div class="amp-wp-content">
	<?php do_action('ampforwp_area_above_loop'); ?>
</div>

<?php do_action( 'ampforwp_after_header', $this );

if ( get_query_var( 'paged' ) ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var( 'page' ) ) {
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

 ?>

<?php global $redux_builder_amp; if( $redux_builder_amp['amp-design-3-featured-slider'] == 1 && $paged === 1 ) { ?>
		<div class="amp-featured-wrapper">
		<div class="amp-featured-area">
		  <amp-carousel width="450"
		      height="270" layout="responsive"
		      type="slides" autoplay
		      delay="4000">
		<?php
		  global $redux_builder_amp;
		  if( $redux_builder_amp['amp-design-3-category-selector'] ){
		    $args = array(
		                   'cat' => $redux_builder_amp['amp-design-3-category-selector'],
		                   'posts_per_page' => 4,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		  } else {
		    //if user does not give a category
		    $args = array(
		                   'posts_per_page' => 4,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		  }

		   $category_posts = new WP_Query($args);
		   if($category_posts->have_posts()) :
		      while($category_posts->have_posts()) :
		         $category_posts->the_post();
		?>
		      <div>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium_large', true);
						$thumb_url = $thumb_url_array[0];
						?>
						 <amp-img src=<?php echo $thumb_url ?> width=450 height=270></amp-img>
					<?php } ?>
                  <a href="<?php trailingslashit( trailingslashit( the_permalink() ) ."amp" ); ?>">
                  <div class="featured_title">
		            <div class="featured_time"><?php global $redux_builder_amp; echo human_time_diff( get_the_time('U'), current_time('timestamp') ) .' '. $redux_builder_amp['amp-translator-ago-date-text']; ?></div>
		            <h1><?php the_title() ?></h1>
		        </div>
                  </a>
		      </div>
		<?php endwhile; else: ?><?php endif; ?>
		  </amp-carousel>
		</div>
		</div>
<?php } ?>
<?php do_action('ampforwp_home_above_loop') ?>
<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php

	    $exclude_ids = get_option('ampforwp_exclude_post');

		$q = new WP_Query( array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' => false,
			'post_status'=> 'publish'
		) ); ?>

	<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();
		$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR ; ?>

		<div class="amp-wp-content amp-loop-list <?php if ( has_post_thumbnail() ) { } else{?>amp-loop-list-noimg<?php } ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
				$thumb_url = $thumb_url_array[0];
				?>
				<div class="home-post_image">
					<a href="<?php echo esc_url( trailingslashit( $ampforwp_amp_post_url ) ); ?>">
						<amp-img
							layout="responsive"
							src=<?php echo $thumb_url ?>
							width=450
							height=270
						></amp-img>
					</a>
				</div>
			<?php } ?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { ?>
					    <li><?php echo $category->cat_name ?></li>
					<?php } ?>
                </ul>
				<h2 class="amp-wp-title"> <a href="<?php echo esc_url( trailingslashit( $ampforwp_amp_post_url ) ); ?>"> <?php the_title(); ?></a></h2>


				<?php
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
				?>
		        <p><?php echo wp_trim_words( strip_shortcodes( $content ) , '15' ); ?></p>
                <div class="featured_time"><?php global $redux_builder_amp ; echo human_time_diff( get_the_time('U'), current_time('timestamp') ) .' '. $redux_builder_amp['amp-translator-ago-date-text']; ?></div>

		    </div>
            <div class="cb"></div>
	</div>

	<?php endwhile;  ?>

	<div class="amp-wp-content pagination-holder">

		<div id="pagination">
			<div class="next"><?php next_posts_link( $redux_builder_amp['amp-translator-show-more-posts-text'] , 0 ) ?></div>
					<?php if ( $paged > 1 ) { ?>
						<div class="prev"><?php previous_posts_link( $redux_builder_amp['amp-translator-show-previous-posts-text'] ); ?></div>
					<?php } ?>
			<div class="clearfix"></div>
		</div>
	</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</main>
<?php do_action('ampforwp_home_below_loop') ?>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>