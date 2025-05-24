<?php
/**
 * Plugin Name: Easy Social Chat
 * Plugin URI: https://raihanahmed.info/easy-social-chat
 * Description: A lightweight WordPress plugin that adds a customizable WhatsApp chat icon to your website.
 * Version: 1.0.0
 * Author: Raihan Ahmed
 * Author URI: https://raihanahmed.info
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: easy-social-chat
 * Domain Path: /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('WHATSAPP_ICON_VERSION', '1.0.0');
define('WHATSAPP_ICON_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WHATSAPP_ICON_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once WHATSAPP_ICON_PLUGIN_DIR . 'includes/class-whatsapp-icon.php';

// Initialize the plugin
function run_whatsapp_icon() {
    $plugin = new WhatsApp_Icon();
    $plugin->run();
}
run_whatsapp_icon(); 