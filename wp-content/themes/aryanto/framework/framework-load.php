<?php
/**
 * Framework
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/*
 * Main Helper Class
 */
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-helper.php';

/*
 * Logging Class
 */
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-logging.php';

/**
 * Framework Functions
 */

require HERBS_TEMPLATE_PATH . '/framework/functions/general-functions.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/media-functions.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/post-functions.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/breadcrumbs.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/formatting.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/post-actions.php';
require HERBS_TEMPLATE_PATH . '/framework/functions/page-templates.php';

/**
 * Framework Classes
 */
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-filters.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-advertisment.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-ajax.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-foxpush.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-styles-footer.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-postviews.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-mega-menu.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-videos-list.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-pagination.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-opengraph.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-wp-helper.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-styles.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-weather.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-instagram.php';
require HERBS_TEMPLATE_PATH . '/framework/classes/class-herbs-apps-bmi.php';

/**
 * Mobile Detector
 */
require HERBS_TEMPLATE_PATH . '/framework/vendor/Mobile_Detect/devices.php';

/**
 * Backend Loader
 */
require HERBS_TEMPLATE_PATH . '/framework/admin/classes/class-herbs-admin-helper.php';
require HERBS_TEMPLATE_PATH . '/framework/admin/framework-admin.php';


/**
 * Extensions
 *
 * By: Herbs
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-extensions.php';

/**
 * AMP
 *
 * By: Automattic
 * https://wordpress.org/plugins/amp/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-amp.php';

/**
 * WooCommerce
 *
 * By: Automattic
 * https://wordpress.org/plugins/woocommerce/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-woocommerce.php';

/**
 * Sensei
 *
 * By: Automattic
 * https://woocommerce.com/products/sensei/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-sensei.php';

/**
 * BuddyPress
 *
 * By: Multiple Authors
 * https://wordpress.org/plugins/buddypress/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-buddypress.php';

/**
 * bbPress
 *
 * By: Multiple Authors
 * https://wordpress.org/plugins/buddypress/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-bbpress.php';

/**
 * Jetpack
 *
 * By: Automattic
 * https://wordpress.org/plugins/jetpack/
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-jetpack.php';

/**
 * Taqyeem
 *
 * By: Herbs
 */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-taqyeem.php';

 /**
  * Instant Articles for WP
  *
  * By: Automattic, Dekode, Facebook
  * https://wordpress.org/plugins/fb-instant-articles/
  */
require HERBS_TEMPLATE_PATH . '/framework/plugins/class-herbs-fbinstant-articles.php';

 /**
  * Cryptocurrency All-in-One
  * WP Ultimate Crypto
  *
  */
require HERBS_TEMPLATE_PATH . '/framework/plugins/crypto.php';
