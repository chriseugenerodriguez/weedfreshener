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
define('DB_NAME', 'premiu35_wf');

/** MySQL database username */
define('DB_USER', 'premiu35_wf');

/** MySQL database password */
define('DB_PASSWORD', 'Da)4z@S83p');

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
define('AUTH_KEY',         'yqjhltvxywfmvj6fz02lj2rfbqlh995nrt8apjobyqudoqqwwpsshiom5ydyf8gb');
define('SECURE_AUTH_KEY',  'pmyesfs9mvy9wwvctq9r7gsflps8kscgblfxwtjvf1qaemaen8yn9tykdkefhpro');
define('LOGGED_IN_KEY',    'yy7q1fwrg0bzapytykkx34po41vx1hapq3hhfact12cp0hnqzgwjl586reiilht9');
define('NONCE_KEY',        '3qtk6rctfnlugy4exuiuppwt59ypywfraukdfig4r98evulck1qp03hpab1u1chp');
define('AUTH_SALT',        '61sjbxj0uupqsed0w4ey49ysmnhi2islqnhtlkt0yaibwqlapfgq6fvtxzzutslr');
define('SECURE_AUTH_SALT', 'vscrud3lblhqvwcemjvzkbm6jbejwfd8npzz6svg35nwbio0baxwzuhzsdamthia');
define('LOGGED_IN_SALT',   'yf36z8uswir80dcud80ipg3diqkq7tq680vhw9oxcpgdowivh0qob8v3jqgut4fo');
define('NONCE_SALT',       '1gjb4z3mpp4ocvqbnagy2mbmuxttsjtynowacp0w8frdiqn0ipicn0wxltqacr3g');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wf_';

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
