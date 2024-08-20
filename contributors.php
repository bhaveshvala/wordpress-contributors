<?php
/**
 * Plugin Name: WordPress Contributors
 * Plugin URI: #
 * Description: This plugin to display multiple authors on a post.
 * Version: 1.0.0
 * Author: Bhavesh Vala
 * Author URI: #
 * Text Domain: contributors
 * Requires at least: 6.3
 * Requires PHP: 7.4
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

/**
 * If this file is called directly.
 * abort.
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit; 
}

/**
 * Currently plugin defines.
 * @since 1.0.0
 */
define('CONTRIBUTORS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CONTRIBUTORS_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Include required files
 * @since 1.0.0
 */
require_once CONTRIBUTORS_PLUGIN_DIR . 'includes/class-contributors-metabox.php';
require_once CONTRIBUTORS_PLUGIN_DIR . 'includes/class-contributors-display.php';

/**
 * Initialize the metabox and frontend display classes
 * @since 1.0.0
 */
function contributors_plugin_init() {
    $contributors_metabox = new Contributors_Metabox();
    $contributors_display = new Contributors_Display();
}
add_action('plugins_loaded', 'contributors_plugin_init');

/**
 * Enqueue CSS and JS
 * @since 1.0.0
 */
function contributors_enqueue_assets() {
    wp_enqueue_style('contributors-style', CONTRIBUTORS_PLUGIN_URL . 'assets/css/contributors-style.css');
    wp_enqueue_script('contributors-script', CONTRIBUTORS_PLUGIN_URL . 'assets/js/contributors-script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'contributors_enqueue_assets');