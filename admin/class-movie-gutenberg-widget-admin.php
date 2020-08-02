<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://coyo.dk
 * @since      1.0.0
 *
 * @package    Movie_Gutenberg_Widget
 * @subpackage Movie_Gutenberg_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Movie_Gutenberg_Widget
 * @subpackage Movie_Gutenberg_Widget/admin
 * @author     Michael Møller <michael@coyo.dk>
 */
class Movie_Gutenberg_Widget_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', [$this, 'register_settings_page']);
		add_action('admin_init', [$this, 'register_setting_fields']);
	}

	/**
	 * Register the settings admin page
	 *
	 * @since    1.0.0
	 */
	public function register_settings_page()
	{
		add_menu_page('MGW Settings', 'MGW Settings', 'manage_options', $this->plugin_name, [$this, 'load_admin_page_content'], 'dashicons-admin-tools', 90);
	}

	/**
	 * Register the setting fields
	 *
	 * @since    1.0.0
	 */
	function register_setting_fields()
	{
		register_setting('MGW_settings', 'MGW_api_key');
	}

	/**
	 * Load the admin page content
	 *
	 * @since    1.0.0
	 */
	public function load_admin_page_content()
	{
		require_once plugin_dir_path(__FILE__) . 'partials/movie-gutenberg-widget-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Movie_Gutenberg_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Movie_Gutenberg_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/movie-gutenberg-widget-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Movie_Gutenberg_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Movie_Gutenberg_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/movie-gutenberg-widget-admin.js', array('jquery'), $this->version, false);
	}
}
