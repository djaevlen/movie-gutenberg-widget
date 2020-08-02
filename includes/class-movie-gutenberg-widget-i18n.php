<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://coyo.dk
 * @since      1.0.0
 *
 * @package    Movie_Gutenberg_Widget
 * @subpackage Movie_Gutenberg_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Movie_Gutenberg_Widget
 * @subpackage Movie_Gutenberg_Widget/includes
 * @author     Michael Møller <michael@coyo.dk>
 */
class Movie_Gutenberg_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'movie-gutenberg-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
