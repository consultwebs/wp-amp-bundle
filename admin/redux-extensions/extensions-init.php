<?php

	// All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
	Redux::setExtensions( 'wp_amp_bundle_redux', dirname( __FILE__ ) . '/extensions/' );

	// Load custom extensions