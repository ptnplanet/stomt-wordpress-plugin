<?php
/*
Plugin Name: Stomt Instant Feedback Button
Plugin URI:  https://wordpress.org/plugins/stomt-instant-feedback-button/
Description: Add stomt's instant feedback widget to your wordpress site.
Version:     1.0
Author:      Philipp Nolte
Author URI:  https://profiles.wordpress.org/ptnplanet/
Text Domain: wporg
Domain Path: /languages
License:     GPL3
*/

/* 
 * Copyright (C) 2017 Philipp Nolte
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( !function_exists( 'add_action' ) ) {
	echo 'This plugin can not be called directly.';
	exit;
}

define( 'STOMT_PLUGIN_VERSION', '1.0' );
define( 'STOMT_PLUGIN_INCLUDES_URL', plugins_url( '/_inc/', __FILE__) );
define( 'STOMT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'STOMT_PLUGIN_LIBRARY_DIR' , STOMT_PLUGIN_DIR . 'library' . DIRECTORY_SEPARATOR );
define( 'STOMT_PLUGIN_VIEWS_DIR', STOMT_PLUGIN_DIR . 'views' . DIRECTORY_SEPARATOR);

define( 'STOMT_PLUGIN_USERNAME', 'stomt-wordpress-plugin' );

define( 'STOMT_DEFAULT_POSITION', 'right' );
define( 'STOMT_DEFAULT_LABEL', 'Feedback' );
define( 'STOMT_DEFAULT_COLOR_TEXT', '#FFFFFF' );
define( 'STOMT_DEFAULT_COLOR_BG', '#04729E' );
define( 'STOMT_DEFAULT_COLOR_HOVER', '#0091C9' );

require_once( STOMT_PLUGIN_LIBRARY_DIR . 'class.stomt.php' );
add_action( 'init', array( 'Stomt', 'init' ) );

if ( is_admin() ) {
	require_once( STOMT_PLUGIN_LIBRARY_DIR . 'class.stomt-admin.php' );
	add_action( 'init', array( 'Stomt_Admin', 'init' ) );
}

register_activation_hook( __FILE__, function () { add_option( 'stomt_options', Stomt::get_options_with_default() ); } );
register_deactivation_hook( __FILE__, function () { delete_option( 'stomt_options' ); } );