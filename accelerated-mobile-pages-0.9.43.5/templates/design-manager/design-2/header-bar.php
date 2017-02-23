<header class="container">
  <div id="headerwrap">
      <div id="header">

        <?php global $redux_builder_amp;

          if ($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']) {
            $ampforwp_home_url = untrailingslashit( get_bloginfo('url') ).'?nonamp=1';
            }else{ global $redux_builder_amp;   if($redux_builder_amp['ampforwp-homepage-on-off-support']) {
              $ampforwp_home_url = trailingslashit( get_bloginfo('url') ) . AMP_QUERY_VAR;
            } else {
              $ampforwp_home_url = trailingslashit( get_bloginfo('url') ) .'?nonamp=1';
            }
          }
        ?>

        <?php if ( true == ($redux_builder_amp['opt-media']['url']) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>">

            <?php if($redux_builder_amp['ampforwp-custom-logo-dimensions'] == true)  { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="<?php echo $redux_builder_amp['opt-media-width']; ?>" height="<?php echo $redux_builder_amp['opt-media-height']; ?>" alt="logo" class="amp-logo"></amp-img>

            <?php } else { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>

            <?php } ?>

          </a>
        <?php } else { ?>
          <h3><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"><?php bloginfo('name'); ?></a></h3>
        <?php } ?>

      </div>
  </div>
</header>


<div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo esc_html( $redux_builder_amp['amp-translator-navigate-text'] ); ?></a>
</div>


<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
  </div>
</amp-sidebar>
