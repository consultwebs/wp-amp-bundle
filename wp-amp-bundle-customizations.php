<?php
/*
WP AMP Bundle Customizations

Accelerated Mobile Pages (AMP) for Professional WordPress Sites
Copyright (C) 2017 Consultwebs.com, Inc.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

	// Prevent direct access
	defined('ABSPATH') OR exit();

	// Make sure class is defined
	class_exists('WPAMPBundle') OR exit();

	// Customize Accelerated Mobile Pages plugin
	Redux::setArgs('redux_builder_amp', array(
		'menu_title' => __('AMP (Advanced)', 'ampforwp')
	));

	// Add AMP page validator menu item & script
	if( !is_admin() ) {
			add_action( 'admin_bar_menu', 'add_to_admin_bar', 999 );
			
			function add_to_admin_bar( $wp_admin_bar ) {
				$args = array(
					'id'     => 'wp_amp_validate',
					'title'  => 'Validate Page',
					'href'   => '?amp_validate=true',
					'parent' => 'wp_amp_bundle_options'
				);
				$wp_admin_bar->add_node($args);
			}

			if($_GET["amp_validate"]){
				wp_enqueue_style('amp-validate-styles', WPAMPBUNDLE_PLUGIN_URL . 'admin/styles/amp-validate.css');
				add_action('wp_head', 'validate_amp');
			}

	}

	function validate_amp(){
		try {
			//$ch = curl_init();
			//if (FALSE === $ch) throw new Exception('failed to initialize');

			$site = str_replace(array('http://', 'https://', '?amp_validate=true'), '', $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . 'amp');
			$url = 'https://amp.cloudflare.com/q/' . $site;
			$content = wp_remote_get($url, array('user-agent' =>  $_SERVER[HTTP_USER_AGENT]));
			$content = json_decode($content['body']);
			$html = '';

			if($content->errors){
				$html .= '<div class="amp_output_container amp_error">';
				$html .= '<span class="amp_validation_title"><div class="amp_validation_title"><span>AMP Validation Errors Detected</span></div></span>';
				$html .= '<div class="amp_error_wrapper">';
				foreach($content->errors as $error){
					$html .= '<div class="amp_error_container">';
					$html .= '<span class="amp_error_code">' . str_replace('_', ' ', $error->code) . '</span> ';
					$html .= '<span class="amp_error_location"> (line ' . $error->line . ', column ' . $error->col . ')</span>';
					$html .= '<span class="amp_error_help"><a href="' . $error->help.'" target="_blank">[?]</a></span>';
					$html .= '<span class="amp_error_desc">' . $error->error . '</span>';
					$html .= '</div>';
				}
				$html .= '</div></div>';
			} else {
				$html .= '<div class="amp_output_container amp_valid"><div class="amp_validation_title"><span>AMP Validation Successful</span></div></div>';
			}
			echo $html;
		} catch(Exception $e) {
			trigger_error(sprintf('Curl failed with error #%d: %s',$e->getCode(), $e->getMessage()),E_USER_ERROR);
		}
	}

	add_action ('redux/options/wp_amp_bundle_admin/saved', 'redux_hard_reset');
	function redux_hard_reset(){
		global $wp_amp_bundle_admin;
		if($wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-key'] && $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-secret'] || $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-integration-account']){?>
	<script>location.reload();</script>
		<?php }

	}
