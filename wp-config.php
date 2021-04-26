<?php 
require_once(__DIR__ . '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '#0/@)ZQ3>sPf.fh=[kAlbG#`brcKC:wH+)ArwgbCbPj0qR~<}8$~BhG>pILhXzf-' );
define( 'SECURE_AUTH_KEY',  ')r>omLA|&7h]ZLa^TIgMHA:]sJON]%s<#SR9p[&<< 8a0{PirnkW3@nF|_oF:_Wa' );
define( 'LOGGED_IN_KEY',    '.pairpL$!8AI7a#(2pYI)W;uwVW}mx*yOMH8&4i5S`vn<5IJ4IC=K/#O{|o,F:}(' );
define( 'NONCE_KEY',        '/FD6?cd&^a=mLihW.7ZUGWUEI@.z 0VZ%~=d>xWie.N+2:Q. ~%pZ*gOji2~[x%I' );
define( 'AUTH_SALT',        'kXUd.>QF0DP^c|P @G-9/Yn`o0b)m/ZV@3Y%Fr8$}/jooj`JHt_j3G$KKJ:u`Q%+' );
define( 'SECURE_AUTH_SALT', 'W]81n8y7uZdh +T^;@jm9VlwZXzo4!-=^7/7Nkf8C|m*HBiGl/Cee:F%x_fVDzB:' );
define( 'LOGGED_IN_SALT',   'z{,oo&3*6iHHpQ5M-f<H{@P4,H`bTH_kJ3Xd3I#e)s0<smz@Wq~4^(j#Qz`c#-(+' );
define( 'NONCE_SALT',       ',0NQwdT$$2V^yCh;VM~x2nW_J{oPhOt@7<:<,ccG/N~~Vga.$YCGJ,ii Rx_bl{/' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = $_ENV['DB_PREFIX'];

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', $_ENV['WP_DEBUG'] );



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';