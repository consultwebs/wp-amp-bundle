<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
<?php
$featured_image = $this->get( 'featured_image' );
if ( empty( $featured_image ) ) {
	return;
}

$amp_html = $featured_image['amp_html'];
$caption = $featured_image['caption'];
?><div class="post-featured-img">
<figure class="amp-wp-article-featured-image wp-caption">
	<?php echo $amp_html; // amphtml content; no kses ?>
	<?php if ( $caption ) : ?>
		<p class="wp-caption-text">
			<?php echo wp_kses_data( $caption ); ?>
		</p>
	<?php endif; ?>
</figure>
</div></div>