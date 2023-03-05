<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressDB' );

/** Database username */
define( 'DB_USER', 'wpuser' );

/** Database password */
define( 'DB_PASSWORD', 'pr4ktyk!3453Bom' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4.E}$!I(c9%|<6r%M~ab<[#nj?d_:Vi-VZ*]dw{aMl75[^j60f.}V?1?b;kzyT5&' );
define( 'SECURE_AUTH_KEY',  'Q^BzV&VcQTjRu<OXS9Isj*l=9BM}op-uWepq9H]xT#bqI+cWfejueK/UW)%?sCL?' );
define( 'LOGGED_IN_KEY',    '#DI:hRBJjl>nWaG(&l&(2i%. Xv;HDi$U7AF-_s2/,ti{W)5fV^[R6T?TFC4!8U:' );
define( 'NONCE_KEY',        'axAC,N[v*d4YAz,se`vQq9:$h<oQT#E,AU1j* Q7*}+q[.&^vp)@>%p-h//7)K~j' );
define( 'AUTH_SALT',        '7LdfU+f]{yGT;1sv#S}U3k=hbYVM~#k. 3qa]Wm4(+$UgnelosnYr|{_eJ&6g-4j' );
define( 'SECURE_AUTH_SALT', '71}zCa;DuV>).EH]eLJ#UTq{pQYw]0u:gxYYIW)=;DhN?-Z>1HYJZRA@I pQ41sj' );
define( 'LOGGED_IN_SALT',   'DT25E=:gjqoT4 R!J1`s@Jrr]r(]<)+=$X<{XwTX{8MMWx4Q ,;oj.G]m[!4I|l{' );
define( 'NONCE_SALT',       '~GxGNLrqlv|^VEL;5^*HW[nW~i6NPjO>f5|;LGGRg9+`:)+xd9IS `$+<lVJpCWF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
