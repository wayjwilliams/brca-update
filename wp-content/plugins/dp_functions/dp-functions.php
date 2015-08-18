<?php
/*
Plugin Name: DP Functions
Plugin URI: http://www.dynamicpress.eu
Description: Plugin which adds custom functions (post types , shortcodes) used in Dynamicpress themes.
Version: 1.2
Author: Dynamicpress
Author URI: http://www.dynamicpress.eu/
License: GPL2
*/

/*

Copyright 2013-2015 Dynamicpress

this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( ! defined( 'ABSPATH' ) ) exit;

class DP_Post_Types {}
require_once( 'inc/post_types/portfolio.php' );
require_once( 'inc/post_types/slide.php' );
require_once( 'inc/post_types/sidebar.php' );
require_once( 'inc/shortcodes/shortcodes.php' );
?>
