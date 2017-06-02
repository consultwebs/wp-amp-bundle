<div class="amp-wp-article-content"> <?php

	do_action('ampforwp_inside_post_content_before');
		$amp_custom_content_enable = get_post_meta( $this->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);

		// Normal Front Page Content
		if ( ! $amp_custom_content_enable ) {
			echo $this->get( 'post_amp_content' ); // amphtml content; no kses
		} else {
			// Custom/Alternative AMP content added through post meta
			echo $this->get( 'ampforwp_amp_content' );
		}

	do_action('ampforwp_inside_post_content_after') ?>

	<!--Post Next-Previous Links-->
	<?php global $redux_builder_amp;
		if($redux_builder_amp['enable-single-next-prev']) { ?>
			<!--IF Starts here-->
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">

					<!--Next Link code-->
					<div class="next">
						<?php $next_post = get_next_post();
							if (!empty( $next_post )) {
								$next_text = $next_post->post_title;
								?>
									<a href="<?php echo trailingslashit( trailingslashit( get_permalink( $next_post->ID ) ) . AMPFORWP_AMP_QUERY_VAR ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
								} ?>
					</div>
					<!--Next Link code-->

					<!--Prev Link code-->
					<div class="prev">
							<?php $prev_post = get_previous_post();
								 if (!empty( $prev_post )) {
									 $prev_text = $prev_post->post_title;
									  ?>
								   <a href="<?php echo trailingslashit( trailingslashit( get_permalink( $prev_post->ID ) ). AMPFORWP_AMP_QUERY_VAR ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php
								 } ?>
					</div>
					<!--Prev Link code-->

					<!--Clearfix code-->
					<div class="clearfix"></div>
					<!--Clearfix code-->

				</div>
			</div>
			<!--IF Ends here-->
		<?php } ?>
	<!--Post Next-Previous Links End here-->

</div>
