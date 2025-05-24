<?php

class WhatsApp_Icon {
    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->version = WHATSAPP_ICON_VERSION;
        $this->plugin_name = 'whatsapp-icon';
        
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        // Load required files
        require_once WHATSAPP_ICON_PLUGIN_DIR . 'includes/class-whatsapp-icon-loader.php';
        require_once WHATSAPP_ICON_PLUGIN_DIR . 'admin/class-whatsapp-icon-admin.php';
        require_once WHATSAPP_ICON_PLUGIN_DIR . 'public/class-whatsapp-icon-public.php';

        $this->loader = new WhatsApp_Icon_Loader();
    }

    private function define_admin_hooks() {
        $plugin_admin = new WhatsApp_Icon_Admin($this->get_plugin_name(), $this->get_version());

        // Add menu item
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
        
        // Add Settings link to the plugin
        $this->loader->add_filter('plugin_action_links_' . plugin_basename(WHATSAPP_ICON_PLUGIN_DIR . 'whatsapp-icon.php'), 
            $plugin_admin, 'add_action_links');

        // Save/Update plugin options
        $this->loader->add_action('admin_init', $plugin_admin, 'options_update');
    }

    private function define_public_hooks() {
        $plugin_public = new WhatsApp_Icon_Public($this->get_plugin_name(), $this->get_version());

        // Enqueue scripts and styles
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        // Add WhatsApp button to footer
        $this->loader->add_action('wp_footer', $plugin_public, 'display_whatsapp_button');
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
} 