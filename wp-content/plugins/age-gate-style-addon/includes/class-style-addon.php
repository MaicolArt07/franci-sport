<?php

namespace AgeGate\Addon;

class StyleAddon
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    public function add_settings_page()
    {
        add_submenu_page(
            'options-general.php', 
            'AgeGate Style Settings', 
            'AgeGate Style', 
            'manage_options',
            'agegate-style-settings',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page()
    {
        $selected_style = get_option('agegate_selected_style', 'style0');
        $cover_url = plugin_dir_url(__DIR__) . 'assets/covers/';
        
        ?>
        <div class="age-styles-wrap">
            <h1>AgeGate Style Settings</h1>
            <form method="post" action="admin-post.php" enctype="multipart/form-data">
                <?php wp_nonce_field('agegate_style_settings', 'agegate_style_nonce'); ?>
                <input type="hidden" name="action" value="custom_age_gate_import">

                <div class="row">
                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style0" <?php checked($selected_style, 'style0'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style0.png'); ?>" alt="Disable" width="100" height="100">
                            </div>
                        </label>
                    </div>
                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style1" <?php checked($selected_style, 'style1'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style1.png'); ?>" alt="Style 1 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style2" <?php checked($selected_style, 'style2'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style2.png'); ?>" alt="Style 2 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style3" <?php checked($selected_style, 'style3'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style3.png'); ?>" alt="Style 3 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style4" <?php checked($selected_style, 'style4'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style4.png'); ?>" alt="Style 4 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style5" <?php checked($selected_style, 'style5'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style5.png'); ?>" alt="Style 5 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style6" <?php checked($selected_style, 'style6'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style6.png'); ?>" alt="Style 6 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style7" <?php checked($selected_style, 'style7'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style7.png'); ?>" alt="Style 7 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>

                    <div class="col">
                        <label>
                            <input type="radio" name="selected_style" value="style8" <?php checked($selected_style, 'style8'); ?>>
                            <div class="style-preview">
                                <img src="<?php echo esc_url($cover_url . 'style8.png'); ?>" alt="Style 8 Preview" width="100" height="100">
                            </div>
                        </label>
                    </div>
                </div>

                <input type="submit" value="Save Style" class="button button-primary">
            </form>
        </div>
        <?php
    }


    public function enqueue_admin_styles($hook)
    {
        if ($hook !== 'settings_page_agegate-style-settings') {
            return;
        }

        wp_enqueue_style(
            'agegate-admin-style',
            plugin_dir_url(__DIR__) . 'assets/admin-style.css',
            [],
            '1.0'
        );
    }
}