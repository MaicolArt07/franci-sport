
<?php

class Betting_Links_Updater {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_submenu_page'), 20);
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_post_update_betting_links', array($this, 'handle_form_submission'));
        add_action('admin_notices', array($this, 'display_admin_notices'));
    }
    
    public function add_submenu_page() {
        add_submenu_page(
            'betting-management-meta-data',
            'Betting Links Update',
            'Betting Links Update',
            'manage_options',
            'betting-links-update',
            array($this, 'render_options_page')
        );
    }
    
    public function register_settings() {
        register_setting(
            'betting_links_options',
            'betting_links_params',
            array(
                'sanitize_callback' => 'sanitize_text_field',
                'default' => '',
            )
        );
    }
    
    public function render_options_page() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        $params = get_option('betting_links_params', '');
        
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <input type="hidden" name="action" value="update_betting_links">
                <?php wp_nonce_field('betting_links_update', 'betting_links_nonce'); ?>
                
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Links params</th>
                        <td>
                            <input type="text" name="betting_links_params" class="regular-text" value="<?php echo esc_attr($params); ?>" />
                            <p class="description">
                                Enter parameters to append to offer URLs. You can use shortcodes like [random count='5'].
                            </p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button('Save Changes & Update Links'); ?>
            </form>
        </div>
        <?php
    }
    
    public function handle_form_submission() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized access');
        }
        
        if (!isset($_POST['betting_links_nonce']) || !wp_verify_nonce($_POST['betting_links_nonce'], 'betting_links_update')) {
            wp_die('Security check failed');
        }
        
        $params = isset($_POST['betting_links_params']) ? sanitize_text_field($_POST['betting_links_params']) : '';
        update_option('betting_links_params', $params);
    

        $result = $this->update_all_betting_links($params);
        
        set_transient('betting_links_update_success', $result['updated'], 30);
        set_transient('betting_links_update_errors', $result['errors'], 30);
        
        wp_redirect(add_query_arg('page', 'betting-links-update', admin_url('admin.php')));
        exit;
    }
    
    public function display_admin_notices() {
        $success_count = get_transient('betting_links_update_success');
        $error_count = get_transient('betting_links_update_errors');

        if ($success_count !== false && $success_count > 0) {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Success!</strong> Updated <?php echo esc_html($success_count); ?> betting offers.</p>
            </div>
            <?php
            delete_transient('betting_links_update_success');
        }

        if ($error_count !== false && $error_count > 0) {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><strong>Error!</strong> Failed to update <?php echo esc_html($error_count); ?> betting offers.</p>
            </div>
            <?php
            delete_transient('betting_links_update_errors');
        }
    }
    
    private function update_all_betting_links($params) {
        $args = array(
            'post_type'      => 'betting',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        );
    
        $betting_posts = get_posts($args);
    
        $updated_posts = array();
        $error_posts   = array();
    
        foreach ($betting_posts as $post_id) {
            try {
                $offer_url = get_post_meta($post_id, 'offer_url', true);
    
                if (empty($offer_url)) {
                    $error_posts[] = $post_id;
                    continue;
                }
    
                $base_url = strtok($offer_url, '?');
    
                $post_specific_params = preg_replace_callback('/\[random count=[\'"]?(\d+)[\'"]?\]/', function ($matches) {
                    return $this->generate_random_string((int)$matches[1]);
                }, $params);
    
                $new_url = $base_url;
                if (!empty($post_specific_params)) {
                    $new_url .= $post_specific_params;
                }
    
                update_post_meta($post_id, 'offer_url', $new_url);
                $updated_posts[] = $post_id;
            } catch (Exception $e) {
                $error_posts[] = $post_id;
            }
        }
    
        set_transient('betting_links_update_success', $updated_posts, 60);
        if (!empty($error_posts)) {
            set_transient('betting_links_update_errors', $error_posts, 60);
        }
    
        return [
            'updated' => count($updated_posts),
            'errors'  => count($error_posts),
        ];
    }
    
    
    private function generate_random_string($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $random_string;
    }
}
