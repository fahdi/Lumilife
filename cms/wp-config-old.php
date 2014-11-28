<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'lumilife');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pass4rd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'X- D2nI@J9`>{^zL]]GSLv:vWsh|$e<;a>c*2.gl(vb@Aat?VvrL^61{zPiNa_Mn');
define('SECURE_AUTH_KEY',  'Sv);GZ~8:Cp(b3A8S!IDl5{X@{v1<NU-b1>^0H *F.tzR@y@y{9?/wy$vPS)RHyH');
define('LOGGED_IN_KEY',    'VVp7![5Jo.V!ghMx<3%F>*UP_Az8M*&vwb||B/^5P,HDE>&4R%BPg5vH(/91<!8_');
define('NONCE_KEY',        'htrzw.n]<>=?~5Z8C@p*wGQkJ}BVm9:$S9Q1S<B@2[=}XkJqER]|lg7GB0E:rG+x');
define('AUTH_SALT',        'WNm53y>qk,J]XQ@iu|#f:ZJ,{&,jYPM^7C>iUmOO^v<lo,^xv%z)8{DOor&MvKuE');
define('SECURE_AUTH_SALT', '5.bo4bv757n?!0L.=et)N-ae~% t!]MW^~gEn.)H`YH?guGNKyQQ^(PM^%qTIdf)');
define('LOGGED_IN_SALT',   '3B@h)2]&x7M(jF2^$21yd,@Ob.Sb;;HD!bTon/hmC_%5|Mw!@QYJ^1vY^q1m^hDu');
define('NONCE_SALT',       '4~tq5C:dOX+_A<>LXi K%*o+gXX&@]pIQh`?k^>1D$u^3|Pj7h6.1(|1$Zz^:kJ|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

