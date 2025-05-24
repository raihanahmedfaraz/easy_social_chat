<?php

class WhatsApp_Icon_Public {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/whatsapp-icon-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/whatsapp-icon-public.js', array('jquery'), $this->version, true);
    }

    public function display_whatsapp_button() {
        $options = get_option('whatsapp_icon_options');
        
        // Check if we should display the button based on display rules
        if (!$this->should_display_button($options)) {
            return;
        }

        // Get WhatsApp number and message
        $whatsapp_number = isset($options['whatsapp_number']) ? $options['whatsapp_number'] : '';
        $prefilled_message = isset($options['prefilled_message']) ? $options['prefilled_message'] : '';
        
        // Build WhatsApp URL
        $whatsapp_url = 'https://wa.me/' . esc_attr($whatsapp_number);
        if (!empty($prefilled_message)) {
            $whatsapp_url .= '?text=' . urlencode($prefilled_message);
        }

        // Get button position and color
        $position = isset($options['button_position']) ? $options['button_position'] : 'bottom-right';
        $color = isset($options['button_color']) ? $options['button_color'] : '#25D366';

        // Output the button HTML
        ?>
        <a href="<?php echo esc_url($whatsapp_url); ?>" 
           class="whatsapp-icon-button <?php echo esc_attr($position); ?>" 
           target="_blank" 
           rel="noopener noreferrer"
           style="background-color: <?php echo esc_attr($color); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="whatsapp-icon">
                <path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </a>
        <?php
    }

    private function should_display_button($options) {
        if (empty($options['display_rules'])) {
            return true;
        }

        switch ($options['display_rules']) {
            case 'home':
                return is_front_page();
            case 'posts':
                return is_single();
            case 'pages':
                return is_page();
            case 'all':
            default:
                return true;
        }
    }
} 