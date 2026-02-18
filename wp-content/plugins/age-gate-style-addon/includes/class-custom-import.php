<?php

namespace AgeGate\Addon;

use AgeGate\Common\Form\Validation;
use AgeGate\Common\Immutable\Constants as Immutable;

class CustomImport
{
    public function __construct()
    {
        add_action('admin_post_custom_age_gate_import', [$this, 'custom_import_action']);
    }

    public function custom_import_action()
    {
        if (!current_user_can(Immutable::IMPORT)) {
            wp_die('Disallowed action');
        }

        $selected_style = sanitize_text_field($_POST['selected_style']);
        update_option('agegate_selected_style', $selected_style);

        $file_path = plugin_dir_path(__DIR__) . "assets/styles/{$selected_style}.json";

        if (!file_exists($file_path)) {
            wp_die('File not found.');
        }

        $_FILES['ag_settings_import'] = [
            'tmp_name' => $file_path,
            'name'     => basename($file_path),
            'type'     => 'application/json',
            'error'    => UPLOAD_ERR_OK,
            'size'     => filesize($file_path),
        ];

        $validator = new Validation;
        $validator->validation_rules([
            'ag_settings_import' => [
                'required_file',
                'extension' => [
                    'json'
                ],
            ],
            'ag_settings_import.type' => 'equals,application/json',
            'data' => 'valid_json_string',
        ]);

        $valid_data = $validator->run(array_merge($_POST, $_FILES, ['data' => file_get_contents($file_path)]));
        if ($validator->errors()) {
            $this->redirect($_POST['_wp_http_referer'], 0, 'tools');
        }

        $data = $validator->sanitize(json_decode($valid_data['data'], true));

        if (isset($data['options']['appearance']['logo'])) {
            $logo_id = intval($data['options']['appearance']['logo']);
            $style_id = str_replace('style', '', $selected_style);
            $new_logo_id = $this->check_and_upload_logo($logo_id, $style_id);

            if ($new_logo_id !== $logo_id) {
                $data['options']['appearance']['logo'] = $new_logo_id;
            }
        }

        $failed = [];
        foreach ($data['options'] ?? [] as $option => $values) {
            if (Immutable::AGE_GATE_OPTIONS[$option] ?? false) {
                update_option(Immutable::AGE_GATE_OPTIONS[$option], $values);
            } else {
                $failed[] = wp_generate_uuid4();
            }
        }

        $this->redirect($_POST['_wp_http_referer'], 1, 'tools');
    }

    private function check_and_upload_logo($logo_id, $style_id)
    {
        $image_title = "ag-18-img-style-{$style_id}.svg";

        $existing_image = $this->get_image_by_title($image_title);
        if ($existing_image) {
            return $existing_image->ID;
        }

        $logo_path = plugin_dir_path(__DIR__) . "assets/img/{$image_title}";
        if (!file_exists($logo_path)) {
            wp_die("Logo file not found at $logo_path");
        }

        $temp_file = wp_tempnam($logo_path);
        if (!$temp_file) {
            wp_die("Could not create a temporary file for the logo.");
        }
        copy($logo_path, $temp_file);

        $file_array = [
            'name'     => $image_title,
            'tmp_name' => $temp_file,
        ];

        $new_logo_id = media_handle_sideload($file_array, 0, null, [
            'post_title' => $image_title
        ]);

        unlink($temp_file);

        if (is_wp_error($new_logo_id)) {
            wp_die('Failed to upload logo');
        }

        return $new_logo_id;
    }

    private function get_image_by_title($title)
    {
        $args = [
            'post_type'   => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => 1,
            'title'       => $title,
        ];

        $query = new \WP_Query($args);
        if ($query->have_posts()) {
            return $query->posts[0];
        }

        return null; 
    }

    private function redirect($url, $status, $context)
    {
        wp_safe_redirect(add_query_arg([
            'import_status' => $status,
            'import_context' => $context,
        ], $url));
        exit;
    }
}
