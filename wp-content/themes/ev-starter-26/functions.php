<?php
/**
 * ev-starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ev-starter
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ev_starter_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ev-starter, use a find and replace
		* to change 'ev-starter' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ev-starter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ev-starter' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ev_starter_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ev_starter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ev_starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ev_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'ev_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ev_starter_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ev-starter' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ev-starter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ev_starter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ev_starter_scripts() {
	wp_enqueue_style( 'grid', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
	wp_enqueue_style( 'fa', get_stylesheet_directory_uri() . '/css/fontawesome.min.css', array(), 1.0 );
	wp_enqueue_style( 'fa-solid', get_stylesheet_directory_uri() . '/css/solid.min.css', array(), 1.0 );
    wp_enqueue_style( 'global-style', get_stylesheet_directory_uri() . '/css/global-style.css', array(), 1.0 );
    wp_enqueue_style( 'style-betting', get_stylesheet_directory_uri() . '/template-parts/blocks/betting-loop/style.css', array(), 1.0 );
    wp_enqueue_style( 'style-box', get_stylesheet_directory_uri() . '/template-parts/blocks/content-box/style.css', array(), 1.0 );
    wp_enqueue_style( 'style-suscribite', get_stylesheet_directory_uri() . '/template-parts/blocks/subscribe-form/style.css', array(), 1.0 );
    wp_enqueue_style( 'style-starter', get_stylesheet_directory_uri() . '/style.css', array(), 1.0 );
    wp_enqueue_style( 'script-style', get_stylesheet_directory_uri() . '/css/script-global.js', array(), 1.0 );
	wp_enqueue_style( 'ev-starter-style', get_stylesheet_uri(), array(), null );
	wp_style_add_data( 'ev-starter-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ev-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ev_starter_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * ACF functions.
 */
require get_template_directory() . '/inc/acf.php';


/**
 * Svg
 */
require_once get_template_directory() . '/inc/svg-support.php';


/**
 * Disable feeds.
 */
require_once get_template_directory() . '/inc/disable-feeds.php';


function enqueue_gutenberg_save_script() {
	wp_localize_script(
        'gutenberg-save-hook',
        'ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('enqueue_block_editor_assets', 'enqueue_gutenberg_save_script');


function add_noreferrer_to_links($content)
{
	// Add a debug log to check if the function is executed
	error_log('add_noreferrer_to_links function called.'); // This callback function handles <a> tags with an existing rel attribute
	$content = preg_replace_callback(
		'/<a\s+([^>]*?)\s*rel=["\'](.*?)["\']([^>]*?)>/i',
		function ($matches) {
			$rels = array_map('trim', explode(' ', $matches[2]));
			if (!in_array('noreferrer', $rels)) {
				$rels[] = 'noreferrer';
			}
			return '<a ' . $matches[1] . ' rel="' . implode(' ', $rels) . '"' . $matches[3] . '>';
		},
		$content
	); // This handles <a> tags without any rel attribute
	$content = preg_replace(
		'/<a\s+((?![^>]*?\brel=)[^>]*?)>/i',
		'<a $1 rel="noreferrer">',
		$content
	);
	return $content;
}
// Apply to post and page content
add_filter('the_content', 'add_noreferrer_to_links');

// Apply to text widgets
add_filter('widget_text', 'add_noreferrer_to_links');

// Apply to text content widgets
add_filter('widget_text_content', 'add_noreferrer_to_links');


// Register Custom Post Type: News
function create_news_cpt() {
    $labels = array(
        'name'                  => _x( 'News', 'Post Type General Name', 'textdomain' ),
        'singular_name'         => _x( 'News', 'Post Type Singular Name', 'textdomain' ),
        'menu_name'             => __( 'News', 'textdomain' ),
        'name_admin_bar'        => __( 'News', 'textdomain' ),
        'archives'              => __( 'News Archives', 'textdomain' ),
        'attributes'            => __( 'News Attributes', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent News:', 'textdomain' ),
        'all_items'             => __( 'All News', 'textdomain' ),
        'add_new_item'          => __( 'Add New News', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'new_item'              => __( 'New News', 'textdomain' ),
        'edit_item'             => __( 'Edit News', 'textdomain' ),
        'update_item'           => __( 'Update News', 'textdomain' ),
        'view_item'             => __( 'View News', 'textdomain' ),
        'view_items'            => __( 'View News', 'textdomain' ),
        'search_items'          => __( 'Search News', 'textdomain' ),
        'not_found'             => __( 'Not found', 'textdomain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'textdomain' ),
        'featured_image'        => __( 'Featured Image', 'textdomain' ),
        'set_featured_image'    => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image'    => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item'      => __( 'Insert into News', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this News', 'textdomain' ),
        'items_list'            => __( 'News list', 'textdomain' ),
        'items_list_navigation' => __( 'News list navigation', 'textdomain' ),
        'filter_items_list'     => __( 'Filter News list', 'textdomain' ),
    );
    $args = array(
        'label'                 => __( 'News', 'textdomain' ),
        'description'           => __( 'A custom post type for News', 'textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-document',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'news', $args );
}
add_action( 'init', 'create_news_cpt', 0 );


add_filter('get_the_archive_title', function ($title) {
    if (is_post_type_archive('news')) {
		$title = "Actualités";
    }
    return $title;
});


add_filter('the_content', 'remove_a_tags_from_news_content', 20);

function remove_a_tags_from_news_content($content) {
    if (get_post_type() === 'news') {
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $links = $dom->getElementsByTagName('a');

        while ($links->length > 0) {
            $link = $links->item(0);
            $link->parentNode->replaceChild($dom->createTextNode($link->nodeValue), $link);
        }

        return $dom->saveHTML();
    }

    return $content;
}


function process_content( $content ) {
    if ( false !== strpos( $content, '<table' ) || false !== strpos( $content, '<figure class="article__media' ) || false !== strpos( $content, '<figure class="fig-ranking-profile-media-small-picture' ) ) {
        $dom = new DOMDocument();
        libxml_use_internal_errors( true );
        $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
        libxml_clear_errors();

        $tables = $dom->getElementsByTagName( 'table' );
        foreach ( $tables as $table ) {
            $wrapper = $dom->createElement( 'div' );
            $wrapper->setAttribute( 'class', 'wp-block-table' );
            $table->parentNode->replaceChild( $wrapper, $table );
            $wrapper->appendChild( $table );
        }

        $xpath = new DOMXPath( $dom );
        $figures = $xpath->query( '//figure[contains(@class, "fig-media") or contains(@class, "fig-ranking-profile-media-small-picture")]' );
        foreach ( $figures as $figure ) {
            $figure->parentNode->removeChild( $figure );
        }

        $content = $dom->saveHTML();
        $content = preg_replace( '~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', $content );
    }
    return $content;
}
add_filter( 'the_content', 'process_content' );



add_action('template_redirect', function () {
    if (is_search()) {
        wp_redirect(home_url());
        exit;
    }
});


// Pages with tag and category
function add_categories_and_tags_to_pages() {
    register_taxonomy_for_object_type('category', 'page');
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_categories_and_tags_to_pages');


add_action('wp_footer', function () {
    ob_start();
}, PHP_INT_MIN);

add_action('wp_print_footer_scripts', function () {
    $content = ob_get_clean();
    
    if (strpos($content, 'ckyBannerTemplate') !== false) {
        
        preg_match('/(<script[^>]*id=["\']ckyBannerTemplate["\'][^>]*>)([\s\S]*?)(<\/script>)/i', $content, $script_matches);
        
        if (!empty($script_matches)) {
            $script_open = $script_matches[1];
            $script_content = $script_matches[2];
            $script_close = $script_matches[3];
            
            $modal_start_pos = strpos($script_content, '<div class="cky-accordion-wrapper"');
            
            if ($modal_start_pos !== false) {
                $searchable_content = substr($script_content, $modal_start_pos);
                $div_count = 0;
                $pos = 0;
                $modal_length = 0;
                
                preg_match('/<div class="cky-accordion-wrapper"[^>]*>/', $searchable_content, $open_matches, PREG_OFFSET_CAPTURE);
                if (!empty($open_matches)) {
                    $pos = $open_matches[0][1] + strlen($open_matches[0][0]);
                    $div_count = 1;
                    
                    while ($div_count > 0 && $pos < strlen($searchable_content)) {
                        $next_open = strpos($searchable_content, '<div', $pos);
                        $next_close = strpos($searchable_content, '</div>', $pos);
                        
                        if ($next_open === false && $next_close === false) {
                            break;
                        }
                        
                        if ($next_close !== false && ($next_open === false || $next_close < $next_open)) {
                            $div_count--;
                            $pos = $next_close + 6;
                            
                            if ($div_count === 0) {
                                $modal_length = $pos;
                                break;
                            }
                        } 
                        else if ($next_open !== false) {
                            $div_count++;
                            $pos = $next_open + 4;
                        }
                    }
                    
                    if ($modal_length > 0) {
                        $before_modal = substr($script_content, 0, $modal_start_pos);
                        $after_modal = substr($script_content, $modal_start_pos + $modal_length);
                        $new_script_content = $before_modal . $after_modal;
                        
                        $new_script = $script_open . $new_script_content . $script_close;
                        
                        $content = str_replace($script_matches[0], $new_script, $content);
                    }
                }
            }
        }
    }
    
    echo $content;
}, PHP_INT_MAX);

function replace_specific_wp_block_class($block_content, $block) {
    if (!empty($block_content) && (str_contains($block_content, 'wp-block-heading') || str_contains($block_content, 'wp-post-image') || str_contains($block_content, 'wp-element'))) {
        $block_content = str_replace('wp-block-heading', 'custom-heading', $block_content);
 		$block_content = str_replace('wp-post-image', 'post-image', $block_content);
		 $block_content = str_replace('wp-element', 'element', $block_content);
		
    }
    return $block_content;
}
add_filter('render_block', 'replace_specific_wp_block_class', 10, 2);

add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_script( 'wp-hooks-js' );
	wp_dequeue_script( 'wp-i18n-js' );
}, 99 );

remove_action('wp_head', 'wp_oembed_add_discovery_links', 99);


function add_security_headers() 
{
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

    header("Content-Security-Policy: "
        . "default-src 'self'; "
        . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://euob.sd17665.build-tracking-tool.com https://obseu.sd17665.build-tracking-tool.com; "
        . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
        . "img-src 'self' data:; "
        . "font-src 'self' data: https://fonts.gstatic.com; "
        . "object-src 'self'; "
        . "base-uri 'self'; "
        . "frame-src 'self'; "
        . "connect-src 'self' https://obseu.sd17665.build-tracking-tool.com;"
    );
}

add_action('send_headers', 'add_security_headers');

add_filter( 'wp_sitemaps_enabled', '__return_false' );


// HEADER

function ev_starter_register_menus() {
	register_nav_menus(array(
		'menu-1' => esc_html__('Principal Menu', 'ev-starter'),
	));
}
add_action('after_setup_theme', 'ev_starter_register_menus');
