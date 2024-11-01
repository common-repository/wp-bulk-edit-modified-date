<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://socialmob.com
 * @since             1.0.0
 * @package           Last_Modified_Bulk
 *
 * @wordpress-plugin
 * Plugin Name:       Bulk Edit Modified Date
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This plugin displays a Modified Date on the posts table and provides changing the modified date as a bulk edit . It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Brian David
 * Author URI:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Last-Modified-Bulk
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LMB_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/Last-Modified-Bulk-activator.php
 */
function activate_Last_Modified_Bulk() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/Last-Modified-Bulk-activator.php';
	Last_Modified_Bulk_Activator::activate_lmb();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/Last-Modified-Bulk-deactivator.php
 */
function deactivate_Last_Modified_Bulk() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/Last-Modified-Bulk-deactivator.php';
	Last_Modified_Bulk_Deactivator::deactivate_lmb();
}

register_activation_hook( __FILE__, 'activate_Last_Modified_Bulk' );
register_deactivation_hook( __FILE__, 'deactivate_Last_Modified_Bulk' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/Last-Modified-Bulk.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_last_modified_bulk() {
	$plugin = new Last_Modified_Bulk();
	$plugin->run_lmb();
}

run_last_modified_bulk();