<?php
/**
 * codoswp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package codoswp
 */

if(! defined('CODOSWP_TEMPLATE_DIRECTORY')){
	define('CODOSWP_TEMPLATE_DIRECTORY', get_template_directory());
}

if ( ! defined( '_CODOSWP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_CODOSWP_VERSION', '1.0.0' );
}

if ( ! defined( 'CODOSWP' ) ) {
	// CODOSWP acts as a textdomain
	define( 'CODOSWP', 'codoswp' );
}

if ( ! function_exists( 'codoswp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function codoswp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on codoswp, use a find and replace
		 * to change CODOSWP to the name of your theme in all the template files.
		 */
		load_theme_textdomain( CODOSWP, get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary Menu', CODOSWP ),
				'menu-2' => esc_html__( 'Top Menu', CODOSWP ),
				'menu-3' => esc_html__( 'Footer Menu', CODOSWP ),
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
				'codoswp_custom_background_args',
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

		/**
		 * Add theme support for align-wide cover images
		 */
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'codoswp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codoswp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'codoswp_content_width', 640 );
}
add_action( 'after_setup_theme', 'codoswp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function codoswp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', CODOSWP ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', CODOSWP ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'codoswp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codoswp_scripts() {
	wp_enqueue_style( 'codoswp-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.5.2' );
	wp_enqueue_style( 'codoswp-font-samily', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro', array(), _CODOSWP_VERSION );
	wp_enqueue_style( 'codoswp-style', get_stylesheet_uri(), array(), _CODOSWP_VERSION );
	wp_style_add_data( 'codoswp-style', 'rtl', 'replace' );

	wp_enqueue_script( 'codoswp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _CODOSWP_VERSION, true );
	wp_enqueue_script( 'codoswp-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.5.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codoswp_scripts' );

function codoswp_legit_block_editor_styles() {
	wp_enqueue_style( 'codoswp-legit-editor-styles', get_theme_file_uri( '/style-editor.css' ), false, _CODOSWP_VERSION, 'all' );
} 
add_action( 'enqueue_block_editor_assets', 'codoswp_legit_block_editor_styles' );

/**
 * Register Custom Navigation Walker
 */
function codoswp_register_navwalker(){
	if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
		// File does not exist... return an error.
		return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
	} else {
		// File exists... require it.
		require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
	}
}
add_action( 'after_setup_theme', 'codoswp_register_navwalker' );

/**
 * Register custom color pallets
 */

add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Color 1', CODOSWP ),
		'slug'  => 'codoswp-color-1',
		'color'	=> '#0C87CC',
	),
	array(
		'name'  => __( 'Color 2', CODOSWP ),
		'slug'  => 'codoswp-color-2',
		'color' => '#00C0D4',
	),
	array(
		'name'  => __( 'Color 3', CODOSWP ),
		'slug'  => 'codoswp-color-3',
		'color' => '#545454',
	),
	array(
		'name'	=> __( 'Color 4', CODOSWP ),
		'slug'	=> 'codoswp-color-4',
		'color'	=> '#737373',
	),
	array(
		'name'	=> __( 'Color 5', CODOSWP ),
		'slug'	=> 'codoswp-color-5',
		'color'	=> '#0E90AC',
	),
) );

/**
 * Implement the theme options feature.
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Implement the menu search icon feature.
 */
require get_template_directory() . '/inc/menu-search-icon.php';

/**
 * Implement the Show/Hide page title feature.
 */
require get_template_directory() . '/inc/show-hide-title.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Require/Install theme specific plugins
 */
require_once get_template_directory() . '/inc/codoswp-install-plugins.php';