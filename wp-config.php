<?php
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
define('DB_NAME', 'kdyogidb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'f{N[6*Ne|Iol2[BNU4?sR`AkpKn0N^3Zl6aOgc]/S;2W`L}M>QpeHk6}0,FAW{Di');
define('SECURE_AUTH_KEY',  'BD{+i}<%wch$yz_g!@5^cBwv?HPWDG.=B$c,(hE9xcW-J0LvMMG*=It-*T2O 20p');
define('LOGGED_IN_KEY',    '*Bg0xe!nB^HmNMPx><wgOb6s`FEdoyd%Y.ntP;k@>%,-G$nv,8i:y<nfWxFoUS2Y');
define('NONCE_KEY',        't&Wek{SBj ,CtZ1a&vN#~GoJ26zB;<?eJJUJ$&@?crugM<V}XhyD+5wASJaa8tYw');
define('AUTH_SALT',        '#1sV#9y9[2@&1NcoMGk1&&&E0M$,uI?jDZfv!p=AT:*&nlGX&]M*hL*|^#c!JHJ5');
define('SECURE_AUTH_SALT', 'n0T*0Q[p]mrVqc~yRX?pYPBH%q|M<=t7B-BD0?r++3UA.S}4uZwxZz ulnt}t{{/');
define('LOGGED_IN_SALT',   'TU#p:( r[XSW6> ;V>&Z|5Fv5pSR8r0JgkGk-@&dED=O#+++-OFvnA_,a98`j#jT');
define('NONCE_SALT',       'V5tZ Ef[.^^fxx%#bNYEMQg6gk`6Kz{ammX*b)+FkOy,t77(^s|+$hZUcSL)D)!>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);
@ini_set('upload_max_size' , '256M');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
