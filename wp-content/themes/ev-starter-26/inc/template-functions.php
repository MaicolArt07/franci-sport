<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ev-starter
 */


function add_custom_acf_css_to_all_edit_pages()
{
    $screen = get_current_screen();

    echo "<style>
        .dropdown.open .dropdown-menu {
            display: block;
        }
    </style>";

    if ($screen->base === 'post' && $screen->is_block_editor == true) {
        echo "<style>
            /* Use the value from the ACF field */
            .wp-admin .editor-styles-wrapper {
                    background-color: #000214;
                    background-size: 120px 120px;
                    background-repeat: repeat;
                    background-repeat: repeat;
                    background-position-y: -25px;
            }
            .wp-block {
                max-width: 1024px;
            }

            .wp-block-post-title {
                margin-bottom: 3rem;
                text-align:center;
                color: #Fff;
            }
        </style>";
    }
}
add_action('admin_head', 'add_custom_acf_css_to_all_edit_pages');

function add_referrer_policy_header()
{
    header('Referrer-Policy: no-referrer');
}
add_action('send_headers', 'add_referrer_policy_header');


function my_custom_menu_item_output($title, $item, $args, $depth) {
    $icon = get_field('menu_item_icon', $item);

    if ($icon) {
        $icon_html = '<img src="' . esc_url($icon) . '" alt="' . esc_attr($item->title) . '" class="menu-icon" width="24px"/>';
        $title = $icon_html . $title;
    }

    return $title;
}

add_filter('nav_menu_item_title', 'my_custom_menu_item_output', 10, 4);

