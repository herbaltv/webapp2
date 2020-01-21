<?php
/**
 * Enqueue required styles/scripts files
 *
 * @class WPG_Admin_Scripts
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WPG_Admin_Scripts {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
	}

	/**
	 * Register/Queue admin scripts
	 */
	public static function load_scripts() {
		// Tooltipster Style/Script
		wp_register_style( 'wpg-tooltipster-style', WPG_PLUGIN_URL . '/assets/css/tooltipster/tooltipster.css' );
		wp_register_style( 'wpg-tooltipster-punk-style', WPG_PLUGIN_URL . '/assets/css/tooltipster/themes/tooltipster-punk.css' );
		wp_register_script( 'wpg-tooltipster-script', WPG_PLUGIN_URL . '/assets/js/jquery.tooltipster.min.js', array( 'jquery' ) );
		
		// jQuery UI Style
		wp_register_style( 'wpg-jquery-ui-tabs', WPG_PLUGIN_URL . '/assets/css/admin/jquery-ui-1.8.2.css' );
		
		// Main Style/Script
		wp_register_style( 'wpg-main-style', WPG_PLUGIN_URL . '/assets/css/admin/style.css' );
		wp_register_script( 'wpg-main-script', WPG_PLUGIN_URL . '/assets/js/admin/scripts.js' );
		
		global $pagenow;
		if( $pagenow == 'edit.php' && ( isset( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] == 'glossary' ) && ( isset( $_REQUEST['page'] ) ) ) {
			if( $_REQUEST['page'] == 'wpg-settings' ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				
				wp_enqueue_style( 'wpg-tooltipster-style' );
				wp_enqueue_style( 'wpg-tooltipster-punk-style' );
				wp_enqueue_script( 'wpg-tooltipster-script' );
				
				wp_enqueue_style('wpg-jquery-ui-tabs');
				wp_enqueue_script('jquery-ui-tabs');
				
				wp_enqueue_style( 'wpg-main-style' );
				wp_enqueue_script( 'wpg-main-script' );
			} else if( $_REQUEST['page'] == 'wpg-user-guide' ) {
				wp_enqueue_style( 'wpg-main-style' );
			}
		}
	}
}

new WPG_Admin_Scripts();
