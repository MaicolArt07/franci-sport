<?php

/**
 * Save Fields
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path) {
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

/**
 * Load Fields
 */
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}


/**
 * Load Blocks
 */
function av_load_blocks() {
    $blocks = get_blocks();
    foreach( $blocks as $block ) {
        $block_json_path = get_template_directory() . '/template-parts/blocks/' . $block . '/block.json';
        $init_path = get_template_directory() . '/template-parts/blocks/' . $block . '/init.php';

        if ( file_exists( $block_json_path ) ) {
            register_block_type( $block_json_path );

            if ( file_exists( $init_path ) ) {
                include_once $init_path;
            }
        }
    }
}
add_action( 'init', 'av_load_blocks', 5 );


/**
 * Enqueue blocks assets
 */
function av_enqueue_blocks_assets() {
    $blocks = get_blocks();
	global $post;

    $use_page_template = get_field('use_page_template');
    $template_post = $use_page_template ? get_post($use_page_template) : null;

    foreach( $blocks as $block ) {
		$block_name = 'ev/' . $block;
        $style_path = get_template_directory() . '/template-parts/blocks/' . $block . '/style.css';

        if ( file_exists( $style_path ) && (has_block( $block_name, $post->post_content ) || ($template_post && $template_post->post_content)) ) {
			wp_register_style( 'block-' . $block, get_template_directory_uri() . '/template-parts/blocks/' . $block . '/style.css', array(), filemtime( $style_path ) );
		}
    }
}
add_action( 'wp_enqueue_scripts', 'av_enqueue_blocks_assets', 5 );

function av_gutenberg_editor_blocks_assets() {
	$blocks = get_blocks();

    foreach( $blocks as $block ) {
        $style_path = get_template_directory() . '/template-parts/blocks/' . $block . '/style.css';

        if ( file_exists( $style_path ) ) {
			wp_enqueue_style( 'block-' . $block, get_template_directory_uri() . '/template-parts/blocks/' . $block . '/style.css', array(), filemtime( $style_path ) );
		}
    }
}
add_action( 'enqueue_block_editor_assets', 'av_gutenberg_editor_blocks_assets' );


/**
 * Load ACF field groups for blocks
 */
function av_load_acf_field_group( $paths ) {
	$blocks = get_blocks();
	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/template-parts/blocks/' . $block;
	}
	return $paths;
}
add_filter( 'acf/settings/load_json', 'av_load_acf_field_group' );

/**
 * Get Blocks
 */
function get_blocks() {
	$blocks = scandir( get_template_directory() . '/template-parts/blocks/' );
	$blocks = array_values( array_diff( $blocks, array( '..', '.', '.DS_Store', '_base-block' ) ) );
	return $blocks;
}


/**
 * Enqueue global styles and scripts to gutenberg
 */
function av_gutenberg_assets() {
    wp_enqueue_style( 'grid', get_stylesheet_directory_uri() . '/css/bootstrap-grid.min.css', array(), 1.0 );
	wp_enqueue_style( 'av-style', get_stylesheet_uri(), array() );
}
add_action( 'enqueue_block_editor_assets', 'av_gutenberg_assets' );


function set_acf_settings() {
    acf_update_setting( 'enable_shortcode', true );
}
add_action( 'acf/init', 'set_acf_settings' );



// Set first Page Template by default
function ev_acf_load_post_object_default( $field ) {
    $args = array(
        'post_type'      => 'page_templates',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'ASC'
    );
    
    $query = new WP_Query($args);

    if ( $query->have_posts() ) {
        $query->the_post();
        $field['default_value'] = get_the_ID();
    }
    
    wp_reset_postdata();
    
    return $field;
}
add_filter('acf/load_field/name=use_page_template', 'ev_acf_load_post_object_default');


// function update_acf_for_betting_pages() {
//     // Define the category slug and the ACF field value you want to update
//     $category_slug = 'betting';
//     $acf_field_name = 'use_page_template';
//     $acf_value = 22398;

//     // Query all pages in the 'betting' category
//     $args = array(
//         'post_type' => 'page', // Query only pages
//         'posts_per_page' => -1, // Get all matching posts
//         'category_name' => $category_slug, // Use category slug to filter
//     );

//     $query = new WP_Query($args);

//     if ($query->have_posts()) {
//         while ($query->have_posts()) {
//             $query->the_post();
//             $post_id = get_the_ID();

//             // Update the ACF field for the post
//             update_field($acf_field_name, $acf_value, $post_id);

//             // Optionally, print a message for each update (useful for debugging)
//             echo 'Updated post ID ' . $post_id . ' with ACF field ' . $acf_field_name . ' value of ' . $acf_value . '<br>';
//         }
//     }

//     // Reset post data after the loop
//     wp_reset_postdata();
// }
// // Only run this function once by hooking it to 'init'
// add_action('init', 'update_acf_for_betting_pages');