<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://coyo.dk
 * @since             1.0.0
 * @package           Movie_Gutenberg_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Movie Gutenberg Widget
 * Plugin URI:        https://testsite.local
 * Description:       Movie Gutenberg widget plugin
 * Version:           1.0.0
 * Author:            Michael Møller
 * Author URI:        https://coyo.dk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       movie-gutenberg-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('MOVIE_GUTENBERG_WIDGET_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-movie-gutenberg-widget-activator.php
 */
function activate_movie_gutenberg_widget()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-movie-gutenberg-widget-activator.php';
	Movie_Gutenberg_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-movie-gutenberg-widget-deactivator.php
 */
function deactivate_movie_gutenberg_widget()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-movie-gutenberg-widget-deactivator.php';
	Movie_Gutenberg_Widget_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_movie_gutenberg_widget');
register_deactivation_hook(__FILE__, 'deactivate_movie_gutenberg_widget');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-movie-gutenberg-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_movie_gutenberg_widget()
{

	$plugin = new Movie_Gutenberg_Widget();
	$plugin->run();
}
run_movie_gutenberg_widget();
