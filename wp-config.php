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
define('DB_NAME', 'underscore');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '1uK?AgVLT7-V(SvTbG8hf?/~/O:34}M:R8P,dvZP11[Qyg4h0hI*Q&35P<q}wM-}');
define('SECURE_AUTH_KEY',  '.u@@E5)h(JBf(;OC{5:J2&3s~AH$RPA#tK2`ex5$v(]XZR[VjI+{e:j91YZ,s,: ');
define('LOGGED_IN_KEY',    'r>T%85Z!Eo)G=Ga)z2CUQ(n$RFAMN|4{[rXFBDd^I_(q4C&9x<ln<</zC:z)g=Qh');
define('NONCE_KEY',        '=#u;PleM0U;K W}Agnc6Q5xzhrw@3}_T<O5ZD~!4}u]1x!m44KoH AT%BZ M WhH');
define('AUTH_SALT',        'xMcPsGowWTU)/F<4z1hfZucIQ*,ej69*DP2[]k,Xh}w00a4O;z1?e3n>O/FvK;9/');
define('SECURE_AUTH_SALT', 'K`1SC~bhZoF<SJ:ibpC#tZ5+X4r^AYny%}vUOeF+7FogQ:0`,8Iskf0(GB[T4!E~');
define('LOGGED_IN_SALT',   'W?db=dY)06aBFVtP3BjX2!I,0t[ZI>6]K7p=:Cd&d(9iE-c@ryIEq?5lle{[+[#{');
define('NONCE_SALT',       '>WnUYIANJ,yYCu##[eV=T^7(eR?)Ce(^z+M*B~z5j?{1x}/`np[a:xFZy0;N(Iy-');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
