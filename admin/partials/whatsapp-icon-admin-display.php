<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://raihanahmed.info
 * @since      1.0.0
 *
 * @package    Easy_Social_Chat
 * @subpackage Easy_Social_Chat/admin/partials
 */
?>

<div class="wrap">
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" action="options.php">
        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        $options = get_option('whatsapp_icon_options');
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr($this->plugin_name); ?>-whatsapp_number">
                        <?php esc_html_e('WhatsApp Number', 'easy-social-chat'); ?>
                    </label>
                </th>
                <td>
                    <input type="text" 
                           id="<?php echo esc_attr($this->plugin_name); ?>-whatsapp_number" 
                           name="whatsapp_icon_options[whatsapp_number]" 
                           value="<?php echo esc_attr($options['whatsapp_number'] ?? ''); ?>" 
                           class="regular-text" />
                    <p class="description">
                        <?php esc_html_e('Enter your WhatsApp number in international format without +, spaces, or special characters.', 'easy-social-chat'); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr($this->plugin_name); ?>-prefilled_message">
                        <?php esc_html_e('Pre-filled Message', 'easy-social-chat'); ?>
                    </label>
                </th>
                <td>
                    <textarea id="<?php echo esc_attr($this->plugin_name); ?>-prefilled_message" 
                              name="whatsapp_icon_options[prefilled_message]" 
                              class="large-text" 
                              rows="3"><?php echo esc_textarea($options['prefilled_message'] ?? ''); ?></textarea>
                    <p class="description">
                        <?php esc_html_e('Enter a default message that will appear when users click the WhatsApp icon.', 'easy-social-chat'); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr($this->plugin_name); ?>-button_position">
                        <?php esc_html_e('Button Position', 'easy-social-chat'); ?>
                    </label>
                </th>
                <td>
                    <select id="<?php echo esc_attr($this->plugin_name); ?>-button_position" 
                            name="whatsapp_icon_options[button_position]">
                        <option value="bottom-right" <?php selected(($options['button_position'] ?? ''), 'bottom-right'); ?>>
                            <?php esc_html_e('Bottom Right', 'easy-social-chat'); ?>
                        </option>
                        <option value="bottom-left" <?php selected(($options['button_position'] ?? ''), 'bottom-left'); ?>>
                            <?php esc_html_e('Bottom Left', 'easy-social-chat'); ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr($this->plugin_name); ?>-button_color">
                        <?php esc_html_e('Button Color', 'easy-social-chat'); ?>
                    </label>
                </th>
                <td>
                    <input type="color" 
                           id="<?php echo esc_attr($this->plugin_name); ?>-button_color" 
                           name="whatsapp_icon_options[button_color]" 
                           value="<?php echo esc_attr($options['button_color'] ?? '#25D366'); ?>" />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo esc_attr($this->plugin_name); ?>-display_rules">
                        <?php esc_html_e('Display Rules', 'easy-social-chat'); ?>
                    </label>
                </th>
                <td>
                    <select id="<?php echo esc_attr($this->plugin_name); ?>-display_rules" 
                            name="whatsapp_icon_options[display_rules]">
                        <option value="all" <?php selected(($options['display_rules'] ?? ''), 'all'); ?>>
                            <?php esc_html_e('All Pages', 'easy-social-chat'); ?>
                        </option>
                        <option value="home" <?php selected(($options['display_rules'] ?? ''), 'home'); ?>>
                            <?php esc_html_e('Homepage Only', 'easy-social-chat'); ?>
                        </option>
                        <option value="posts" <?php selected(($options['display_rules'] ?? ''), 'posts'); ?>>
                            <?php esc_html_e('Posts Only', 'easy-social-chat'); ?>
                        </option>
                        <option value="pages" <?php selected(($options['display_rules'] ?? ''), 'pages'); ?>>
                            <?php esc_html_e('Pages Only', 'easy-social-chat'); ?>
                        </option>
                    </select>
                </td>
            </tr>
        </table>
        <?php submit_button(esc_html__('Save Settings', 'easy-social-chat')); ?>
    </form>
</div> 