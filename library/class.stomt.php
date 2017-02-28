<?php

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

class Stomt {
	
	private static $initiated = false;
	
	public static function init() {
		
		if ( !self::$initiated ) {
			self::init_hooks();
		}
	}
	
	public static function init_hooks() {
		
		self::$initiated = true;
		
		add_action( 'wp_head', array( 'Stomt', 'add_header_scripts' ) );
	}
	
	public static function add_header_scripts() {
		
		$options = self::get_options_with_default();
		
		if ( isset( $options['targetId'] ) && strlen( $options[ 'targetId' ] ) > 0 ) {
			self::view( 'script.js' );
		}
	}

	public static function view( $name, array $args = array() ) {
		
		$args = apply_filters( 'stomt_view_args', $args, $name );
		
		$args[ 'options' ] = Stomt::get_options_with_default();
		
		foreach( $args AS $key => $val ) {
			$$key = $val;
		}
		
		load_plugin_textdomain( 'stomt' );

		$file = STOMT_PLUGIN_VIEWS_DIR . $name . '.php';
		if ( file_exists( $file ) ) {
			include( $file );
		}
	}
	
	public static function get_options_with_default() {
		
		$default = array(
			'targetId' => '',
			'position' => STOMT_DEFAULT_POSITION,
			'label' => STOMT_DEFAULT_LABEL,
			'colorText' => STOMT_DEFAULT_COLOR_TEXT,
			'colorBackground' => STOMT_DEFAULT_COLOR_BG,
			'colorHover' => STOMT_DEFAULT_COLOR_HOVER
		);
		
		return get_option( 'stomt_options', $default );
	}
}