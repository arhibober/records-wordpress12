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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/sata2/home/users/records/www/localhost/records-wordpress12/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'records-wordpress12');

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
define('AUTH_KEY',         '|VtG-XtNp7u[1;MQxv>T1v3sn6?d9ANafHqpgY4-wIg_Spb/Qvg(DN1eC683zu#1');
define('SECURE_AUTH_KEY',  '}mJyB?Lij7JA!_kzma`Eb+k~LcU%TCV#}nEmhT?yh91y0HX@w(CnN L1)e@nKVFJ');
define('LOGGED_IN_KEY',    '(X!#I2h:(k2?ktvlZ3EI3_KzW`?.@aE7G;;GJS/*-C<)+Z_WNi|N+d_r|E?Q-}iM');
define('NONCE_KEY',        '[:LlIMK<q8aB<gG38Cp*n|[Xvn~/*q[@R2PK ^P3B&!4U>!sW&wau:4QNkP.C[L1');
define('AUTH_SALT',        'Q5&/~wKmP+e,cEt0R~(9V`@$(;(|Smazd]N7g?,?$YmBk5U{?R)!7deT5Cu1~,d9');
define('SECURE_AUTH_SALT', '0P%<wLAkaqz9|Tx L8D;]pf>DKs]MD}iT(&{,rVDU[D$8d9*s`f=[3;?2Je>Q Gx');
define('LOGGED_IN_SALT',   '8L|Inv,UtA<eit/xOufc=T7(] sBn@/e9m`#NzYOWA{ug9bdJ+%g!&ZGAUs%#Q%p');
define('NONCE_SALT',       'Da=t!|JNd-bzl&E;2^k#*hV&j($r2pPS.9OT_*(bj@;JDf9YTf@!$wg&4%G4=XVi');

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
ini_set ("log_errors", "On");
ini_set ("display_errors", "Off");
ini_set ("error_reporting", E_ALL);
define ("WP_DEBUG", false);
define ("WP_DEBUG_LOG", true);
define ("WP_DEBUG_DISPLAY", false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined ("ABSPATH"))
	define ("ABSPATH", dirname (__FILE__)."/");

/** Sets up WordPress vars and included files. */
require_once (ABSPATH."wp-settings.php");