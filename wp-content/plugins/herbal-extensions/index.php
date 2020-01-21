<?php
/*
	Plugin Name: Herbal - Extensions
	Plugin URI: https://herbaltv.co.id
	Description: Add additional features to Herbal theme: Shortcodes, Custom Sliders post type
	Author: Herbs
	Version: 1.0.11
	Author URI: https://herbaltv.co.id
*/


require_once( 'shortcodes/shortcodes.php' );
require_once( 'custom-sliders/custom-sliders.php' );



/*-----------------------------------------------------------------------------------*/
# Load Text Domain
/*-----------------------------------------------------------------------------------*/
add_action( 'plugins_loaded', 'herbal_extensions_init' );
function  herbal_extensions_init() {
	load_plugin_textdomain( 'herbal-extensions' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}



/*-----------------------------------------------------------------------------------*/
# Register main Scripts and Styles
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'herbal_extensions_admin_enqueue_scripts' );
function herbal_extensions_admin_enqueue_scripts() {
	wp_enqueue_style( 'herbal-extensions-admin-css', plugins_url( 'assets/admin-styles.css', __FILE__ ) );
}
