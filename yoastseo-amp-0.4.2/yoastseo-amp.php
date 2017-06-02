<?php

if ( ! class_exists( 'YoastSEO_AMP', false ) ) {
	/**
	 * This class improves upon the AMP output by the default WordPress AMP plugin using Yoast SEO metadata.
	 */
	class YoastSEO_AMP {

		/**
		 * YoastSEO_AMP constructor.
		 */
		public function __construct() {

			require 'classes/class-options.php';

			if ( is_admin() ) {
				require 'classes/class-backend.php';
				new YoastSEO_AMP_Backend();
				return;
			}

			require 'classes/class-build-css.php';
			require 'classes/class-frontend.php';
			new YoastSEO_AMP_Frontend();
		}

	}
}

if ( ! function_exists('yoast_seo_amp_glue_init' ) ) {
	/**
	 * Initialize the Yoast SEO AMP Glue plugin
	 */
	function yoast_seo_amp_glue_init() {
		if ( defined( 'WPSEO_FILE' ) && defined( 'AMP__FILE__' ) ) {
			new YoastSEO_AMP();
		}
	}

	add_action( 'init', 'yoast_seo_amp_glue_init', 9 );
}
