<?php
/*
Plugin Name: Disable Caching Rules
Description: Adds or removes cache disabling rules in .htaccess based on user settings.
Version: 1.0
Author: Author
*/

if (!defined('ABSPATH')) {
    exit;
}

define('DISABLE_CACHING_OPTION', 'disable_caching_enabled');


function disable_caching_update_htaccess() {
    $enabled = get_option(DISABLE_CACHING_OPTION, false);
    $htaccess_path = ABSPATH . '.htaccess';

    if (!file_exists($htaccess_path) || !is_writable($htaccess_path)) {
        error_log("Disable Caching Plugin: Unable to modify .htaccess.");
        return;
    }

    $htaccess_content = file_get_contents($htaccess_path);

    $htaccess_content = preg_replace('/# DISABLE CACHING.*?# END DISABLE CACHING/s', '', $htaccess_content);
    $htaccess_content = trim($htaccess_content);

    if ($enabled) {
        $rules = <<<HTACCESS

# DISABLE CACHING
<IfModule mod_headers.c>
    Header set Cache-Control "no-cache, no-store, must-revalidate, max-age=0"
    Header set Pragma "no-cache"
    Header set Expires "Thu, 1 Jan 1970 00:00:00 GMT"
</IfModule>

<FilesMatch "\.(css|flv|gif|htm|html|ico|jpe|jpeg|jpg|js|mp3|mp4|png|pdf|swf|txt)$">
    <IfModule mod_expires.c>
        ExpiresActive Off
    </IfModule>
    <IfModule mod_headers.c>
        FileETag None
        Header unset ETag
        Header unset Last-Modified
        Header set Pragma "no-cache"
        Header set Cache-Control "max-age=0, no-cache, no-store, must-revalidate"
        Header set Expires "Thu, 1 Jan 1970 00:00:00 GMT"
    </IfModule>
</FilesMatch>
# END DISABLE CACHING

HTACCESS;
        $htaccess_content .= "\n\n" . $rules;
    }

    file_put_contents($htaccess_path, $htaccess_content);
}


function disable_caching_add_settings_field() {
    add_settings_field(
        DISABLE_CACHING_OPTION,
        'Disable Browser Caching',
        'disable_caching_settings_field_callback',
        'general'
    );
    register_setting('general', DISABLE_CACHING_OPTION);
}
add_action('admin_init', 'disable_caching_add_settings_field');


function disable_caching_settings_field_callback() {
    $enabled = get_option(DISABLE_CACHING_OPTION, false);
    echo '<input type="checkbox" name="'.DISABLE_CACHING_OPTION.'" value="1" ' . checked(1, $enabled, false) . '>';
}

add_action('update_option_'.DISABLE_CACHING_OPTION, 'disable_caching_update_htaccess');


function disable_caching_activate() {
    add_option(DISABLE_CACHING_OPTION, false);
}
register_activation_hook(__FILE__, 'disable_caching_activate');


function disable_caching_deactivate() {
    delete_option(DISABLE_CACHING_OPTION);
    disable_caching_update_htaccess();
}
register_deactivation_hook(__FILE__, 'disable_caching_deactivate');


function disable_caching_uninstall() {
    delete_option(DISABLE_CACHING_OPTION);
    disable_caching_update_htaccess();
}
register_uninstall_hook(__FILE__, 'disable_caching_uninstall');