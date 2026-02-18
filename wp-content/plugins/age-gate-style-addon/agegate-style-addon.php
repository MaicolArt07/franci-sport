<?php
/*
Plugin Name: AgeGate Style Addon
Description: Add-on for Age Gate modal styles select.
Version: 1.0
Author: Enentyr
*/

if (!defined('ABSPATH')) {
    exit; 
}

require_once plugin_dir_path(__FILE__) . 'includes/class-style-addon.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-custom-import.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-style-import.php';


use AgeGate\Addon\StyleAddon;
use AgeGate\Addon\StyleImport;
use AgeGate\Addon\CustomImport;

new StyleAddon();
new StyleImport();
new CustomImport();