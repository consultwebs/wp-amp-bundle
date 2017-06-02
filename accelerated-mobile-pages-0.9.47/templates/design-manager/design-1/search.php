<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php $paged = get_query_var( 'paged' );
		$current_search_url =trailingslashit(get_home_url())."?s=".get_search_query();
		$amp_url = untrailingslashit($current_search_url);
		if ($paged > 1 ) {
			global $wp;
			$current_archive_url 	= home_url( $wp->request );
			$amp_url 				= trailingslashit($current_archive_url);
			$remove 				= '/'. AMPFORWP_AMP_QUERY_VAR;
			$amp_url				= str_replace($remove, '', $amp_url) ;
			$amp_url 				= $amp_url ."?s=".get_search_query();
		} ?>
	<link rel="canonical" href="<?php echo $amp_url ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?> design_1_wrapper">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

<?php do_action('ampforwp_post_before_loop') ?>
	<?php
		if ( get_query_var( 'paged' ) ) {
	        $paged = get_query_var('paged');
	    } elseif ( get_query_var( 'page' ) ) {
	        $paged = get_query_var('page');
	    } else {
	        $paged = 1;
	    }

	    $exclude_ids = get_option('ampforwp_exclude_post');

		$q = new WP_Query( array(
			's' 				  => get_search_query() ,
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' 		  => false ,
			'post_status'		  => 'publish'
		) ); ?>

 		<h3 class="amp-wp-content page-title"><?php echo $redux_builder_amp['amp-translator-search-text'] . '  ' . get_search_query();?>  </h3>

 		<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();
		$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR ; ?>

	        <div class="amp-wp-content amp-wp-article-header amp-loop-list">

		        <h1 class="amp-wp-title">
		            <?php  $ampforwp_post_url = get_permalink(); ?>
		            <a href="<?php  echo trailingslashit( trailingslashit( $ampforwp_post_url ) . AMPFORWP_AMP_QUERY_VAR );?>"><?php the_title() ?></a>
		        </h1>

				<div class="amp-wp-content-loop">

		          <div class="amp-wp-meta">
						<time> <?php printf( _x( '%1$s '. $redux_builder_amp['amp-translator-ago-date-text'], '%2$s = human-readable time difference', 'wpdocs_textdomain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?> </time>
		          </div>

					<?php if ( has_post_thumbnail() ) { ?>
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
						$thumb_url = $thumb_url_array[0];
						?>
						<div class="home-post-image">
							<a href="<?php  echo trailingslashit( trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR );?>">
								<amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img>
							</a>
						</div>
					<?php }
						if( has_excerpt() ){
							$content = get_the_excerpt();
						}else{
							$content = get_the_content();
						} ?>
					<p><?php echo wp_trim_words( strip_shortcodes( $content ) , '20'); ?></p>
				</div>
	        </div>
	    <?php endwhile;  ?>
		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		            <div class="next"><?php next_posts_link( $redux_builder_amp['amp-translator-next-text']. ' &raquo;', 0 ) ?></div>
		            <div class="prev"><?php previous_posts_link( '&laquo; '. $redux_builder_amp['amp-translator-previous-text'] ); ?></div>
		            <div class="clearfix"></div>
		        </div>

		    </div>
		<?php else: ?>
			<div class="amp-wp-content amp-wp-article-header amp-loop-list">
				<?php echo $redux_builder_amp['amp-translator-search-no-found']; ?>
				<div class="cb"></div>
			</div>
		<?php endif; ?> <?php wp_reset_postdata(); ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>