<?php
/**
 * Plugin Name: Betting Management Table + Betting Pages Import + Safe Betting Template
 * Description: A plugin to manage Betting Management custom post type and custom fields. Betting Pages Import.
 * Version: 6.0
 * Author: Eventyr
 */


include_once plugin_dir_path(__FILE__) . 'betting-links-updater.php';
new Betting_Links_Updater();


// Register Admin Menu Page
add_action('admin_menu', 'betting_management_add_admin_page');
function betting_management_add_admin_page() {
    add_menu_page(
        'Betting Management Table',
        'Betting Management Table',
        'manage_options',
        'betting-management-meta-data',
        'betting_management_display_meta_data_table',
        'dashicons-admin-generic'
    );

    add_submenu_page(
        'betting-management-meta-data',
        'Betting Management Settings',
        'Settings',
        'manage_options',
        'betting-management-settings',
        'betting_management_settings_page_callback'
    ); 

    add_submenu_page(
        'betting-management-meta-data',  // Parent slug (this will show under the Betting Management Table menu)
        'Betting Safe Template',         // Page title
        'Betting Safe Template',         // Menu title
        'manage_options',                // Capability required
        'betting-safe-template',         // Slug for this page
        'betting_safe_template_page_callback' // Callback function to display the page content
    );    
}

// Enqueue Scripts and Styles
add_action('admin_enqueue_scripts', 'betting_management_enqueue_scripts');
function betting_management_enqueue_scripts($hook) {
    if (!in_array($hook, ['toplevel_page_betting-management-meta-data', 'betting-management-settings'])) {
        return;
    }

    // Enqueue DataTables CSS and JS
    wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css');
    wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js', ['jquery'], null, true);

    // Enqueue custom styles and scripts
    wp_enqueue_style('betting-management-css', plugin_dir_url(__FILE__) . 'betting-management-style.css');
    wp_enqueue_script('betting-management-js', plugin_dir_url(__FILE__) . 'betting-management-script.js', ['jquery', 'datatables-js'], null, true);

    wp_enqueue_media();
}


add_action('init', 'initialize_custom_post_types_and_taxonomy');
function initialize_custom_post_types_and_taxonomy() {
    register_post_type('betting', [
        'labels' => [
            'name' => 'Betting',
            'singular_name' => 'Bet',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'betting'],
        'supports' => ['title', 'custom-fields', 'thumbnail']
    ]);
}


add_action( 'acf/include_fields', 'add_betting_fields' );
function add_betting_fields() {
    if (function_exists('acf_add_local_field_group') ) {
        acf_add_local_field_group( array(
            'key' => 'group_667e75f3e23af',
            'title' => 'Betting',
            'fields' => array(
                array(
                    'key' => 'field_6697e7dd2cbef',
                    'label' => 'Offer Number',
                    'name' => 'offer_number',
                    'type' => 'number',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                ),
                array(
                    'key' => 'field_667e75f483bfc',
                    'label' => 'Offer Url',
                    'name' => 'offer_url',
                    'type' => 'url',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_66828b771e70b',
                    'label' => 'Offer Badge',
                    'name' => 'offer_badge',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_667e78644bdc1',
                    'label' => 'Offer Sub Title',
                    'name' => 'offer_sub_title',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_667e78aeb50b2',
                    'label' => 'Offer Description',
                    'name' => 'offer_description',
                    'type' => 'wysiwyg',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
                array(
                    'key' => 'field_6697e7fa2cbf0',
                    'label' => 'Offer Options',
                    'name' => 'offer_options',
                    'type' => 'wysiwyg',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
                array(
                    'key' => 'field_66828a5e804cc',
                    'label' => 'Rating Title',
                    'name' => 'rating_title',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_66828a69804cd',
                    'label' => 'Rating Score',
                    'name' => 'rating_score',
                    'type' => 'number',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'min' => 1,
                    'max' => 10,
                    'step' => '0.1',
                ),
                array(
                    'key' => 'field_667e79489abf4',
                    'label' => 'Button Label',
                    'name' => 'button_label',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_66828a26984b8',
                    'label' => 'Link Label',
                    'name' => 'link_label',
                    'type' => 'text',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
                array(
                    'key' => 'field_669a6cc48a8c4',
                    'label' => 'Payment Methods',
                    'name' => 'payment_methods',
                    'type' => 'image',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'all',
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_669a6cea7c4c4',
                    'label' => 'Payment Methods Mobile',
                    'name' => 'payment_methods_mobile',
                    'type' => 'image',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'all',
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_669a6cea7c7c4',
                    'label' => 'Logo background',
                    'name' => 'logo_background',
                    'type' => 'color_picker',
                    'default_value' => '#202020',
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'betting',
                    ),
                ),
            ),
        ));
    }
}


function betting_safe_template_page_callback() {
    // Get the current value of the "Enable Safe Template" option (default to false for disabling)
    $is_template_disabled = get_option('betting_safe_template_disabled', false);

    // If the form is submitted, update the option value
    if (isset($_POST['save_settings'])) {
        $is_template_disabled = isset($_POST['disable_safe_template']) ? true : false;
        update_option('betting_safe_template_disabled', $is_template_disabled);
    }

    // Query the default betting template
    $default_betting_template = new WP_Query(array(
        'post_type' => 'betting_template',
        'posts_per_page' => 1,
        'post_status' => 'publish',
    ));

    $edit_link = '';
    if ($default_betting_template->have_posts()) {
        $default_betting_template->the_post();
        $edit_link = get_edit_post_link(get_the_ID());
        wp_reset_postdata();
    }

    // Display the form
    echo '<div class="wrap">';
    echo '<h1>Betting Safe Template Settings</h1>';
    echo '<form method="POST">';
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th scope="row"><label for="disable_safe_template">Disable Safe Template</label></th>';
    echo '<td>';
    // Checkbox for disabling the template
    echo '<input type="checkbox" id="disable_safe_template" name="disable_safe_template" ' . checked($is_template_disabled, true, false) . ' />';
    echo '</td>';
    echo '</tr>';
    echo '</table>';

    // Add the submit button
    echo '<p><input type="submit" name="save_settings" class="button-primary" value="Save Settings"></p>';
    echo '</form>';

    // Display the edit link if available
    if ($edit_link) {
        echo '<p><a href="' . esc_url($edit_link) . '" class="button">Edit Default Betting Template</a></p>';

    } else {
        echo '<p>No default betting template found. Please create one in the <a href="' . esc_url(admin_url('edit.php?post_type=betting_template')) . '">Betting Templates</a> section.</p>';
    }

    echo '</div>';

    // Register or unregister the post type based on the option value
    betting_template_post_type();
}


// Register Betting Template post type
function betting_template_post_type() {
    $is_template_disabled = get_option('betting_safe_template_disabled', false);

    if (!$is_template_disabled) {
        $args = array(
            'public' => true,
            'label'  => 'Betting Templates',
            'supports' => array('title', 'editor'),
            'show_in_rest' => true,
        );
        register_post_type('betting_template', $args);
    } else {
        unregister_post_type('betting_template');
    }
}
add_action('init', 'betting_template_post_type');


// Update betting pages content when betting template is saved
function update_betting_pages_when_template_changes($post_id, $post, $update) {
    $is_template_disabled = get_option('betting_safe_template_disabled', false);
    if ($is_template_disabled) {
        return;
    }
    
    if ($post->post_type !== 'betting_template' || $post->post_status !== 'publish') {
        return;
    }
    
    $template_content = $post->post_content;
    
    $args = array(
        'post_type' => 'page',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'category_name' => 'betting'
    );
    
    $betting_pages = get_posts($args);
    
    foreach ($betting_pages as $page) {
        if ($page->post_content !== $template_content) {
            $page_update = array(
                'ID' => $page->ID,
                'post_content' => $template_content,
            );
            
            remove_action('save_post', 'update_betting_pages_when_template_changes', 10);
            wp_update_post($page_update);
            add_action('save_post', 'update_betting_pages_when_template_changes', 10, 3);
        }
    }
}
add_action('save_post', 'update_betting_pages_when_template_changes', 10, 3);



function add_default_content_to_betting_template($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if ($post->post_type !== 'betting_template') {
        return;
    }

    if (!empty($post->post_content)) {
        return;
    }

    $default_content = '
        <!-- wp:ev/content-box {"name":"ev/content-box","data":{"border_radius":"16px 16px 0 0","_border_radius":"field_6728ac2fd6bb6"},"mode":"preview","alignText":"left"} -->
        <!-- wp:heading {"level":1,"className":"custom-size"} -->
        <h1 class="wp-block-heading custom-size">[acf field="casino_name"] - La Référence pour les Paris Sportifs 
        en Ligne</h1>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p><strong>[acf field="casino_name"] - Paris Sportifs</strong>[acf field="casino_name"] offre une expérience fluide et sécurisée pour parier sur divers événements sportifs. Profitez d’une interface intuitive et de cotes compétitives pour des paris captivants.</p>
        <!-- /wp:paragraph -->
        <!-- /wp:ev/content-box -->
        <!-- wp:ev/betting-loop {"name":"ev/betting-loop","data":{"section_title":"Liste organisée de sites de paris sportifs avec certaines de nos offres préférées","_section_title":"field_6728909d357d9","vertical_layout":"0","_vertical_layout":"field_670e56f245f99"},"mode":"edit","alignText":"left"} /-->

        <!-- wp:ev/content-box {"name":"ev/content-box","data":{"border_radius":"0 0 16px 16px","_border_radius":"field_6728ac2fd6bb6"},"mode":"preview","alignText":"left"} -->
        <!-- wp:heading -->
        <h2 class="wp-block-heading">Pourquoi choisir [acf field="casino_name"] ?</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph -->
        <p>Spécialisé dans les paris sportifs, [acf field="casino_name"] offre une immersion totale et une expertise unique.</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph -->
        <p>Avantages :</p>
        <!-- /wp:paragraph -->

        <!-- wp:list -->
        <ul class="wp-block-list"><!-- wp:list-item -->
        <li>Connaissances utiles : Pariez avec stratégie grâce aux stats.</li>
        <!-- /wp:list-item -->

        <!-- wp:list-item -->
        <li>Engagement : Vivez l’émotion des matchs en direct.</li>
        <!-- /wp:list-item -->

        <!-- wp:list-item -->
        <li>Diversité : Large choix de disciplines et types de paris.</li>
        <!-- /wp:list-item -->

        <!-- wp:list-item -->
        <li>Moins aléatoire : Stratégie plutôt que hasard</li>
        <!-- /wp:list-item --></ul>
        <!-- /wp:list -->

        <!-- wp:paragraph -->
        <p>Les jeux de casino ne sont pas encore disponibles, mais [acf field="casino_name"] garantit une expérience de pari sportive fiable et responsable.</p>
        <!-- /wp:paragraph -->

        <!-- wp:heading -->
        <h2 class="wp-block-heading">Pourquoi Choisir les Paris Sportifs avec [acf field="casino_name"] ?</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph -->
        <p>Chez [acf field="casino_name"], l’accent est mis sur l’excellence des paris sportifs. Bien que les jeux de casino ne soient pas encore disponibles, [acf field="casino_name"] se concentre sur ce qu’il fait de mieux : proposer une offre complète et experte en paris sportifs.</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph -->
        <p><strong>Voici quelques avantages des paris sportifs par rapport aux jeux de casino :<br></strong>Des paris stratégiques : Contrairement aux jeux de hasard, les paris sportifs permettent d\'utiliser vos connaissances et analyses des compétitions pour maximiser vos chances de succès.</p>
        <!-- /wp:paragraph -->
        ';

    wp_update_post([
        'ID' => $post_id,
        'post_content' => $default_content,
    ]);
}

add_action('save_post', 'add_default_content_to_betting_template', 10, 3);

// Display Meta Data Table
function betting_management_display_meta_data_table() {
    global $wpdb;

    // Handle form submission to save data
    if (isset($_POST['betting_management_save_data'])) {
        check_admin_referer('betting_management_save_data_nonce');

        if (!empty($_POST['meta_data']) && is_array($_POST['meta_data'])) {
            foreach ($_POST['meta_data'] as $post_id => $fields) {
                foreach ($fields as $field_key => $field_value) {
                    $field_value = wp_kses_post($field_value);

                    if ($field_key === 'featured_image') {
                        // Update the featured image
                        set_post_thumbnail($post_id, $field_value);
                    } else {
                        update_field($field_key, $field_value, $post_id);
                    }
                }
            }
            echo '<div class="updated notice"><p>Meta data updated successfully.</p></div>';
        }
    }

    $bettings = get_posts(['post_type' => 'betting', 'numberposts' => -1]);
    $selected_fields = get_option('betting_management_custom_fields', []);

    echo '<form method="POST">';
    wp_nonce_field('betting_management_save_data_nonce');
    echo '<h2>Save Data</h2>';
    echo '<input type="submit" name="betting_management_save_data" class="button button-primary" value="Save Data">';
    echo '<div class="betting-management-table-wrapper">';
    echo '<table id="meta-data-table" class="widefat">';
    echo '<thead><tr>';
    echo '<th>Betting Title</th>';
    echo '<th>Featured Image</th>'; // Add column for featured image

    foreach ($selected_fields as $field_key) {
        $field = get_field_object($field_key);

        if ($field) {
            echo '<th>' . esc_html($field['label']) . '</th>';
        } else {
            echo '<th>' . esc_html($field_key) . '</th>';
        }
    }
    echo '</tr></thead>';

    echo '<tbody>';
    foreach ($bettings as $betting) {
        echo '<tr>';
        echo '<td class="betting-title"><a target="_blank" href="' . esc_url(get_edit_post_link($betting->ID)) . '">' . esc_html($betting->post_title) . '</a></td>';

        $featured_image_id = get_post_thumbnail_id($betting->ID);
        $featured_image_url = $featured_image_id ? wp_get_attachment_image_url($featured_image_id, 'full') : '';
        ?>
<td>
    <div class="table-image-holder">
        <?php if ($featured_image_url): ?>
            <img 
                src="<?php echo esc_url($featured_image_url); ?>" 
                alt="Featured Image" 
                id="featured-image-preview-<?php echo esc_attr($betting->ID); ?>" 
                class="featured-image-preview" 
                style="max-width:100px;">
        <?php else: ?>
            <img 
                src="" 
                alt="No Image" 
                id="featured-image-preview-<?php echo esc_attr($betting->ID); ?>" 
                class="featured-image-preview" 
                style="max-width:100px; display:none;">
            <p>No Image</p>
        <?php endif; ?>
        <button 
            type="button" 
            class="button betting-management-upload-button" 
            data-post-id="<?php echo esc_attr($betting->ID); ?>" 
            data-field="featured_image">
            Upload Image
        </button>
        <input 
            type="hidden" 
            name="meta_data[<?php echo esc_attr($betting->ID); ?>][featured_image]" 
            value="<?php echo esc_attr($featured_image_id); ?>" 
            id="featured-image-id-<?php echo esc_attr($betting->ID); ?>" 
            class="featured-image-id">
    </div>
</td>

    <?php 
        


        foreach ($selected_fields as $field) {
            $field_object = get_field_object($field);
            $meta_value = get_field($field, $betting->ID);

            if ($field_object['type'] === 'image') {
                $image_url = is_array($meta_value) ? wp_get_attachment_image_url($meta_value['id'], 'full') : wp_get_attachment_image_url($meta_value, 'full');

                echo '<td><div class="table-image-holder">';
                echo '<img src="' . esc_url($image_url) . '" alt="" style="max-width: 100%; height: 50px; object-fit:contain;" class="meta-image" data-field="' . esc_attr($field) . '" data-post-id="' . esc_attr($betting->ID) . '">';
                echo '<button type="button" class="button betting-management-upload-button" data-field="' . esc_attr($field) . '" data-post-id="' . esc_attr($betting->ID) . '">Upload Image</button>';
                echo '<input type="hidden" name="meta_data[' . esc_attr($betting->ID) . '][' . esc_attr($field) . ']" value="' . esc_attr(is_array($meta_value) ? $meta_value['id'] : $meta_value) . '" class="meta-image-id">';
                echo '</div></td>';
            } else {
                echo '<td><textarea name="meta_data[' . esc_attr($betting->ID) . '][' . esc_attr($field) . ']" rows="3" cols="15">' . esc_textarea($meta_value) . '</textarea></td>';
            }
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '<input type="submit" name="betting_management_save_data" class="button button-primary" value="Save Data">';
    echo '</form>';

    // Export & Import Forms
    echo '<div class="casino-management-actions">';
    echo '<form method="POST" action="' . esc_url(admin_url('admin-post.php')) . '">';
    wp_nonce_field('export_meta_data_csv', 'export_meta_data_nonce');
    echo '<input type="hidden" name="action" value="export_meta_data_csv">';
    echo '<p><h3>Export Table Data to CSV:</h3></p><input type="submit" class="button button-secondary" value="Export CSV">';
    echo '</form>';

    echo '<form method="POST" enctype="multipart/form-data" action="' . esc_url(admin_url('admin-post.php')) . '">';
    wp_nonce_field('import_meta_data_csv', 'import_meta_data_nonce');
    echo '<input type="hidden" name="action" value="import_meta_data_csv">';
    echo '<p><h3>Import Table Data from CSV:</h3></p><input type="file" name="meta_data_csv" />';
    echo '<input type="submit" class="button button-secondary" value="Import CSV">';
    echo '</form>';
    echo '</div>';
}
// Display Settings Page
function betting_management_settings_page_callback() {
    $selected_fields = get_option('betting_management_custom_fields', []);
    
    $field_groups = acf_get_field_groups(['post_type' => 'betting']);
    
    echo '<div class="wrap"><h2>Select Fields to Display</h2>';
    echo '<form method="POST" action="' . esc_url(admin_url('admin-post.php')) . '">';
    wp_nonce_field('betting_management_settings_nonce');
    echo '<input type="hidden" name="action" value="betting_management_save_settings">';

    foreach ($field_groups as $group) {
        $fields = acf_get_fields($group['key']);

        if ($fields) {
            echo '<h3>' . esc_html($group['title']) . '</h3>';
            foreach ($fields as $field) {
                $is_checked = in_array($field['key'], $selected_fields);
                echo '<label><input type="checkbox" name="betting_management_custom_fields[]" value="' . esc_attr($field['key']) . '" ' . ($is_checked ? 'checked' : '') . '> ' . esc_html($field['label']) . '</label><br>';
            }
        }
    }

    echo '<input type="submit" class="button button-primary" value="Save Settings">';
    echo '</form></div>';

    if (isset($_GET['settings_updated'])) {
        echo '<div class="updated notice"><p>Settings updated successfully.</p></div>';
    }
}

// Save Selected Fields in Settings Page
add_action('admin_post_betting_management_save_settings', 'betting_management_save_settings');
function betting_management_save_settings() {
    check_admin_referer('betting_management_settings_nonce');

    $selected_fields = isset($_POST['betting_management_custom_fields']) ? array_map('sanitize_text_field', $_POST['betting_management_custom_fields']) : [];
    update_option('betting_management_custom_fields', $selected_fields);

    wp_redirect(add_query_arg('settings_updated', 'true', wp_get_referer()));
    exit;
}

// Function to handle the CSV export
// Handle Export CSV
add_action('admin_post_export_meta_data_csv', 'betting_export_meta_data_csv');
function betting_export_meta_data_csv() {
    check_admin_referer('export_meta_data_csv', 'export_meta_data_nonce');

    $selected_fields = get_option('betting_management_custom_fields', []);

    if (!is_array($selected_fields) || empty($selected_fields)) {
        wp_redirect(add_query_arg('error', 'no_fields_selected', wp_get_referer()));
        exit;
    }
    $bettings = get_posts(array('post_type' => 'betting', 'numberposts' => -1));

    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=betting-meta-data.csv');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    fputcsv($output, array_merge(['Betting Title'], $selected_fields, ['Featured Image']));

    foreach ($bettings as $betting) {
        $row = [esc_html($betting->post_title)];

        // Process the custom fields
        foreach ($selected_fields as $field) {
            $meta_value = get_field($field, $betting->ID);

            if (is_array($meta_value) && isset($meta_value['url'])) {
                $meta_value = $meta_value['url']; 
            } elseif (is_array($meta_value)) {

                $meta_value = json_encode($meta_value);
            } elseif (is_string($meta_value)) {
                $meta_value = htmlspecialchars_decode($meta_value, ENT_QUOTES);
            }

            $row[] = $meta_value;
        }

        $featured_image_url = get_the_post_thumbnail_url($betting->ID, 'full');
        $row[] = $featured_image_url; 

        // Write the row to the CSV
        fputcsv($output, $row);
    }

    // Close the output stream
    fclose($output);
    exit;
}

// Handle IMPORT CSV
add_action('admin_post_import_meta_data_csv', 'betting_import_meta_data_csv');
function betting_import_meta_data_csv() {
    check_admin_referer('import_meta_data_csv', 'import_meta_data_nonce');

    if (!empty($_FILES['meta_data_csv']['tmp_name'])) {
        $selected_fields = get_option('betting_management_custom_fields', []);

        if (!is_array($selected_fields) || empty($selected_fields)) {
            wp_redirect(add_query_arg('error', 'no_fields_selected', wp_get_referer()));
            exit;
        }

        $csv_file = fopen($_FILES['meta_data_csv']['tmp_name'], 'r');
        fgetcsv($csv_file);

        while (($row = fgetcsv($csv_file)) !== false) {
            $betting_title = sanitize_text_field($row[0]);

            error_log("Processing row for betting title: " . $betting_title);

            $query = new WP_Query([
                'post_type'      => 'betting',
                'title'          => $betting_title,
                'posts_per_page' => 1,
                'post_status'    => 'publish',
            ]);

            $betting = null;
            if ($query->have_posts()) {
                $betting = $query->posts[0];
            } else {
                $betting_id = wp_insert_post([
                    'post_title'   => $betting_title,
                    'post_type'    => 'betting',
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id(),
                ]);

                if (is_wp_error($betting_id)) {
                    error_log('Error creating betting post: ' . $betting_id->get_error_message());
                    return;
                }

                $betting = get_post($betting_id);
                error_log("Created new betting post with ID: " . $betting->ID);
            }

            if (!$betting || !is_a($betting, 'WP_Post')) {
                error_log('Betting post not valid or created');
                continue;
            }

            foreach ($selected_fields as $index => $field) {
                if (!isset($row[$index + 1])) continue;

                $value_to_import = trim($row[$index + 1]);

                error_log("Processing field '$field' with value: $value_to_import");

                if ($field == 'field_667e75f483bfc') {
                    if (filter_var($value_to_import, FILTER_VALIDATE_URL)) {
                        $offer_link = esc_url($value_to_import);
                        error_log("Offer link found: $offer_link");  
                        update_field($field, $offer_link, $betting->ID);
                    } else {
                        error_log("Invalid offer link: $value_to_import");
                    }
                }

                else if (filter_var($value_to_import, FILTER_VALIDATE_URL)) {
                    $image_url = esc_url($value_to_import);
                    $image_id = attachment_url_to_postid($image_url);

                    if (!$image_id) {
                        $image_id = sideload_image($image_url, $betting->ID);
                    }

                    if ($image_id) {
                        update_field($field, $image_id, $betting->ID);
                        error_log("Image for custom field '$field' updated for betting ID: " . $betting->ID);
                    } else {
                        error_log("Failed to sideload image from URL: $image_url for betting ID: " . $betting->ID);
                    }
                }

                else {
                    $value_to_import = wp_kses_post($value_to_import);
                    update_field($field, $value_to_import, $betting->ID);
                    error_log("Field '$field' updated for betting ID: " . $betting->ID);
                }
            }

            // Set the featured image (always the last in CSV row)
            $featured_image_url = esc_url(trim($row[count($row) - 1]));
            if (filter_var($featured_image_url, FILTER_VALIDATE_URL)) {
                $image_id = attachment_url_to_postid($featured_image_url);

                if (!$image_id) {
                    $image_id = sideload_image($featured_image_url, $betting->ID);
                }

                if ($image_id) {
                    if (set_post_thumbnail($betting->ID, $image_id)) {
                        error_log("Featured image successfully set for betting ID: " . $betting->ID);
                    } else {
                        error_log("Failed to set featured image for betting ID: " . $betting->ID);
                    }
                } else {
                    error_log("Failed to sideload featured image from URL: $featured_image_url for betting ID: " . $betting->ID);
                }
            }

            wp_reset_postdata();
        }

        fclose($csv_file);
    }

    wp_redirect(add_query_arg('meta_imported', 'true', wp_get_referer()));
    exit;
}


// Sideload Image Function
function sideload_image($image_url, $post_id) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $tmp = download_url($image_url);
    if (is_wp_error($tmp)) {
        error_log("Image download error: " . $tmp->get_error_message());
        return false;
    }

    $file_array = array(
        'name'     => basename($image_url),
        'tmp_name' => $tmp,
    );

    $image_id = media_handle_sideload($file_array, $post_id);

    @unlink($tmp);

    if (is_wp_error($image_id)) {
        error_log("Sideload error: " . $image_id->get_error_message());
        return false;
    }

    return $image_id;
}

// Helper function to check if a string is JSON
function is_json($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

// Utility function to get post ID by title
function betting_get_post_id_by_title($title) {
    global $wpdb;

    return $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'betting' LIMIT 1", $title));
}

// Callback for Betting Pages page
function betting_pages_page_callback() {
}
    class CSVPageImporter {
    
        public function __construct() {
            add_action('admin_menu', [$this, 'add_admin_menu']);
            add_action('admin_init', [$this, 'handle_file_upload']);
        }
    
        public function add_admin_menu() {
            add_menu_page(
                'CSV Betting Page Importer', 
                'CSV Betting Page Importer', 
                'manage_options', 
                'csv-page-importer', 
                [$this, 'upload_page']
            );
        }

        public function apply_betting_template_to_page($page_id) {
            // Check if the feature is disabled
            $is_template_disabled = get_option('betting_safe_template_disabled', false);
            if ($is_template_disabled) {
                return false;
            }
            
            // Query the latest published Betting Template
            $args = array(
                'post_type' => 'betting_template',
                'posts_per_page' => 1,
                'post_status' => 'publish',
            );
            $betting_template_query = new WP_Query($args);
            
            if ($betting_template_query->have_posts()) {
                $betting_template_query->the_post();
                $template_content = get_the_content();
                wp_reset_postdata();
                
                wp_update_post([
                    'ID' => $page_id,
                    'post_content' => $template_content
                ]);
                
                return true;
            }
            
            return false;
        }
    
        public function upload_page() {
            ?>
            <div class="wrap">
                <h1>CSV Betting Page Importer</h1>
                <div class="info-file">
                    <strong>Required columns for CSV file: Slug, Casino Name, Page Title, Category</strong>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="csv_file" accept=".csv" required>
                    <?php submit_button('Upload CSV'); ?>
                </form>
            </div>
            <?php
        }
    
        public function handle_file_upload() {
            if (isset($_FILES['csv_file']) && current_user_can('manage_options')) {
                $csv_file = $_FILES['csv_file']['tmp_name'];
                $this->process_csv($csv_file);
            }
        }
    
        public function process_csv($file) {
            if (($handle = fopen($file, 'r')) !== FALSE) {
                $header = fgetcsv($handle);
                $import_count = 0;
        
                while (($data = fgetcsv($handle)) !== FALSE) {
                    $slug = sanitize_title(trim($data[0] ?? ''));
                    $casino_name = sanitize_text_field($data[1] ?? '');
                    $page_title = sanitize_text_field($data[2] ?? '');
                    $category_names = sanitize_text_field($data[3] ?? '');

                    if (empty($slug) || empty($casino_name) || empty($page_title) || empty($category_names)) {
                        error_log("Skipped row: Missing required fields.");
                        continue;
                    }

                    $original_slug = $slug;
                    $counter = 1;
                    while (get_page_by_path($slug)) {
                        $slug = $original_slug . '-' . $counter;
                        $counter++;
                    }

                    $page_id = wp_insert_post([
                        'post_title' => $page_title,
                        'post_name' => $slug,
                        'post_status' => 'publish',
                        'post_type' => 'page',
                    ]);

                    if ($page_id && !is_wp_error($page_id)) {
                        $categories = (strpos($category_names, ',') !== false) ? 
                            array_map('trim', explode(',', $category_names)) : 
                            [trim($category_names)];
                        
                        $category_ids = [];
                        $has_betting_category = false;
                        
                        foreach ($categories as $cat_name) {
                            if (empty($cat_name)) continue;

                            $category = get_category_by_slug(sanitize_title($cat_name));
                            if (!$category) {
                                $cat_id = wp_create_category($cat_name);
                            } else {
                                $cat_id = $category->term_id;
                            }
                            
                            $category_ids[] = $cat_id;
                            
                            if (strtolower($cat_name) === 'betting') {
                                $has_betting_category = true;
                            }
                        }
                        
                        if (!empty($category_ids)) {
                            wp_set_post_categories($page_id, $category_ids);
                        }
                        
                        if (function_exists('update_field')) {
                            update_field('casino_name', $casino_name, $page_id);
                        }
                        
                        if ($has_betting_category) {
                            $this->apply_betting_template_to_page($page_id);
                        }
                        
                        $import_count++;
                    } else {
                        error_log("Failed to create page for slug: " . $slug);
                    }
                }

                fclose($handle);
        
                echo '<div class="notice notice-success"><p>CSV imported successfully! Imported ' . $import_count . ' pages.</p></div>';
            } else {
                echo '<div class="notice notice-error"><p>Failed to open CSV file. Please ensure the file is valid and try again.</p></div>';
            }
        }
        
        
  
    }
    
    new CSVPageImporter();

    function my_plugin_custom_styles() {
        echo '<style>

            .info-file {
                background-color: #f0f0f0;
                padding: 15px;
                border-radius: 5px;
                border: 1px solid #ddd;
                font-size: 16px;
                color: #333;
                margin-bottom: 20px;
            }
            .info-file strong {
                color: #0073aa;
                font-weight: bold;
            }
        </style>';
    }
    add_action('admin_head', 'my_plugin_custom_styles'); 

// JavaScript to Open Media Library and Select Image
add_action('admin_footer', function () {
    ?>
    <script>
jQuery(document).ready(function ($) {
    let mediaUploader;

    $('.betting-management-upload-button').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const field = button.data('field'); // Field name (e.g., featured_image or custom field)
        const postId = button.data('post-id'); // Post ID
        const isFeaturedImage = field === 'featured_image'; // Check if this is for the featured image

        // Selectors for image preview and hidden input field
        const imagePreview = isFeaturedImage
            ? $(`#featured-image-preview-${postId}`) // Featured image preview
            : $(`img.meta-image[data-field="${field}"][data-post-id="${postId}"]`); // Meta image preview
        const imageInput = isFeaturedImage
            ? $(`#featured-image-id-${postId}`) // Hidden input for featured image ID
            : $(`input.meta-image-id[name="meta_data[${postId}][${field}]"]`); // Hidden input for meta image ID

        // Reopen the media uploader if it already exists
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Initialize the media uploader
        mediaUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false, // Allow only one image to be selected
        });

        // When an image is selected
        mediaUploader.on('select', function () {
            const attachment = mediaUploader.state().get('selection').first().toJSON();

            if (attachment && attachment.url) {
                // Update the correct preview and input field
                imagePreview.attr('src', attachment.url).show();
                imageInput.val(attachment.id);
            } else {
                console.error('No image selected or invalid attachment.');
            }
        });

        // Open the uploader
        mediaUploader.open();
    });
});

    </script>
    <?php
});