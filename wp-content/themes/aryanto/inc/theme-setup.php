<?php
/**
 * Theme Custom Styles
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


/*
 * Setup Theme
 */
add_action( 'after_setup_theme', 'herbal_theme_setup' );
function herbal_theme_setup(){

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Switch default core markup for comment form, and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
	) );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( HERBS_THEME_SLUG.'-image-small', 220, 150, true );
	add_image_size( HERBS_THEME_SLUG.'-image-large', 390, 220, true );
	add_image_size( HERBS_THEME_SLUG.'-image-post',  780, 470, true );

	// Add Support for the Arqam Lite plugin.
	add_theme_support( 'Arqam_Lite' );

	// Gutenberg
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	 */
	if( ! tie_get_option( 'disable_editor_styles' ) ){
		add_editor_style( 'assets/css/editor-style.css' );
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( HERBS_TEXTDOMAIN, HERBS_TEMPLATE_PATH . '/languages' );

	// The theme uses wp_nav_menu() in multiple locations.
	register_nav_menus( array(
		'top-menu'    => esc_html__( 'Secondry Nav Menu', HERBS_TEXTDOMAIN ),
		'primary'     => esc_html__( 'Main Nav Menu',     HERBS_TEXTDOMAIN ),
		'404-menu'    => esc_html__( '404 Page menu',     HERBS_TEXTDOMAIN ),
		'footer-menu' => esc_html__( 'Footer Navigation', HERBS_TEXTDOMAIN ),
	));
}


/**
 * Enqueue IE Scripts and Styles
 */
add_action( 'wp_enqueue_scripts', 'herbal_enqueue_IE_assets' );
function herbal_enqueue_IE_assets(){

	global $is_IE;

	if( ! $is_IE ){
		return;
	}

	preg_match( '/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches );

	if( empty( $matches ) ){
		return;
	}

	if( is_array( $matches ) && count( $matches ) < 2 ){
		preg_match( '/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches );
	}

	$version = $matches[1];

	// IE 10 && IE 11
	if( $version <= 11 ){
		wp_enqueue_style( 'tie-css-ie-11', HERBS_TEMPLATE_URL .'/assets/css/ie/ie-lte-11.css', array(), HERBS_DB_VERSION );
		wp_enqueue_script( 'tie-js-ie',    HERBS_TEMPLATE_URL . '/assets/js/ie.js', array( 'jquery' ), HERBS_DB_VERSION, true );
	}

	// IE 10
	if ( $version == 10 ) {
		wp_enqueue_style( 'tie-css-ie-10-only', HERBS_TEMPLATE_URL.'/assets/css/ie/ie-10.css', array(), HERBS_DB_VERSION );
	}
	// < IE 10
	elseif ( $version < 10 ) {
		wp_enqueue_style( 'tie-css-ie-10', HERBS_TEMPLATE_URL.'/assets/css/ie/ie-lt-10.css', array(), HERBS_DB_VERSION );
	}
}


/*
 * Register Main Scripts and Styles
 */
add_action( 'wp_enqueue_scripts', 'herbal_register_assets', 20 );
function herbal_register_assets(){

	$min = HERBS_STYLES::is_minified();
	$ver = current_user_can( 'switch_themes' ) ? time() : HERBS_DB_VERSION; // Always avoid browser cache for admins

	/**
	 * Scripts
	 */

	/*
	 * Main Scripts file
	 */
	wp_register_script( 'tie-scripts', HERBS_TEMPLATE_URL . '/assets/js/scripts'. $min .'.js', array( 'jquery' ), $ver, true );

	/*
	 * Scripts requrie tie-scripts
	 */
	// Sliders
	wp_register_script( 'tie-js-sliders', HERBS_TEMPLATE_URL . '/assets/js/sliders'. $min .'.js', array( 'jquery', 'tie-scripts' ), $ver, true );
	// Desktop only JS
	wp_register_script( 'tie-js-desktop', HERBS_TEMPLATE_URL . '/assets/js/desktop'. $min .'.js', array( 'jquery', 'tie-scripts' ), $ver, true );
	// single
	wp_register_script( 'tie-js-single', HERBS_TEMPLATE_URL . '/assets/js/single'. $min .'.js',  array( 'jquery', 'tie-scripts' ), $ver, true );
	// ViewPort
	wp_register_script( 'tie-js-viewport', HERBS_TEMPLATE_URL . '/assets/js/viewport-scripts.js',  array( 'jquery', 'tie-scripts' ), $ver, true );

	// Breaking News
	wp_register_script( 'tie-js-breaking', HERBS_TEMPLATE_URL . '/assets/js/br-news.js', array( 'jquery' ), $ver, true );
	// Live Search
	wp_register_script( 'tie-js-livesearch', HERBS_TEMPLATE_URL . '/assets/js/live-search.js', array( 'jquery' ), $ver, true );
	// iLightBox
	wp_register_script( 'tie-js-ilightbox', HERBS_TEMPLATE_URL . '/assets/ilightbox/lightbox.js', array( 'jquery' ), $ver, true );
	// Videos Playlist
	wp_register_script( 'tie-js-videoslist', HERBS_TEMPLATE_URL . '/assets/js/videos-playlist.js', array( 'jquery' ), $ver, true );
	// Velocity
	wp_register_script( 'tie-js-velocity', HERBS_TEMPLATE_URL . '/assets/js/velocity.js', array( 'jquery' ), $ver, true );
	// Apps
	wp_register_script( 'tie-js-apps', HERBS_TEMPLATE_URL . '/assets/js/apps.js', array( 'jquery' ), $ver, true );
	wp_localize_script('tie-js-apps', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));
	// Parallax
	wp_register_script( 'tie-js-parallax', HERBS_TEMPLATE_URL . '/assets/js/parallax.js', array( 'jquery', 'imagesloaded' ), $ver, true );

	/**
	 * Styles
	 */
	// base.css file
	wp_register_style( 'tie-css-base', HERBS_TEMPLATE_URL . '/assets/css/base'. $min .'.css', array(), $ver );

	// Main style.css file
	wp_register_style( 'tie-css-styles', HERBS_TEMPLATE_URL . '/assets/css/style'. $min .'.css', array(), $ver );

	// Single Post CSS file
	wp_register_style( 'tie-css-single', HERBS_TEMPLATE_URL . '/assets/css/single'. $min .'.css', array(), $ver );

	// Widgets
	wp_register_style( 'tie-css-widgets', HERBS_TEMPLATE_URL . '/assets/css/widgets'. $min .'.css', array(), $ver );

	// Widgets
	wp_register_style( 'tie-css-helpers', HERBS_TEMPLATE_URL . '/assets/css/helpers'. $min .'.css', array(), $ver );

	// Print
	wp_register_style( 'tie-css-print', HERBS_TEMPLATE_URL . '/assets/css/print.css', array(), $ver, 'print' );

	// LightBox
	wp_register_style( 'tie-css-ilightbox', HERBS_TEMPLATE_URL . '/assets/ilightbox/'. tie_get_option( 'lightbox_skin', 'dark' ) .'-skin/skin.css', array(), $ver );

	// Mp-Timetable css file
	if ( HERBS_MPTIMETABLE_IS_ACTIVE ){
		wp_enqueue_style( 'tie-css-mptt', HERBS_TEMPLATE_URL.'/assets/css/plugins/mptt'. $min .'.css', array(), $ver );
	}

	// Shortcodes
	if( HERBS_EXTENSIONS_IS_ACTIVE ){
		wp_register_style( 'tie-css-shortcodes', HERBS_TEMPLATE_URL . '/assets/css/plugins/shortcodes'. $min .'.css', array(), $ver );
		wp_register_script('tie-js-shortcodes',  HERBS_TEMPLATE_URL . '/assets/js/shortcodes.js', array( 'tie-js-sliders' ), $ver, true );
	}

	// Prevent Herbs shortcodes plugin from loading its js and Css files
	add_filter( 'tie_plugin_shortcodes_enqueue_assets', '__return_false' );
}


/*
 * Enqueue Main Scripts
 */
add_action( 'wp_enqueue_scripts', 'herbal_enqueue_scripts', 20 );
function herbal_enqueue_scripts(){

	// Scripts
	wp_enqueue_script( 'tie-scripts' );

	// LightBox
	wp_enqueue_script( 'tie-js-ilightbox' );

	// Shortcodes
	if( HERBS_EXTENSIONS_IS_ACTIVE ){
		wp_enqueue_script( 'tie-js-shortcodes' );
	}

	// Desktop only scripts
	if( ! tie_is_mobile() ){

		// Custom Scroller
		wp_enqueue_script( 'tie-js-desktop' );

		// Live search
		if( tie_menu_has_search( 'top_nav', true ) || tie_menu_has_search( 'main_nav', true ) ){
			wp_enqueue_script( 'tie-js-livesearch' );
		}
	}

	// Single pages with no builder
	if( is_singular() && ! HERBS_HELPER::has_builder() ){

		// Single.js
		wp_enqueue_script( 'tie-js-single' );

		// Queue Comments reply js
		if ( comments_open() && get_option('thread_comments') ){
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/*
 * Enqueue Styles
 */
add_action( 'wp_enqueue_scripts', 'herbal_enqueue_styles', 20 );
function herbal_enqueue_styles(){

	wp_enqueue_style( 'tie-css-base' );
	wp_enqueue_style( 'tie-css-styles' );
	wp_enqueue_style( 'tie-css-widgets' );
	wp_enqueue_style( 'tie-css-helpers' );
	wp_enqueue_style( 'tie-css-ilightbox' );

	if( HERBS_EXTENSIONS_IS_ACTIVE ){
		wp_enqueue_style( 'tie-css-shortcodes' );
	}

	// Single pages with no builder
	if( is_singular() && ! HERBS_HELPER::has_builder() ){

		// Single page styling
		wp_enqueue_style( 'tie-css-single' );

		// Print File
		wp_enqueue_style( 'tie-css-print' );
	}
}
