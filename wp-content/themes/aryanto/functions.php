<?php
/**
 * Theme functions and definitions
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/*
 * Works with PHP 5.3 or Later
 */
if ( version_compare( phpversion(), '5.3', '<' ) ) {
	require get_template_directory() . '/framework/functions/php-disable.php';
	return;
}

/*
 * Define Constants
 */
define( 'HERBS_DB_VERSION',            '4.5.1' );
define( 'HERBS_THEME_SLUG',            'herbal' );
define( 'HERBS_TEXTDOMAIN',            'herbal' );
define( 'HERBS_THEME_ID',              '19659555' );
define( 'HERBS_TEMPLATE_PATH',         get_template_directory() );
define( 'HERBS_TEMPLATE_URL',          get_template_directory_uri() );
define( 'HERBS_AMP_IS_ACTIVE',         function_exists( 'amp_init' ));
define( 'HERBS_WPUC_IS_ACTIVE',        function_exists( 'run_MABEL_WPUC' ));
define( 'HERBS_ARQAM_IS_ACTIVE',       function_exists( 'arqam_init' ));
define( 'HERBS_SENSEI_IS_ACTIVE',      function_exists( 'Sensei' ));
define( 'HERBS_TAQYEEM_IS_ACTIVE',     function_exists( 'taqyeem_get_option' ));
define( 'HERBS_EXTENSIONS_IS_ACTIVE',  function_exists( 'herbal_extensions_shortcodes_scripts' ));
define( 'HERBS_BBPRESS_IS_ACTIVE',     class_exists( 'bbPress' ));
define( 'HERBS_JETPACK_IS_ACTIVE',     class_exists( 'Jetpack' ));
define( 'HERBS_BWPMINIFY_IS_ACTIVE',   class_exists( 'BWP_MINIFY' ));
define( 'HERBS_REVSLIDER_IS_ACTIVE',   class_exists( 'RevSlider' ));
define( 'HERBS_CRYPTOALL_IS_ACTIVE',   class_exists( 'CPCommon' ));
define( 'HERBS_BUDDYPRESS_IS_ACTIVE',  class_exists( 'BuddyPress' ));
define( 'HERBS_LS_Sliders_IS_ACTIVE',  class_exists( 'LS_Sliders' ));
define( 'HERBS_FB_INSTANT_IS_ACTIVE',  class_exists( 'Instant_Articles_Wizard' ));
define( 'HERBS_WOOCOMMERCE_IS_ACTIVE', class_exists( 'WooCommerce' ));
define( 'HERBS_MPTIMETABLE_IS_ACTIVE', class_exists( 'Mp_Time_Table' ));

/*
 * Theme Settings Option Field
 */
add_filter( 'Herbs/theme_options', 'herbal_theme_options_name' );
function herbal_theme_options_name( $option ){
	return 'tie_herbal_options';
}

/*
 * Translatable Theme Name
 */
add_filter( 'Herbs/theme_name', 'herbal_theme_name' );
function herbal_theme_name( $option ){
	return esc_html__( 'Herbal', HERBS_TEXTDOMAIN );
}

/**
 * Default Theme Color
 */
add_filter( 'Herbs/default_theme_color', 'herbal_theme_color' );
function herbal_theme_color(){
	return '#0088ff';
}

/*
 * Import Files
 */
require HERBS_TEMPLATE_PATH . '/framework/framework-load.php';
require HERBS_TEMPLATE_PATH . '/inc/theme-setup.php';
require HERBS_TEMPLATE_PATH . '/inc/style.php';
require HERBS_TEMPLATE_PATH . '/inc/deprecated.php';
require HERBS_TEMPLATE_PATH . '/inc/widgets.php';
require HERBS_TEMPLATE_PATH . '/inc/updates.php';

if( is_admin() ){
	require HERBS_TEMPLATE_PATH . '/inc/help-links.php';
}

/**
 * Load the Sliders.js file in the Post Slideshow shortcode
 */
if( ! function_exists( 'herbal_enqueue_js_slideshow_sc' ) ){

	add_action( 'tie_extensions_sc_before_post_slideshow', 'herbal_enqueue_js_slideshow_sc' );
	function herbal_enqueue_js_slideshow_sc(){
		wp_enqueue_script( 'tie-js-sliders' );
	}
}

/*
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
add_action( 'wp_body_open',      'herbal_content_width' );
add_action( 'template_redirect', 'herbal_content_width' );
function herbal_content_width() {

	$content_width = ( HERBS_HELPER::has_sidebar() ) ? 708 : 1220;

	/**
	 * Filter content width of the theme.
	 */
	$GLOBALS['content_width'] = apply_filters( 'Herbs/content_width', $content_width );
}

