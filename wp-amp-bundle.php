<?php
/*
Plugin Name: WP AMP Bundle
Plugin URI: https://github.com/consultwebs/wp-amp-bundle
Description: Accelerated Mobile Pages (AMP) for Professional WordPress Sites
Version: 0.1.0
Author: Consultwebs, Derek Seymour
Author URI: https://www.consultwebs.com/
License: GPLv2 or later

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

	// Make sure class isn't already defined
	if( !class_exists('WPAMPBundle') ) {

		// Define plugin class
		class WPAMPBundle {

			// Properties
			public $version = '0.1.0';
			public $schema = '20170223';
			public $amp_wp_plugin_dir_name = 'amp-wp-0.4';
			public $accelerated_mobile_pages_plugin_dir_name = 'accelerated-mobile-pages-0.9.43.5';
			
			// Constructor
			function __construct() {

				// Set plugin constants
				define('WPAMPBUNDLE', true);
				define('WPAMPBUNDLE_VERSION', $this->version);
				define('WPAMPBUNDLE_PLUGIN_DIR', plugin_dir_path(__FILE__));
				define('WPAMPBUNDLE_PLUGIN_FILE', __FILE__);

				// Register actions, filters, hooks
				add_action('init',                      array($this, 'action_init'));
				register_activation_hook(__FILE__,      array($this, 'hook_register_activation_hook'));
				register_deactivation_hook(__FILE__,	array($this, 'hook_register_deactivation_hook'));
			}
			
			// Handles the 'init' action       
			function action_init() {

				// Check plugin version
				$version = get_option('wp_amp_bundle_version', false);
				if( ( $version !== false && $version != $this->version ) ) {
					
					// Perform any upgrades needed

					// Update version in database
					update_option('wp_amp_bundle_version', $this->version);
				} elseif( $version === false ) {

					// Add version to database
					add_option('wp_amp_bundle_version', $this->version);
				}
				
				// Check plugin schema
				$schema = get_option('wp_amp_bundle_schema', false);
				if( $schema !== false && (int) $schema > 0 && (int) $schema < (int) $this->schema ) {
					
					// Perform any schema upgrades needed

					// Update schema version in database
					update_option('wp_amp_bundle_schema', $this->schema);
				} elseif( $schema === false ) {
				
					// Add schema version to database
					add_option('wp_amp_bundle_schema', $this->schema);
				}
			}

			// Handles the 'activation' hook
			function hook_register_activation_hook() {

			}
			
			// Handles the 'deactivation' hook
			function hook_register_deactivation_hook() {

				// Remove plugin data from database
				delete_option('wp_amp_bundle_schema');
				delete_option('wp_amp_bundle_version');
			}
		}
	}

	// Initialize plugin
	if( !defined('WPAMPBUNDLE') ) {
		$wp_amp_bundle = new WPAMPBundle();

		// Load official AMP WP plugin if needed
		if( !defined('AMP__FILE__') ) {
			define('WPAMPBUNDLE_AMP_WP_PLUGIN', true);
			require_once(WPAMPBUNDLE_PLUGIN_DIR . $wp_amp_bundle->amp_wp_plugin_dir_name . '/amp.php');
		}

		// Load Accelerated Mobile Pages (AMP for WP) plugin if needed
		if( !defined('AMPFORWP_VERSION') ) {
			define('WPAMPBUNDLE_ACCELERATED_MOBILE_PAGES_PLUGIN', true);
			require_once(WPAMPBUNDLE_PLUGIN_DIR . $wp_amp_bundle->accelerated_mobile_pages_plugin_dir_name . '/accelerated-moblie-pages.php');
		}
	}