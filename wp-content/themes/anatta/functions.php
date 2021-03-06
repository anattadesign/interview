<?php
/**
 * anatta functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package anatta
 */

if ( ! function_exists( 'anatta_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function anatta_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on anatta, use a find and replace
	 * to change 'anatta' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'anatta', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'anatta' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'anatta_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'anatta_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function anatta_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'anatta_content_width', 640 );
}
add_action( 'after_setup_theme', 'anatta_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function anatta_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'anatta' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'anatta' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'anatta_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function anatta_scripts() {
	wp_enqueue_style( 'anatta-style', get_stylesheet_uri() );

	wp_enqueue_script( 'anatta-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'anatta-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'anatta_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


function anatta_save_user_answers( $start_time_diff_from_current_time ) {
	$post_data = $_POST;
	$answers = array();

	if ( $start_time_diff_from_current_time > 20 ) {
		echo "<p><b>Your time is already expired, please contact at priti@anattadesign.com if you have nay issue.</b></p>";
		return;
	}

	$questions = new WP_Query( array( 'post_type' => 'question', 'post_status' => 'publish', 'posts_per_page' => -1 ) );

	if ( $questions->have_posts() ) {
		while ( $questions->have_posts() ) {
			$questions->the_post();
			$key = 'question-' . get_the_ID();
			if ( isset( $post_data[ $key ] ) ) {
				$answers[ get_the_ID() ] = $post_data[ $key ];
				update_user_meta( get_current_user_id(), 'question_answers', $answers );
			}
		}
		wp_reset_query();
	}
}


function anatta_enqueue_scripts() {
	wp_enqueue_script( 'anatta-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/main.js' ) );
}
add_action( 'wp_enqueue_scripts', 'anatta_enqueue_scripts' );
