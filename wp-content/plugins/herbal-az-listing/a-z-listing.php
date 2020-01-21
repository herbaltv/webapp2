<?php
/**
 * Plugin Name:     Herbal AZ Listing
 * Plugin URI:      https://herbaltv.co.id
 * Description:     Display an A to Z listing of posts
 * Author:          Aryanto
 * Author URI:      https://aryanto.id
 * Text Domain:     a-z-listing
 * Domain Path:     /languages
 * Version:         3.1.0
 *
 * @package         A_Z_Listing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'AZLISTINGLOG' ) ) {
	define( 'AZLISTINGLOG', false );
}

require __DIR__ . '/vendor/autoload.php';

/**
 * Initialize the plugin.
 */
function a_z_listing_init() {
	\A_Z_Listing\Shortcode::instance()->activate( __FILE__, [] )->initialize();
	\A_Z_Listing\Indices::instance()->activate( __FILE__, [] )->initialize();
}

/**
 * Load all the plugin code.
 */
function a_z_listing_plugins_loaded() {
	require __DIR__ . '/functions/i18n.php';
	require __DIR__ . '/functions/health-check.php';
	require __DIR__ . '/functions/helpers.php';
	require __DIR__ . '/functions/styles.php';
	require __DIR__ . '/functions/scripts.php';
	require __DIR__ . '/functions/enqueues.php';

	require __DIR__ . '/widgets/class-a-z-listing-widget.php';

	add_action( 'init', 'a_z_listing_init', 5 );
}
add_action( 'plugins_loaded', 'a_z_listing_plugins_loaded', 5 );
