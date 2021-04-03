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
define( 'DB_NAME', 'WP' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'anasanas' );

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
define( 'AUTH_KEY',         'VHt1^{h$T}e5l!^EPzO/glFT?OsgQ%x<%7U+hk~TWyK,}I#@;,;J-e> p5Gcq~i9' );
define( 'SECURE_AUTH_KEY',  'y_F]&4a]IV3(8b`Orpq;GQ$q5}mo[}9c`d6hdikqe1-wkpdcUFq7o]1*J!Xj.Y+]' );
define( 'LOGGED_IN_KEY',    'KctGjI 6 ^e=AT)dyB8r8afAP,mf;7Ofa[ &f@2bM5a?hp4LZ%vU^}yp#F6A5L&`' );
define( 'NONCE_KEY',        '2^.M}:&4VC^uN-,kyA78 U|H[:$:ieXQ}X|V=}A-JJg?![w7IoU9y},XSH6WmNwX' );
define( 'AUTH_SALT',        '-Q6$7z_}Ff{0M5~4I+OHA[J<Dwq+~zx)G(MI7nWq@`}f$RbU&]eCCPGFh%Rm{@M]' );
define( 'SECURE_AUTH_SALT', '. (k5HSC!0FRo@r=11JBlr/0KiUR`88)?gClu83zlm?L=2?IDuh=m-[~]$=?=WF>' );
define( 'LOGGED_IN_SALT',   '|lWA)LyuO`%4*7<Su/}:4m^W(%2lgpJqH>mU])px0zo.7CV5i}w)|j$,u)3#J_5S' );
define( 'NONCE_SALT',       'P{$BM<Ar{<rtoF6*+;8E,*z8dYAX2qPL-)<Kgj%UCu.GW9$c.?`xU`-;rjM;1T %' );

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
