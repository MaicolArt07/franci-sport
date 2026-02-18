<?php
if (!defined('ABSPATH')) {
    exit;
}


add_action('wp_loaded', function () {
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
});


add_action('template_redirect', function () {
    if (!is_feed() || is_404()) {
        return;
    }

    if (isset($_GET['feed'])) {
        wp_redirect(esc_url_raw(remove_query_arg('feed')), 301);
        exit;
    }

    global $wp_rewrite;
    $struct = (!is_singular() && is_comment_feed()) ? $wp_rewrite->get_comment_feed_permastruct() : $wp_rewrite->get_feed_permastruct();
    $struct = preg_quote($struct, '#');
    $struct = str_replace('%feed%', '(\\w+)?', $struct);
    $struct = preg_replace('#/+#', '/', $struct);

    $requested_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $requested_url = esc_url($requested_url);
    $new_url = esc_url(preg_replace('#' . $struct . '/?$#', '', $requested_url));
    
    if ($new_url !== $requested_url) {
        wp_redirect(esc_url_raw($new_url), 301);
        exit;
    }
});
