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
		'footer_text' => 'Copyright &copy; ' . date('Y') . ' Consultwebs.com, Inc.',
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
	$welcome = '<h2>Welcome!</h2>
	<p>The following sections will help you get started in configuring AMP on your website:</p>
	<ul>
	<li><strong>Analytics: </strong> Allows the inclusion of a Google Analytics script to be included on AMP posts to provide analytics tracking.</li>
	<li><strong>Design: </strong> Allows the default AMP theme to be customized with your branding; fonts, colors and layout vary between themes.</li>
	<li><strong>Call Tracking: </strong> Still in development. Uses the Call Tracking Metrics api to dynamically add call tracking on AMP posts.</li>
	<li><strong>Import / Export: </strong> Provides a method to import and export settings from this plugin.</li>';
	Redux::setSection( $opt_name, array(
		'title' => __( 'AMP - Get Started', 'wp-amp-bundle-admin-get-started' ),
		'id'    => 'wp-amp-bundle-admin-get-started',
		'desc'  => __( $welcome, 'wp-amp-bundle-admin-get-started-desc' ),
		'icon'  => 'el el-home',
	) );

	// AMP GTM SECTION
 Redux::setSection( $opt_name,    array(
							'title' => __('Analytics'),
							// 'icon' => 'el el-th-large',
							'desc'  => 'You can either use Google Tag Manager or Other Analytics Providers',
							'subsection' => false,
							'icon' => 'el el-graph',
							'fields' =>
								array(


									array(
											'id'       => 'amp-analytics-select-option',
											'type'     => 'select',
											'title'    => __( 'Analytics Type', 'redux-framework-demo' ),
											'subtitle' => __( 'Select your Analytics provider.', 'redux-framework-demo' ),
											'options'  => array(
													'1' => __('Google Analytics', 'redux-framework-demo' ),
													'2' => __('Segment Analytics', 'redux-framework-demo' ),
													'3' => __('Piwik Analytics', 'redux-framework-demo' ),
													'4' => __('Quantcast Measurement', 'redux-framework-demo' ),
													'5' => __('comScore', 'redux-framework-demo' ),
											),
											'required' => array(
												array('amp-use-gtm-option', '=' , '0'),
											),
											'default'  => '1',
									),
										array(
												'id'       => 'ga-feild',
												'type'     => 'text',
												'title'    => __( 'Google Analytics', 'redux-framework-demo' ),
												'required' => array(
													array('amp-use-gtm-option', '=' , '0'),
													array('amp-analytics-select-option', '=' , '1')
												),
												'subtitle' => __( 'Enter your Google Analytics ID.', 'redux-framework-demo' ),
												'desc'     => __('Example: UA-XXXXX-Y', 'redux-framework-demo' ),
												'default'  => 'UA-XXXXX-Y',
										),
										array(
											'id'       => 'sa-feild',
											'type'     => 'text',
											'title'    => __( 'Segment Analytics', 'redux-framework-demo' ),
											'subtitle' => __( 'Enter your Segment Analytics Key.', 'redux-framework-demo' ),
											'required' => array(
												array('amp-use-gtm-option', '=' , '0'),
												array('amp-analytics-select-option', '=' , '2')
											),
											'default'  => 'SEGMENT-WRITE-KEY',
										),
										array(
												'id'       => 'pa-feild',
												'type'     => 'text',
												'title'    => __( 'Piwik Analytics', 'redux-framework-demo' ),
												'required' => array(
													array('amp-use-gtm-option', '=' , '0'),
													array('amp-analytics-select-option', '=' , '3')
												),
												'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'redux-framework-demo' ),
												'subtitle' => __('Enter your Piwik Analytics URL.', 'redux-framework-demo' ),
												'default'  => '#',
										),

										array(
											'id'        	=>'amp-quantcast-analytics-code',
											'type'      	=> 'text',
											'title'     	=> __('p-code'),
											'default'   	=> '',
											'required' => array(
											array('amp-analytics-select-option', '=' , '4')),
										),
										array(
											'id'        	=>'amp-comscore-analytics-code-c1',
											'type'      	=> 'text',
											'title'     	=> __('C1'),
											'default'   	=> 1,
											'required' => array(
											array('amp-analytics-select-option', '=' , '5')),
										),
										array(
											'id'        	=>'amp-comscore-analytics-code-c2',
											'type'      	=> 'text',
											'title'     	=> __('C2'),
											'default'   	=> '',
											'required' => array(
											array('amp-analytics-select-option', '=' , '5')),
										),

										//GTM
											array(
													'id'       => 'amp-use-gtm-option',
													'type'     => 'switch',
													'title'    => __( 'Use Google Tag Manager', 'redux-framework-demo' ),
													'subtitle' => __( 'Select your Analytics provider.', 'redux-framework-demo' ),
													'default'  => 0,
											),
											array(
												'id'        	=>'amp-gtm-id',
												'type'      	=> 'text',
												'title'     	=> __('Tag Manager ID (Container ID)'),
												'default'   	=> '',
												'desc'	=> 'Eg: GTM-5XXXXXP',
											//  'validate' => 'not_empty',
												'required' => array(
													array('amp-use-gtm-option', '=' , '1')
												),
											),
											array(
												'id'        	=>'amp-gtm-analytics-type',
												'type'      	=> 'text',
												'title'     	=> __('Analytics Type'),
												'default'   	=> '',
												'desc'	=> 'Eg: googleanalytics',
											 // 'validate' => 'not_empty',
												'required' => array(
													array('amp-use-gtm-option', '=' , '1')
												),
											),
											array(
												'id'        	=>'amp-gtm-analytics-code',
												'type'      	=> 'text',
												'title'     	=> __('Analytics ID'),
												'default'   	=> '',
												'desc'	=> 'Eg: UA-XXXXXX-Y',
												// 'validate' => 'not_empty',
												'required' => array(
												array('amp-use-gtm-option', '=' , '1')),
											),

								)
					)
 );

  $categories = get_categories( array(
                                     'orderby' => 'name',
                                     'order'   => 'ASC'
                                     ) );
 $categories_array = array();
  if ( $categories ) :
  foreach ($categories as $cat ) {
    $cat_id = $cat->cat_ID;
    $key = "".$cat_id;
    //building assosiative array of ID-cat_name
    $categories_array[ $key ] = $cat->name;
   }
   endif;
   //End of code for fetching ctegories to show as a list in redux settings

   function ampforwp_get_element_default_color() {
       $default_value = get_option('redux_builder_amp', true);
       $default_value = $default_value['amp-opt-color-rgba-colorscheme']['color'];
       if ( empty( $default_value ) ) {
         $default_value = '#333';
       }
     return $default_value;
   }

	// AMP Design SECTION
  Redux::setSection( $opt_name, array(
      'title'      => __( 'Design', 'redux-framework-demo' ),
      'desc'       => __( '
      <br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.plugin_dir_url(__FILE__) . '/images/amp-post-builder.png" width="489" height="72" /></a>
      '),
      'id'         => 'amp-design',
			'icon'       => 'el el-pencil',
      'subsection' => false,
       'fields'     => array(

           $fields =  array(
               'id'       => 'amp-design-selector',
               'type'     => 'select',
               'title'    => __( 'Design Selector', 'redux-framework-demo' ),
               'subtitle' => __( 'Select your design.', 'redux-framework-demo' ),
               'options'  => array(
                   '1' => __('Design One', 'redux-framework-demo' ),
                   '2' => __('Design Two', 'redux-framework-demo' ),
                   '3' => __('Design Three', 'redux-framework-demo' )
               ),
               'default'  => '2'
           ),
           array(
               'id'        => 'amp-opt-color-rgba-colorscheme',
               'type'      => 'color_rgba',
               'title'     => 'Color Scheme',
               'default'   => array(
                   'color'     => '#F42F42',
               ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               )
             ),
           array(
               'id'        => 'amp-opt-color-rgba-headercolor',
               'type'      => 'color_rgba',
               'title'     => 'Header Background Color',
               'default'   => array(
                   'color'     => '#FFFFFF',
               ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               )
             ),
           array(
                   'id'        => 'amp-opt-color-rgba-font',
                   'type'      => 'color_rgba',
                   'title'     => 'Color Scheme Font Color',
                   'default'   => array(
                       'color'     => '#fff',
                   ),
                   'required' => array(
                     array('amp-design-selector', '=' , '3')
                )
             ),
           array(
                   'id'        => 'amp-opt-color-rgba-headerelements',
                   'type'      => 'color_rgba',
                   'title'     => 'Header Elements Color',
                   'default'   => array(
                       'color'     => ampforwp_get_element_default_color(),
                   ),
                   'required' => array(
                     array('amp-design-selector', '=' , '3')
                )
            ),


         array(
                    'id'       => 'amp-design-3-featured-slider',
                    'type'     => 'switch',
                    'title'    => __( 'Featured Slider', 'redux-framework-demo' ),
                    'required' => array(
                       array('amp-design-selector', '=' , '3')
                    ),
                    'default'  => '1'
                ),
            array(
               'id'       => 'amp-design-3-category-selector',
               'type'     => 'select',
               'title'    => __( 'Featured Slider Category', 'redux-framework-demo' ),
               'options'  => $categories_array,
               'required' => array(
                 array('amp-design-selector', '=' , '3'),
                 array('amp-design-3-featured-slider', '=' , '1')
               ),
           ),
            array(
               'id'       => 'amp-design-3-search-feature',
               'type'     => 'switch',
               'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
               'title'    => __( 'Search', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               ),
               'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
               'default'  => '0'
           ),

            array(
               'id'       => 'amp-design-2-search-feature',
               'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
               'type'     => 'switch',
               'title'    => __( 'Search', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '2')
               ),
               'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
               'default'  => '0'
           ),

            array(
               'id'       => 'amp-design-1-search-feature',
               'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
               'type'     => 'switch',
               'title'    => __( 'Search', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '1')
               ),
               'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
               'default'  => '0'
           ),

            array(
               'id'       => 'amp-design-3-credit-link',
               'type'     => 'switch',
               'title'    => __( 'Credit link', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               ),
               'default'  => '1'
           ),
            array(
               'id'       => 'amp-design-3-author-description',
               'type'     => 'switch',
               'title'    => __( 'Author Bio in Single', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               ),
               'default'  => '1'
           ),
           array(
              'id'       => 'amp-design-3-date-feature',
              'type'     => 'switch',
              'title'    => __( 'Display Date on Single', 'redux-framework-demo' ),
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
              'desc'     => __('Display date along with author and category', 'redux-framework-demo' ),
              'default'  => '0'
          ),

       array(
           'id'       => 'css_editor',
           'type'     => 'ace_editor',
           'title'    => __('Custom CSS', 'redux-framework-demo'),
           'subtitle' => __('You can customize the Stylesheet of the AMP version by using this option.', 'redux-framework-demo'),
           'mode'     => 'css',
           'theme'    => 'monokai',
           'desc'     => '',
           'default'  => "/******* Paste your Custom CSS in this Editor *******/"
       ),
       )

  )

  );

	$call_tracking = array(
		'title' => __( 'Call Tracking', 'wp-amp-bundle-admin-call-tracking' ),
		'id'    => 'wp-amp-bundle-admin-call-tracking',
		'desc'  => __( '<strong>Note: Currently only CallTrackingMetrics is supported.</strong>', 'wp-amp-bundle-admin-call-tracking-desc' ),
		'icon'  => 'el el-phone-alt',
		//'subsection' => true,
		'fields'     => array(
			// Call Now button
	    array(
	        'id'       => 'ampforwp-callnow-button',
	        'type'     => 'switch',
	        'title'    => __('Call Now Button', 'redux-framework-demo'),
	        'true'      => 'true',
	        'false'     => 'false',
	        'default'   => 0
	    ),
	    array(
	        'id'        => 'amp-opt-color-rgba-colorscheme-call',
	        'type'      => 'color_rgba',
	        'title'     => 'Call Button Color',
	        'default'   => array(
	            'color'     => '#0a89c0',
	        ),
	        'required' => array(
	          array('ampforwp-callnow-button', '=' , '1')
	        )
	    ),
			array(
			    'id'       => 'wp-amp-bundle-admin-call-tracking-provider',
			    'type'     => 'radio',
			    'title'    => __('Provider', 'wp-amp-bundle-admin-call-tracking-provider'),
			    'subtitle' => __('Choose your call tracking provider:', 'wp-amp-bundle-admin-call-tracking-provider-subtitle'),
			    'desc'     => __('', 'wp-amp-bundle-admin-call-tracking-provider-desc'),
					'required'  => array('ampforwp-callnow-button', '=' , '1'),
			    'options'  => array(
					'1' => 'CallTrackingMetrics'
			    ),
			    'default' => '1'
			),
			array(
				'id' => 'wp-amp-bundle-admin-call-tracking-credentials',
				'type' => 'section',
				'title' => __('Credentials', 'wp-amp-bundle-admin-call-tracking-credentials-section'),
				'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
				'indent' => true
            ),
			array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-credentials-api-key',
				'type'     => 'text',
				'title'    => __( 'API Access Key', 'wp-amp-bundle-admin-call-tracking-credentials-api-key' ),
				'subtitle' => __( 'Located under Account Settings', 'wp-amp-bundle-admin-call-tracking-credentials-api-key-subtitle' ),
				'desc'     => __( 'To obtain this key, visit <a target="_blank" href="https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140">https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140</a>', 'wp-amp-bundle-admin-call-tracking-credentials-api-key-desc' ),
				'default'  => 'Paste Access Key Here',
				'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
			),
			array(
				'id'       => 'wp-amp-bundle-admin-call-tracking-credentials-api-secret',
				'type'     => 'password',
				'title'    => __( 'API Secret Key', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret' ),
				'subtitle' => __( 'Located under Account Settings', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret-subtitle' ),
				'desc'     => __( 'To obtain this key, visit <a target="_blank" href="https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140">https://help.calltrackingmetrics.com/customer/en/portal/articles/2742395-api-key?b_id=8140</a>', 'wp-amp-bundle-admin-call-tracking-credentials-api-secret-desc' ),
				'default'  => '',
				'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
			),
		)
	);

	if($ctm_accounts = get_ctm_accounts()){
			$call_tracking['fields'][] = array(
				'id' => 'wp-amp-bundle-admin-call-tracking-integration',
				'type' => 'section',
				'title' => __('Integration', 'wp-amp-bundle-admin-call-tracking-integration-section'),
				'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
				'indent' => true
			);
			$call_tracking['fields'][] =     array(
			'id'       => 'wp-amp-bundle-admin-call-tracking-integration-account',
			'type'     => 'select',
			'title'    => __('Account', 'wp-amp-bundle-admin-call-tracking-integration-account'),
			'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
			'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
			'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
			// Must provide key => value pairs for select options
			'options'  => $ctm_accounts
		);
	}
	if($ctm_numbers = get_ctm_numbers()){
		$call_tracking['fields'][] = array(
			'id'       => 'wp-amp-bundle-admin-call-tracking-integration-tracking-number',
			'type'     => 'select',
			'title'    => __('Tracking Number', 'wp-amp-bundle-admin-call-tracking-integration-tracking-number'),
			'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
			'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
			'required'  => array('wp-amp-bundle-admin-call-tracking-provider', '=' , '1'),
			// Must provide key => value pairs for select options
			'options'  => $ctm_numbers
		);
	}

	Redux::setSection($opt_name, $call_tracking);
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

		function get_ctm_accounts(){
			$wp_amp_bundle_admin = get_option('wp_amp_bundle_admin');
			$api = $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-key'];
			$secret = $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-secret'];
			if($api && $secret){
			 $content = wp_remote_get('https://api.calltrackingmetrics.com/api/v1/accounts',
				 array(
					 'user-agent' =>  $_SERVER[HTTP_USER_AGENT],
					 'headers' => array(
		 				 'Authorization' => 'Basic ' . base64_encode($api . ':' . $secret),
		 				 'Content-Type' => 'application/json'
	 			 		)
				 )
		 	);
			 $accounts = json_decode($content['body']);
			 if($accounts->accounts){
				 $output = array();
				 foreach($accounts->accounts as $account){
					 if(!in_array($account->id, $output)){
						 $output[$account->id] = $account->name;
					 }
				 }
				 return $output;
			 } else {
				 return false;
			 }
		 } else {
			 return false;
		 }
		}

		function get_ctm_numbers(){
			$wp_amp_bundle_admin = get_option('wp_amp_bundle_admin');
			$api = $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-key'];
			$secret = $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-credentials-api-secret'];
			$account_id = $wp_amp_bundle_admin['wp-amp-bundle-admin-call-tracking-integration-account'];
			if($api && $secret && $account_id){
				$content = wp_remote_get(sprintf('https://api.calltrackingmetrics.com/api/v1/accounts/%s/numbers', $account_id),
		 			array(
		 				'user-agent' =>  $_SERVER[HTTP_USER_AGENT],
		 				'headers' => array(
		 		 			'Authorization' => 'Basic ' . base64_encode($api . ':' . $secret),
		 		 			'Content-Type' => 'application/json'
		 	 			 	)
		 				)
		 		 	);
					$account_numbers = json_decode($content['body']);
			  if($account_numbers->numbers){
			    $page = $account_numbers->page;
			    $pages = $account_numbers->total_pages;
			    $next_page = $account_numbers->next_page;
			    $output = array();
			    foreach($account_numbers->numbers as $account){
			      if(!in_array($account->number, $output)){
			        $output[$account->number] = $account->number;
			      }
			    }
					if($next_page){
				    for($i = $page; $i < $pages; $i++){
							$content = wp_remote_get(sprintf('https://api.calltrackingmetrics.com%s', $next_page), array(
				 				'user-agent' =>  $_SERVER[HTTP_USER_AGENT],
				 				'headers' => array(
				 		 			'Authorization' => 'Basic ' . base64_encode($api . ':' . $secret),
				 		 			'Content-Type' => 'application/json'
				 	 			 	)
				 				)
							);
							$account_loop = json_decode($content['body']);
				      foreach($account_loop->numbers as $account){
				        if(!in_array($account->number, $output)){
				          $output[$account->number] = $account->number;
				        }
				      }
				      if($account_loop->next_page){
				        $next_page = $account_loop->next_page;
				      }
				    }
					}
			    return $output;
			  } else {
					return false;
				}
			} else {
				return false;
			}
		}
