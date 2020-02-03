<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fathanfi_webapp_herbaltv1' );

/** MySQL database username */
define( 'DB_USER', 'fathanfi_dbherbaltv1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'dbherbaltv1' );

/** MySQL hostname */
define( 'DB_HOST', '45.118.132.253' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[((7|yH?9AT`ZF2O!;d|}@wGlg?!nL)O2ZWXU[o.+!71#rmkafynX!8^3qrS,)+2' );
define( 'SECURE_AUTH_KEY',  'Z;n}`7Rapd6Znur_Rv;CA4nWIcSHd@=j$C(8)!rE2t/xL&=J38]>k}^2.!ctMq.g' );
define( 'LOGGED_IN_KEY',    '-J+y/HAAx6HRB?;K)D} J49x!QO.a!l9@gN6lp>.@)^rZi3s5[:FNJCGv9~AhPA#' );
define( 'NONCE_KEY',        '+8l]dsa;dZy/5GnnZfiWYdpo>_V{4jly)x]QwFYXmRdQXwx*! t#59]k<S.Sa(IG' );
define( 'AUTH_SALT',        '/[*1&oVwnNqQ]puC[E>K,$HtEO#h kkA2U/~MDi[s#}Xxj:g76QRc=!j5CC6TK}|' );
define( 'SECURE_AUTH_SALT', '561Cs3Xd5`q7keSv&I_=x5l1A|*E=g`C9q0rD~xjsTVT&Bec<|Qw2fHw4J_e1$if' );
define( 'LOGGED_IN_SALT',   'AS`a!s__$(&UWb|Kg,:O.u/_5^k7NbB@2u8j13w%4`Z@.u}9d}<uyA@nQ+2]Wg^|' );
define( 'NONCE_SALT',       'idgJf?k-?UN/9z[eH8ee;U.;`hwXztwu)F1Zy}6@ha>%!U2P,53`Y_2{`_5pe~E#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hbx_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );