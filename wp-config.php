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
define('DB_NAME', 'ckywgma30362com38023_nnf');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'er1c550n');

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
define('AUTH_KEY',         'jT)K3wl* U4SnkZ[?xWvY.)ddZFS;J_{dox6:7H[;W+8~6:O[{g[e,$%.T.U.[H>');
define('SECURE_AUTH_KEY',  '>t6<5Q6l_Vr!dsM7bf|a1.2AO@iR:Qr:#!M387O-Y3AOiYf}mFno`<paaIpGnx,^');
define('LOGGED_IN_KEY',    'k+RnS9v|R-aCsN/m7GR6r2iLV#m71a_Q[@/yA@&Il22id;A8Eyvs3qQ2[CyKhz8`');
define('NONCE_KEY',        '_PMT[vofAcSXz&f8]+#y*Lew~WK=tL:{lk-W,:_JLPZZlD!1H3m_{32A%Bm$bP+o');
define('AUTH_SALT',        '.T#A#0=0^kh1 >m)YfP<>yO8VAgE2P*X@oQ6u]oa+lyg2ku!8+CK!XzB$4skamPb');
define('SECURE_AUTH_SALT', 'upK&{Y-IME,-m/$~0&76eg>VXFdXP/|,$$pgA~M>!bpH5O17mA}qudTGl~wZ0]9x');
define('LOGGED_IN_SALT',   '%-D{79`.b=d(%+kqAy&`#vOV+J0)?}.5j@Ei{dLy9`qw4<q/hr*h)n.0cP]Z^1Df');
define('NONCE_SALT',       '3WK!Z6wxer@<In&Mx.NbB)NZQTv :655=8B?>r$DfpRV:QP)Za4Pxf^bt-R&ENjG');

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
