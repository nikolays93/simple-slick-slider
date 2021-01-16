<?php
/**
 * Register plugin actions
 *
 * @package WordPress.SimpleSlickSlider
 */

namespace SimpleSlickSlider;

/**
 * Class Register
 */
class Register {

	/**
	 * Call this method before activate plugin
	 */
	public static function activate() {}

	/**
	 * Call this method before disable plugin
	 */
	public static function deactivate() {}

	/**
	 * Call this method before delete plugin
	 */
	public static function uninstall() {}

	public function register_post_type( $post_type ) {
		add_action( 'init', array( $post_type, 'register' ), 10 );
	}

	public function register_taxonomy( $taxonomy ) {
		add_action( 'init', array( $taxonomy, 'register' ), 10 );
	}

	public function register_shortcode( $shortcode, $taxonomy ) {
		add_shortcode( $shortcode::get_name(), array( $shortcode, 'register' ) );
		add_filter( $taxonomy::get_name() . '_row_actions', 'how_to_use_field', 10, 2 );
	}
}
