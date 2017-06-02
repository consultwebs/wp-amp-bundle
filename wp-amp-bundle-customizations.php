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