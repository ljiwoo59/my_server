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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
#define( 'DB_COLLATE', 'direct' );
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',  'K^+;s)Q+wlDYS7n!OHDcybhs.COC)Dqf%R}$|&O5#i<xO!O+ )nlM/TC%/kr N_k' );
define( 'SECURE_AUTH_KEY', '5[C y%2q]b.&(K$8BL|Y;9w>70.BZ2.%t/cL/1S+nqQ1.fIFb)y;LvgMN2]01,D+' );
define( 'LOGGED_IN_KEY',   '|<lATJ}zOtORp!W|oh }sMg|y.e%_3t{dC6A?cH+N9W^6+GOnDm-(.2e];/-!<Yz' );
define( 'NONCE_KEY',        '`80^-g=n[7kDbI)(A@Fekz13>}%UA{ 2u*$F?;H_H:TpsIDJg?1#Plr<%{Dn[N W');
define( 'AUTH_SALT',        'EWi83+H&Zla+{XH=/LQR4yArxG+U;wss0{@g{mw^lz1zT**%!dcM(_@sdr_Q+x,I');
define( 'SECURE_AUTH_SALT', '+`-%z!%|G>pX%gt9pv;MY/1x]:@CZRm}9/(MIPb|q;-K)eCxv5;<U5N^+:(/vD[A');
define( 'LOGGED_IN_SALT',   ']g7B)Uz8m~7~oM61:@2&aX@TFh~c~+q.LTf?Wp/:ss5N={&RU-[JP~^?u$|?Tu:D');
define( 'NONCE_SALT',       'U[3qy|ogH$Cz!H?n+p,hf$#^n&dYawrP1{ @l|cS@dpV-c =S{&n=hDeM0JD-GxA');

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
