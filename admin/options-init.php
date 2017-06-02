<?php
/*
WP AMP Bundle Admin

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

	if( !class_exists('Redux') ) return;

	// Initialize admin
	$opt_name = 'wp_amp_bundle_admin';
	$theme = wp_get_theme();
	$args = array(
		'opt_name' => 'wp_amp_bundle_admin',
		'display_name' => 'WP AMP Bundle - Welcome',
		'display_version' => WPAMPBUNDLE_VERSION,
		'page_slug' => 'wp_amp_bundle_options',
		'page_title' => 'WP AMP Bundle',
		'update_notice' => TRUE,
		'intro_text' => 'Intro',
		'footer_text' => 'Footer',
		'menu_type' => 'menu',
		'menu_icon' => WPAMPBUNDLE_PLUGIN_URL . 'amphtml/amp_favicon.png',
		'menu_title' => 'AMP',
		'allow_sub_menu' => TRUE,
		'default_mark' => '*',
		'class' => 'wp_amp_bundle_admin',
		'hints' => array(
			'icon_position' => 'right',
			'icon_size' => 'normal',
			'tip_style' => array(
				'color' => 'light',
			),
			'tip_position' => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect' => array(
				'show' => array(
					'duration' => '500',
					'event' => 'mouseover',
				),
				'hide' => array(
					'duration' => '500',
					'event' => 'mouseleave unfocus',
				),
			),
		),
		'output' => TRUE,
		'output_tag' => TRUE,
		'settings_api' => TRUE,
		'cdn_check_time' => '1440',
		'compiler' => TRUE,
		'customizer' => false,
		'page_permissions' => 'manage_options',
		'save_defaults' => TRUE,
		'show_import_export' => TRUE,
		'database' => 'options',
		'transient_time' => '3600',
		'network_sites' => TRUE,
		'dev_mode' => false,
		'update_notice' => false
	);
	Redux::setArgs( $opt_name, $args );
	$tabs = array(
		array(
			'id'      => 'redux-help-tab-1',
			'title'   => __( 'Theme Information 1', 'admin_folder' ),
			'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
		),
		array(
			'id'      => 'redux-help-tab-2',
			'title'   => __( 'Theme Information 2', 'admin_folder' ),
			'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
		)
	);
	Redux::setHelpTab( $opt_name, $tabs );
	$content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
	Redux::setHelpSidebar( $opt_name, $content );
	/*Redux::setSection( $opt_name, array(
		'title'  => __( 'Basic Field', 'redux-framework-demo' ),
		'id'     => 'basic',
		'desc'   => __( 'Basic field with no subsections.', 'redux-framework-demo' ),
		'icon'   => 'el el-home',
		'fields' => array(
			array(
				'id'       => 'opt-text',
				'type'     => 'text',
				'title'    => __( 'Example Text', 'redux-framework-demo' ),
				'desc'     => __( 'Example description.', 'redux-framework-demo' ),
				'subtitle' => __( 'Example subtitle.', 'redux-framework-demo' ),
			)
		)
	) );*/
	Redux::setSection( $opt_name, array(
		'title' => __( 'AMP - Get Started', 'wp-amp-bundle-admin-get-started' ),
		'id'    => 'wp-amp-bundle-admin-get-started',
		'desc'  => __( '', 'wp-amp-bundle-admin-get-started-desc' ),
		'icon'  => 'el el-home'
	) );
	Redux::setSection($opt_name, array(
		'title' => __( 'Call Tracking', 'wp-amp-bundle-admin-call-tracking' ),
		'id'    => 'wp-amp-bundle-admin-call-tracking',
		'desc'  => __( '<strong>Note: Currently only CallTrackingMetrics is supported.</strong>', 'wp-amp-bundle-admin-call-tracking-desc' ),
		'icon'  => 'el el-phone-alt',
		//'subsection' => true,
		'fields'     => array(
			array(
			    'id'       => 'wp-amp-bundle-admin-call-tracking-provider',
			    'type'     => 'radio',
			    'title'    => __('Provider', 'wp-amp-bundle-admin-call-tracking-provider'), 
			    'subtitle' => __('Choose your call tracking provider:', 'wp-amp-bundle-admin-call-tracking-provider-subtitle'),
			    'desc'     => __('', 'wp-amp-bundle-admin-call-tracking-provider-desc'),
			    'options'  => array(
					'1' => 'CallTrackingMetrics'
			    ),
			    'default' => '1'
			),
			array(
				'id' => 'wp-amp-bundle-admin-call-tracking-credentials',
				'type' => 'section',
				'title' => __('Credentials', 'wp-amp-bundle-admin-call-tracking-credentials-section'),
				'indent' => true
            ),
			array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-credentials-api-key',
				'type'     => 'text',
				'title'    => __( 'API Access Key', 'wp-amp-bundle-admin-call-tracking-credentials-api-key' ),
				'subtitle' => __( 'Located under Account Settings', 'wp-amp-bundle-admin-call-tracking-credentials-api-key-subtitle' ),
				'desc'     => __( 'To obtain this key, visit <a target="_blank" href="https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140">https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140</a>', 'wp-amp-bundle-admin-call-tracking-credentials-api-key-desc' ),
				'default'  => 'Paste Access Key Here',
			),
			array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-credentials-api-secret',
				'type'     => 'password',
				'title'    => __( 'API Secret Key', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret' ),
				'subtitle' => __( 'Located under Account Settings', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret-subtitle' ),
				'desc'     => __( 'To obtain this key, visit <a target="_blank" href="https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140">https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140</a>', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret-desc' ),
				'default'  => '',
			),
			array(
				'id' => 'wp-amp-bundle-admin-call-tracking-integration',
				'type' => 'section',
				'title' => __('Integration', 'wp-amp-bundle-admin-call-tracking-integration-section'),
				'indent' => true
            ),
            array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-integration-account',
				'type'     => 'select',
				'title'    => __('Account', 'wp-amp-bundle-admin-call-tracking-integration-account'), 
				'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
				'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
				// Must provide key => value pairs for select options
				'options'  => array(
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3'
				),
				'default'  => '2',
			),
			array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-integration-tracking-number',
				'type'     => 'select',
				'title'    => __('Tracking Number', 'wp-amp-bundle-admin-call-tracking-integration-tracking-number'), 
				'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
				'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
				// Must provide key => value pairs for select options
				'options'  => array(
					'1' => 'Opt 1',
					'2' => 'Opt 2',
					'3' => 'Opt 3'
				),
				'default'  => '2',
			),
			array(
			    'id'   => 'info_normal',
			    'type' => 'info',
			    'title'    => __('Code Generation', 'wp-amp-bundle-admin-call-tracking-integration-tracking-number'), 
				'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
			    'desc' => __('This is the info field, if you want to break sections up.', 'redux-framework-demo')
			)
		)
	));
	/*
	Redux::setSection( $opt_name, array(
		'title'      => __( 'Text Area', 'redux-framework-demo' ),
		'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
		'id'         => 'opt-textarea-subsection',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'textarea-example',
				'type'     => 'textarea',
				'title'    => __( 'Text Area Field', 'redux-framework-demo' ),
				'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
				'desc'     => __( 'Field Description', 'redux-framework-demo' ),
				'default'  => 'Default Text',
			),
		)
	) );*/
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	    }
	}
	add_action('init', 'removeDemoModeLink');

	// Enqueue stylesheet
	wp_register_style('wp_amp_bundle_admin_stylesheet', WPAMPBUNDLE_PLUGIN_URL . 'admin/options.css');
    wp_enqueue_style('wp_amp_bundle_admin_stylesheet');