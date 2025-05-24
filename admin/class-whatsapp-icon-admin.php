<?php

class WhatsApp_Icon_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/whatsapp-icon-admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/whatsapp-icon-admin.js', array('jquery'), $this->version, false);
    }

    public function add_plugin_admin_menu() {
        add_options_page(
            __('WhatsApp Icon Settings', 'easy-social-chat'),
            __('WhatsApp Icon', 'easy-social-chat'),
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_setup_page')
        );
    }

    public function add_action_links($links) {
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', 'whatsapp-icon') . '</a>',
        );
        return array_merge($settings_link, $links);
    }

    public function options_update() {
        register_setting($this->plugin_name, 'whatsapp_icon_options', array($this, 'validate'));
    }

    public function validate($input) {
        $valid = array();
        
        // WhatsApp Number
        $valid['whatsapp_number'] = (isset($input['whatsapp_number']) && !empty($input['whatsapp_number'])) 
            ? sanitize_text_field($input['whatsapp_number']) 
            : '';

        // Pre-filled Message
        $valid['prefilled_message'] = (isset($input['prefilled_message']) && !empty($input['prefilled_message'])) 
            ? sanitize_textarea_field($input['prefilled_message']) 
            : '';

        // Button Position
        $valid['button_position'] = (isset($input['button_position']) && !empty($input['button_position'])) 
            ? sanitize_text_field($input['button_position']) 
            : 'bottom-right';

        // Button Color
        $valid['button_color'] = (isset($input['button_color']) && !empty($input['button_color'])) 
            ? sanitize_hex_color($input['button_color']) 
            : '#25D366';

        // Display Rules
        $valid['display_rules'] = (isset($input['display_rules']) && !empty($input['display_rules'])) 
            ? sanitize_text_field($input['display_rules']) 
            : 'all';

        return $valid;
    }

    public function display_plugin_setup_page() {
        include_once('partials/whatsapp-icon-admin-display.php');
    }
} 