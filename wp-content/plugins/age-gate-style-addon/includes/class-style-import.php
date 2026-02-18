<?php

namespace AgeGate\Addon;

class StyleImport
{
    public function __construct()
    {
        add_action('wp_head', [$this, 'inline_style']);
    }

    public function inline_style()
    {
        $selected_style = get_option('agegate_selected_style', 'style1');
        $css_file = plugin_dir_path(__DIR__) . "assets/styles/{$selected_style}.css";
        
        if (file_exists($css_file)) {
            echo "<!-- Additional styles for Age Gate modal {$selected_style} -->";
            echo '<style>' . file_get_contents($css_file) . '</style>';
        }
    }
}