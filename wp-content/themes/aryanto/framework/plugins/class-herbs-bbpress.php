<?php
/**
 * BBPRESS Class
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly



if( ! class_exists( 'HERBS_BBPRESS' )){

	class HERBS_BBPRESS{

		/**
		 * __construct
		 *
		 * Class constructor where we will call our filter and action hooks.
		 */
		function __construct(){

			// Disable if the BBPRESS plugin is not active
			if( ! HERBS_BBPRESS_IS_ACTIVE ){
				return;
			}

			// Disable the default bbpress breadcrumb
			add_filter( 'bbp_no_breadcrumb', '__return_true' );

			// Enqueue and Dequeue CSS files
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}


		/*
		 * Enqueue and Dequeue CSS files
		 */
		function enqueue_styles(){

			// Enqueue bbPress Custom Css file
			wp_enqueue_style( 'tie-css-bbpress', HERBS_TEMPLATE_URL.'/assets/css/plugins/bbpress'. HERBS_STYLES::is_minified() .'.css', array(), HERBS_DB_VERSION, 'all' );

			// Dequeue bbPress Default Css files
			wp_dequeue_style( 'bbp-default' );
			wp_dequeue_style( 'bbp-default-rtl' );
		}

	}

	// Instantiate the class
	new HERBS_BBPRESS();
}
