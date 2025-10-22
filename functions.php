<?php
/**
 * ACF Gutenberg Block functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ACF_Gutenberg_Block
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function acf_gutenberg_block_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ACF Gutenberg Block, use a find and replace
		* to change 'acf-gutenberg-block' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'acf-gutenberg-block', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'acf-gutenberg-block' ),
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
			'acf_gutenberg_block_custom_background_args',
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
add_action( 'after_setup_theme', 'acf_gutenberg_block_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function acf_gutenberg_block_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'acf_gutenberg_block_content_width', 640 );
}
add_action( 'after_setup_theme', 'acf_gutenberg_block_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acf_gutenberg_block_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'acf-gutenberg-block' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'acf-gutenberg-block' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'acf_gutenberg_block_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function acf_gutenberg_block_scripts() {
	// wp_enqueue_style( 'acf-gutenberg-block-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'acf-gutenberg-block-style', get_template_directory_uri() . '/acf_blocks/main-style.min.css', array(), _S_VERSION );

	wp_style_add_data( 'acf-gutenberg-block-style', 'rtl', 'replace' );

	wp_enqueue_script( 'acf-gutenberg-block-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'acf_gutenberg_block_scripts' );

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

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init() {

    if( function_exists('acf_register_block_type') ) {

        // Register a gallery block.
        acf_register_block_type(array(
            'name'              => 'gallery',
            'title'             => __('Gallery'),
            'description'       => __('A custom gallery block.'),
            'render_template'   => 'template-parts/blocks/gallery/gallery.php',
            'category'          => 'custom',
			'enqueue_assets' => function(){
				// Enqueue gallery block styles in editor
				wp_enqueue_style('gallery-block-editor-styles', get_template_directory_uri() . '/acf_blocks/gallery/gallery-style.min.css');
				wp_enqueue_script('gallery-block-editor-scripts', get_template_directory_uri() . '/acf_blocks/gallery/gallery.min.js');
			},
        ));

        // Register a Hero block.
        acf_register_block_type(array(
            'name'              => 'hero',
            'title'             => __('Hero'),
            'description'       => __('A custom hero block.'),
            'render_template'   => 'template-parts/blocks/hero/hero.php',
            'category'          => 'custom',
            'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm40-80h480L570-480 450-320l-90-120-120 160Zm-40 80v-560 560Z"/></svg>',
			'enqueue_assets' => function(){
				// Enqueue hero block styles in editor
				wp_enqueue_style('hero-block-editor-styles', get_template_directory_uri() . '/acf_blocks/hero/hero-style.min.css');
				wp_enqueue_script('hero-block-editor-scripts', get_template_directory_uri() . '/acf_blocks/hero/hero.min.js');
			},
        ));

		// Post Loop Block
		acf_register_block_type([
			'name'              => 'post-loop',
			'title'             => __('Post Loop'),
			'description'       => __('Displays a loop of all posts.'),
			'render_template'   => 'template-parts/blocks/post-loop/post-loop.php',
			'category'          => 'formatting',
			'icon'              => 'list-view',
			'keywords'          => ['posts', 'loop', 'acf'],
			'enqueue_assets' => function(){
				// Enqueue Post Loop block styles in editor
				wp_enqueue_style('post-loop-block-editor-styles', get_template_directory_uri() . '/acf_blocks/post-card/post-card-style.min.css');
			},
		]);
		
    }
}

add_action('enqueue_block_editor_assets', 'my_enqueue_block_editor_assets');
function my_enqueue_block_editor_assets() {
	wp_enqueue_style( 'acf-gutenberg-block-editor-style', get_template_directory_uri() . '/acf_blocks/main-style.min.css', array(), _S_VERSION );
}



