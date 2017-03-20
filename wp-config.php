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

define( 'DB_CREDENTIALS_PATH', dirname( ABSPATH ) ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . '/local-config.php' ) );
define( 'WP_DEV_SERVER', file_exists( DB_CREDENTIALS_PATH . '/dev-config.php' ) );
define( 'WP_STAGING_SERVER', file_exists( DB_CREDENTIALS_PATH . '/staging-config.php' ) );

/**
 * Load DB credentials
 */

if ( WP_LOCAL_SERVER )
	require DB_CREDENTIALS_PATH . '/local-config.php';
elseif ( WP_DEV_SERVER )
	require DB_CREDENTIALS_PATH . '/dev-config.php';
elseif ( WP_STAGING_SERVER )
	require DB_CREDENTIALS_PATH . '/staging-config.php';
else
	require DB_CREDENTIALS_PATH . '/production-config.php';

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'X5<g2]@b*X.Rs K@pWLj{$c%`U`w?F?,=aVFv>&h^J1DyWN_N#_S2@&lK`2$e:df');
define('SECURE_AUTH_KEY',  '~na60n%^c}d*+xk[#Q6k6_mvJlaMSALu0xTZ}aP]MQ,;?G9I;j0|Q<nRS$$w_P$g');
define('LOGGED_IN_KEY',    'K.S%)&*#t=G.]i@PpAo3|.Xrue|%NgiUTwK0fI3AF:m?KE9:u#/T@?bvs[Va~X<S');
define('NONCE_KEY',        '?ZB]1? IcrC$M~S`,4/;%#9dhr Oc5P5Poa|yRLrg+Mr.5U>8|T+mef:^Stl4|cY');
define('AUTH_SALT',        'x}8Xxs7IQ?gbcO]9OK6T*ED9Wk^OABJgh%ubN.f}p,>&$4A#T%{s;z6BK>Z&;(U0');
define('SECURE_AUTH_SALT', ' WdJF`v*#9o7et[kO}R^cX?,O;Ix9Obe<Y t,5~20Z_&TNU):j.V=#ci}]sa+49i');
define('LOGGED_IN_SALT',   '.)wn<c$54{Zz/Z7E4XV5o|BjqmG)OFcqeB$cPGa@}mS.pAU6ei!Jfw/u[{D`YEC(');
define('NONCE_SALT',       'u^<{G;]Ul55<t_[}C[QUF/.r_XSyHq:>]Ni[|&r2d!#EgEbf1l P*[3{R{9u]a|2');

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
