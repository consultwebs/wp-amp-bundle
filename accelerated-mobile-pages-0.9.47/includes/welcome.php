<?php
add_action( 'admin_init', 'ampforwp_welcome_screen_do_activation_redirect' );
function ampforwp_welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( 'ampforwp_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( 'ampforwp_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to welcome page
  wp_safe_redirect( add_query_arg( array( 'page' => 'ampforwp-welcome-page' ), admin_url( 'index.php' ) ) );
}

add_action( 'admin_init', 'ampforwp_welcome_screen_do_activation_redirect_parent' );
function ampforwp_welcome_screen_do_activation_redirect_parent() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );

	// Bail if option is already set or plugin is deactivated
	if ( get_option( 'ampforwp_parent_plugin_check' ) || $amp_plugin_activation_check == false ) {
		return;
	}

	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}

	// Redirect to welcome page
	wp_safe_redirect( add_query_arg( array( 'page' => 'ampforwp-welcome-page' ), admin_url( 'index.php' ) ) );

 	update_option( 'ampforwp_parent_plugin_check', true );
}

add_action('admin_menu', 'ampforwp_welcome_screen_pages');

function ampforwp_welcome_screen_pages() {
  add_dashboard_page(
    'Welcome To AMPforWP plugin',
    'Welcome to AMP',
    'read',
    'ampforwp-welcome-page',
    'ampforwp_welcome_screen_content'
  );
}

function ampforwp_welcome_screen_content() {
  ?>
  	<div class="wrap">
	    <?php echo ampforwp_plugin_parent_activation(); ?>

	    <div class="clear"></div>

	    <div class="ampforwp-post-installtion-instructions">

		    <h1 style="color:#388E3C;font-weight:500"><i class="dashicons dashicons-yes"></i>AMP is now Installed!</h1>
			<p style=" font-family: georgia; font-size: 20px; font-style: italic; margin-bottom: 3px; line-height: 1.5; color: #666;">Thank you so much for installing the AMPforWP plugin!</p>
			<p style="font-family: georgia;font-size: 20px;margin-top: 4px;font-style: italic;line-height: 1.5;color: #666;">Our team works really hard to deliver good user experience to you.</p>
<div class="install_options">
    <div class="install_options_left">
        <p style="margin-top:0;margin-bottom:0;font-size: 15px;line-height: 1;"><b>Head Over to Settings</b></p>
        <p style="margin-top: 8px;margin-bottom:0px;">Time to customize the your AMP!</p>
    </div>
    <div class="install_options_right">
        <a href="<?php echo esc_url( admin_url('admin.php?page=amp_options') );?>">AMP Options Panel</a>
    </div>
    <div class="clear"></div>
</div>



		    <h1 style="color: #303F9F;font-weight: 500;margin-top: 48px;">
		    	<i class="dashicons dashicons-editor-help" style="font-size: 36px; margin-right: 20px; margin-top: -1px;"></i>Need Help?
		    </h1>
			<p style="font-family: georgia;font-size: 20px;font-style: italic;margin-bottom: 3px;line-height: 1.5;margin-top: 11px;color: #666;">We're bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!</p>
		    <div class="getstarted_wrapper">
            <div class="getstarted_options">
            <p><b>Links to help you started:</b>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/getting-started-with-amp" target="_blank">Getting Started with AMP</a></li>
					<li><a href="https://ampforwp.com/add-menus-amp/" target="_blank">Adding Navigation Menu</a></li>
					<li><a href="https://ampforwp.com/add-analytics-amp/" target="_blank">Adding Google Analtyics</a></li>
					<a class="getstarted_btn" href="https://ampforwp.com/help/" target="_blank">View all Tutorials</a>
				</ul> </p>
            </div>
            <div class="getstarted_links">
            <p><b>There are 3 ways to get help:</b></p>
			<ul class="getstarted_ul">
				<li><a href="https://wordpress.org/support/plugin/accelerated-mobile-pages" target="_blank">Support Forum</a></li>
				<li><a href="https://ampforwp.com/chat/" target="_blank">Live Chat with Our Team</a></li>
				<li><a href="https://ampforwp.com/help" target="_blank">View Documentation</a></li>
			</ul>
            </div><div class="clear"></div>
            </div>

		</div>

	</div> <?php
}

function ampforwp_plugin_parent_activation() {

	add_thickbox(); // @since 1.0.53

	include( ABSPATH . "wp-admin/includes/plugin-install.php" );
	global $tabs, $tab, $paged, $type, $term;
	$tabs = array();
	$tab = "slug";
	$per_page = 1;
	$args = array
    (
        "slug"      => "amp",
		"page" 		=> $paged,
		"per_page" 	=> $per_page,
		"fields" 	=> array( "last_updated" => true, "short_description" => true,  "downloaded" => false, "icons" => true ),
		//"locale" 	=> get_locale(),
	);
	$args = apply_filters( "install_plugins_table_api_args_$tab", $args );
    $api = plugins_api( "plugin_information", $args );
	$item = $api;

	$plugins_allowedtags = array(
		'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
		'abbr' => array( 'title' => array() ), 'acronym' => array( 'title' => array() ),
		'code' => array(), 'pre' => array(), 'em' => array(), 'strong' => array(),
		'div' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
		'p' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(),
		'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(),
		'img' => array( 'src' => array(), 'class' => array(), 'alt' => array() )
		);

	?>
	<form id="plugin-filter">

		<div class="wrap">
			<div class="ampforwp-pre-installtion-instructions">
				<h1 style="color:#388E3C;font-weight:500"><i class="dashicons dashicons-warning"></i>Almost done. One last step remaining.</h1>
				<p><b>This plugin requires the following plugin: <i>AMP</i></b></p>
				<p>Automattic, the company behind WordPress has created a framework for AMP (also known as Default AMP plugin) which we are using as the core.</p><p>To complete the installation, you just need to click on the 'Finish Installation' button and default AMP plugin will be installed. Remember, to activate the plugin and you will be redirected to this screen again.</p>
				<div id="ampforwp-network-status"></div>
			</div>

            <style>
            .install_options{     max-width: 550px;
    background: #fff;
    border: 1px solid #ddd;
    padding: 25px 27px 25px 26px;
    border-radius: 2px;
    margin-top: 19px;}
            .install_options_left{float:left}
            .install_options_right{float:right}
                .install_options_right a{
background: #4CAF50;
    padding: 11px 20px 12px 20px;
    text-decoration: none;
    color: #fff;
    margin-top: 1px;
    display: inline-block;
    font-size: 16px;
    border-radius: 3px;}
            .getstarted_wrapper{
    max-width: 510px;
    margin-top: 20px; }
            .getstarted_options{ float: left}
            .getstarted_options{float: left; background: #fff; border: 1px solid #ddd; padding: 10px 30px 10px 30px; border-radius: 2px; }
            .getstarted_links{float: right; background: #fff; border: 1px solid #ddd; padding: 10px 30px 10px 30px; border-radius: 2px; }
            .ampforwp-post-installtion-instructions, .ampforwp-pre-installtion-instructions{ margin-left: 15px;}
            .getstarted_ul li{  list-style-type: decimal; list-style-position: inside; }
            a.getstarted_btn{     background: #666;
    color: #fff;
    padding: 9px 35px 9px 35px;
    font-size: 13px;
    line-height: 1;
    text-decoration: none;
    margin-top: 8px;
    display: inline-block;}
            .dashicons-warning, .dashicons-yes{
                font-family: dashicons;
                font-style: normal;
                position: relative;
                top: 1px;
                font-size: 32px;
                margin-right: 18px;
            }
            .dashicons-yes{
                margin-right: 25px;
            }
            .dashicons-yes:before {
                content: "\f147";
                background: #388e3c;
                color: #fff;
                border-radius: 40px;
                padding-right: 3px;
                padding-top: 1px;
            }
			.ampforwp-plugin-action-buttons {
				text-align:right;
				margin-top: 0;
			}
			.ampforwp-plugin-action-buttons li {
				display: inline-block;
				margin-left: 1em;
			}
			.ampforwp-button-con {
				padding-right: 15px;
			}
			.ampforwp-button-install {
				background: none repeat scroll 0% 0% #2EA2CC !important;
				border-color: #0074A2 !important;
				box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.5) inset, 0px 1px 0px rgba(0, 0, 0, 0.15) !important;
				color: #FFF !important;
			}
			.ampforwp-button-install:focus {
			    box-shadow: 0px 0px 0px 1px #5B9DD9, 0px 0px 2px 1px rgba(30, 140, 190, 0.8) !important;
			}
			.ampforwp-button-install:hover {
			    color: #FFF !important;
				background: none repeat scroll 0% 0% #5B9DD9 !important;
			}
			.ampforwp-button-update {
				background: none repeat scroll 0% 0% #E74F34 !important;
				border-color: #C52F2F !important;
				box-shadow: 0px 1px 0px rgba(255, 235, 235, 0.5) inset, 0px 1px 0px rgba(0, 0, 0, 0.15) !important;
				color: #FFF !important;
			}
			.ampforwp-button-update:focus {
			    box-shadow: 0px 0px 0px 1px #DA3232, 0px 0px 2px 1px rgba(255, 140, 140, 0.8) !important;
			}
			.ampforwp-button-update:hover {
			    color: #FFF !important;
				background: none repeat scroll 0% 0% #DA3232 !important;
			}
			.drop-shadow {
			    position:relative;
			    background:#fff;
				margin-bottom:40px;
			}
			.drop-shadow:before,
			.drop-shadow:after {
			    content:"";
			    position:absolute;
			    z-index:-2;
            } .authors{font-style: italic}
            .ampforwp-custom-btn a{  font-size: 18px !important; background: #388E3C !important; border: 0px !important; border-radius: 2px !important; box-shadow: none !important; padding: 8px 20px !important; height: auto !important}
            .plugin-card-top h4{margin-top: 10px;}
		</style>

		<div style="margin-top:30px;" class="wp-list-table widefat plugin-install">
			<div id="the-list">

				<?php
				function ampforwp_plugin_activation_link($plugin) {
				    $activateUrl = sprintf(admin_url('plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1&s'), $plugin);
				    // change the plugin request to the plugin to pass the nonce check
				    $_REQUEST['plugin'] = $plugin;
				    $activateUrl = wp_nonce_url($activateUrl, 'activate-plugin_' . $plugin, '_wpnonce');

				    return $activateUrl;
				}

//				foreach ( (array) $item as $plugin ) {
                    $plugin = $item;
					if ( is_object( $plugin ) ) {
						$plugin = (array) $plugin;
					}

					$title = wp_kses( $plugin['name'], $plugins_allowedtags );
					// Remove any HTML from the description.
					$description = strip_tags( $plugin['short_description'] );
					$version = wp_kses( $plugin['version'], $plugins_allowedtags );

					$name = strip_tags( $title . ' ' . $version );

					$author = wp_kses( $plugin['author'], $plugins_allowedtags );
					if ( ! empty( $author ) ) {
						$author = ' <cite>' . sprintf( __( 'By %s' ), $author ) . '</cite>';
					}

					$action_links = array();

					if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
						$status = install_plugin_install_status( $plugin );

						if ( $status['status'] == 'latest_installed' && is_plugin_inactive( $status['file'] ) ) {
							$status['activation'] = 'not_activated';
						} elseif ( $status['status'] == 'latest_installed' && is_plugin_active( $status['file'] ) ) {
						 	$status['activation'] = 'activated';

						} elseif ( $status['status'] == 'update_available' && is_plugin_active( $status['file'] ) ) {
						 	$status['activation'] = 'activated_update_required';

						} else {
							$status['activation'] = 'not_installed';
						}

						$activation_link = ampforwp_plugin_activation_link($status['file']);

						switch ( $status['status'] ) {
							case 'install':
								if ( $status['url'] ) {
									/* translators: 1: Plugin name and version. */
									$action_links[] = '<a class="install-now button-secondary ampforwp-button-install" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Install %s now' ), $name ) ) . '">' . __( 'Install Now' ) . '</a>';
								}

								break;
							case 'update_available':
								if ( $status['url'] ) {
									/* translators: 1: Plugin name and version */
									$action_links[] = '<a class="button ampforwp-button-update" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Update %s now' ), $name ) ) . '">' . __( 'Update Now' ) . '</a>';
								}

								break;
							case 'latest_installed':
								if ( $status['activation'] == 'not_activated') {
									$action_links[] = '<a class="install-now button-secondary ampforwp-button-install" href="' . $activation_link . '" aria-label="' . esc_attr( sprintf( __( 'Activate %s ' ), $name ) ) . '">' . __( 'Activate' ) . '</a>';
								}
								break;
							case 'newer_installed':
								$action_links[] = '<span class="button button-disabled" title="' . esc_attr__( 'This plugin is already installed and is up to date' ) . ' ">' . _x( 'Installed', 'plugin' ) . '</span>';
								break;
						}
					}

					$details_link   = self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
										'&amp;TB_iframe=true&amp;width=750&amp;height=550' );

					/* translators: 1: Plugin name and version. */
					$action_links[] = '<a href="' . esc_url( $details_link ) . '" class="thickbox" aria-label="' . esc_attr( sprintf( __( 'More information about %s' ), $name ) ) . '" data-title="' . esc_attr( $name ) . '">' . __( 'More Details' ) . '</a>';

					if ( !empty( $plugin['icons']['svg'] ) ) {
						$plugin_icon_url = $plugin['icons']['svg'];
					} elseif ( !empty( $plugin['icons']['2x'] ) ) {
						$plugin_icon_url = $plugin['icons']['2x'];
					} elseif ( !empty( $plugin['icons']['1x'] ) ) {
						$plugin_icon_url = $plugin['icons']['1x'];
					} else {
						$plugin_icon_url = $plugin['icons']['default'];
					}

					/**
					 * Filter the install action links for a plugin.
					 *
					 * @since 2.7.0
					 *
					 * @param array $action_links An array of plugin action hyperlinks. Defaults are links to Details and Install Now.
					 * @param array $plugin       The plugin currently being listed.
					 */
					$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );
				?>
				<div class="plugin-card drop-shadow lifted" >
					<div class="plugin-card-top" style="min-height: 135px !important;">
		            <?php if ( isset( $plugin["slug"] ) && $plugin["slug"] == 'easy-media-gallery' ) {echo '<div class="most_popular"></div>';} ?>
						<span href="<?php echo esc_url( $details_link ); ?>" class="thickbox plugin-icon"><img width="128" height="128" src="<?php echo esc_attr( $plugin_icon_url ) ?>" /></span>
						<div class="name column-name" style="margin-right: 20px !important;">
							<h4><?php echo $title; ?></h4>
						</div>
						<div class="desc column-description" style="margin-right: 20px !important;">
							<p><?php echo $description; ?></p>
							<p class="authors">by Automattic</p>
						</div>
					</div>
					<div class="ampforwp-button-con">
						<?php
							if ( $action_links ) {
								echo '<ul class="ampforwp-plugin-action-buttons ampforwp-custom-btn">';
									echo '<li>' . $action_links[0] . '</li>';
								echo '</ul>';
							} ?>
					</div>
				</div>
				<?php
//				} ?>

		     	</div>
			</div>
		</div>
	</form>

	<?php
}

add_action('admin_footer','ampforwp_offline_admin_notice');
function ampforwp_offline_admin_notice() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );

	if ( $amp_plugin_activation_check ) { ?>
		<style>
			.dashboard_page_ampforwp-welcome-page .plugin-card.drop-shadow.lifted,
			.ampforwp-pre-installtion-instructions{
				display: none;
			}
		</style>
	<?php } else { ?>
		<style>
			.ampforwp-post-installtion-instructions{ display: none; }
		</style>
	<?php }
    $current_screen = get_current_screen();
     if( $current_screen ->id === "dashboard_page_ampforwp-welcome-page" ) {?>
    	<script>
      (function(){
        const statusContainer = document.getElementById('ampforwp-network-status');
    		if(! navigator.onLine) {
    			statusContainer.innerHTML = "<h1 style='color:#E91E63'> You seems to have been Offline. Please connect to network to continue the installation.</h1>";
            } else {
              if( statusContainer ) {
            	statusContainer.innerHTML =  "";
              }
            }
      })();

    	</script>
  <?php } ?>
	<?php
}
