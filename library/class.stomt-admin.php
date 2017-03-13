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

class Stomt_Admin {
	
	private static $initiated = false;
	
	public static function init() {
		
		if ( !self::$initiated ) {
			self::init_hooks();
		}
	}
	
	public static function init_hooks() {
		
		self::$initiated = true;
		
		add_action( 'admin_init', array( 'Stomt_Admin', 'admin_init_hook' ) );
		add_action( 'admin_menu', array( 'Stomt_Admin', 'admin_menu_hook' ) );
	}
	
	public static function admin_init_hook() {
		load_plugin_textdomain( 'stomt' );
	}
	
	public static function admin_menu_hook() {
		register_setting( 'stomt_options', 'stomt_options', array( 'Stomt_Admin', 'validate_settings' ) );
		add_options_page(__( 'STOMT', 'stomt' ), __( 'STOMT', 'stomt' ), 'manage_options', 'stomt-admin', array( 'Stomt_Admin', 'display_setup_page' ));
	}
	
	public static function display_setup_page() {		
		self::init_settings_fields();
		Stomt::view( 'page-stomt-admin' );
	}
	
	private static function init_settings_fields() {
		
		add_settings_section( 'stomt-main',
				__( 'Setup STOMT', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_general_section' ),
				'stomt-admin'
			);
		
		add_settings_field(
				'targetId',
				__( 'STOMT Username', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_username_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'targetId',
				)
			);
		
		add_settings_field(
				'position',
				__( 'Button position', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_position_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'position',
				)
			);
		
		add_settings_field(
				'label',
				__( 'Button label', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_label_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'label',
				)
			);
		
		add_settings_field(
				'colorText',
				__( 'Text color', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_color_text_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'colorText',
				)
			);
		
		add_settings_field(
				'colorBackground',
				__( 'Background color', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_color_bg_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'colorBackground',
				)
			);
		
		add_settings_field(
				'colorHover',
				__( 'Hover color', 'stomt' ),
				array( 'Stomt_Admin', 'print_stomt_color_hover_field' ),
				'stomt-admin',
				'stomt-main',
				array(
					'label_for' => 'colorHover',
				)
			);
	}
	
	public static function validate_settings( $input ) {
		$valid[ 'targetId' ] = sanitize_text_field( $input[ 'targetId' ] );
		$valid[ 'position' ] = trim( $input[ 'position' ] ) == 'left' ? 'left' : 'right';
		$valid[ 'label' ] = sanitize_text_field( $input[ 'label' ] );
		$valid[ 'colorText' ] = sanitize_text_field( $input[ 'colorText' ] );
		$valid[ 'colorBackground' ] = sanitize_text_field( $input[ 'colorBackground' ] );
		$valid[ 'colorHover' ] = sanitize_text_field( $input[ 'colorHover' ] );
		
		if ( ( strlen( $valid[ 'targetId' ] ) < 1 ) && count( get_settings_errors() ) < 1 ) {
			add_settings_error( 'targetId', 'targetIdinvalid', __( 'Please provide a username.', 'stomt' ) );
		}
		
		return $valid;
	}
	
	public static function print_stomt_general_section( $args ) {
		Stomt::view( 'form-section-general', $args );
	}
	
	public static function print_stomt_username_field( $args ) {
		Stomt::view( 'form-field-username', $args );
	}
	
	public static function print_stomt_position_field( $args ) {
		Stomt::view( 'form-field-position', $args );
	}
	
	public static function print_stomt_label_field( $args ) {
		Stomt::view( 'form-field-label', $args );
	}
	
	public static function print_stomt_color_text_field( $args ) {
		Stomt::view( 'form-field-color', $args );
	}
	
	public static function print_stomt_color_bg_field( $args ) {
		Stomt::view( 'form-field-color', $args );
	}
	
	public static function print_stomt_color_hover_field( $args ) {
		Stomt::view( 'form-field-color', $args );
	}
}
