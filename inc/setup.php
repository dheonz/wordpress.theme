<?php
/**
 * Theme basic setup.
 *
 * @package epflsti
 */

require get_template_directory() . '/inc/theme-settings.php';

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'epflsti_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function epflsti_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on epflsti, use a find and replace
		 * to change 'epflsti' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'epfl-sti-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'epflsti' ),
			'langmenu' => __( 'Lang Menu', 'epflsti' ),
			'institute-menu-igm' => __( 'IGM Nav Menu', 'epflsti' ),
			'institute-menu-ibi' => __( 'IBI Nav Menu', 'epflsti' ),
			'institute-menu-imt' => __( 'IMT Nav Menu', 'epflsti' ),
			'institute-menu-imx' => __( 'IMX Nav Menu', 'epflsti' ),
			'institute-menu-iel' => __( 'IEL Nav Menu', 'epflsti' ),
			'front-row-school-menu' => __( 'Front Row School Menu', 'epflsti' ),
			'front-row-centres-menu' => __( 'Front Row Centres Menu', 'epflsti' ),
			'footnote' => __( 'Footnote', 'epflsti' ),
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

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'epflsti_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Check and setup theme default settings.
		setup_theme_default_settings();
	}
endif; // epflsti_setup.
add_action( 'after_setup_theme', 'epflsti_setup' );

if ( ! function_exists( 'custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function custom_excerpt_more( $more ) {
		return '';
	}
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

if ( ! function_exists( 'all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function all_excerpts_get_more_link( $post_excerpt ) {

		return $post_excerpt . ' <p><a class="btn btn-secondary epflsti-read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( '',
		'epflsti' ) . '</a></p>';
	}
}
add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );
