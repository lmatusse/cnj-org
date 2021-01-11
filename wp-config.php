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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpresslaila' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '9IV[jM|q 4.{n7xIcU-+[In<~`n_qJf&]joKvC~X[f5;8n@nFA)Z,nRL~G+:?0z#' );
define( 'SECURE_AUTH_KEY',  'cEprJg?kRo[[b7u^!kIje$&ycx=Fvj>B(a9c9s$K~/RHf]0t9@)(79w?.hL69nI(' );
define( 'LOGGED_IN_KEY',    'hWN#pi$tL`Uk531(+=FeA7R!wzo/Xbfsk< EYg:;y~xbsKcE,1~%qJ$>wwvTpUo<' );
define( 'NONCE_KEY',        't^059hxH+gR5h>dBJ>mS[IulfN;Sq%Aay)ry#gkl>1qnb[qWXs:([I~ZY*]O?g_o' );
define( 'AUTH_SALT',        'b&1~PrP>14;`?8G}vr2ce WCoA]*cL|I~Vvok!2FQi/o+PnG ]a~fqE9cXkF&dAh' );
define( 'SECURE_AUTH_SALT', 'E7#2VjBr+e?Essd1U/B+&)T?:~ABh8s-lP`rWVd_;vG!:y`}q/u:VoG2|~Lcc^Q ' );
define( 'LOGGED_IN_SALT',   'B>Mp()`]3)zDp{v`SfARlG{I$j:waaCCmyX~rCNP{ejb!6t$9rsq2dF9Gl{)|{0`' );
define( 'NONCE_SALT',       '|&n]C{~VDo(B{xDgR^=B1g>oj+AH~Ug]0MOcifT;>.n|Q@axu;KN(y.Bw%Jc9Ty#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
