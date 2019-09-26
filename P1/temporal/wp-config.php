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
define( 'DB_NAME', 'id10868367_wp_3920336e9676ac3b1ea58d82cf8ce456' );

/** MySQL database username */
define( 'DB_USER', 'id10868367_wp_3920336e9676ac3b1ea58d82cf8ce456' );

/** MySQL database password */
define( 'DB_PASSWORD', '13eefa83e3d1b52ec0f2817d58af7b2b84b1c48f' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          't){+EO/?yu0KXCL.B&{(*u=%=mFJ3n$p=JK{72dIaB.Vr&D9sE`c#uc0>uMtW|$+' );
define( 'SECURE_AUTH_KEY',   'K] Ps2Zm@{B-%bx#?xA;M6^EppQevTQs/Fn9.U@EMFYAYnd?-)L{rIg>6U-QmomD' );
define( 'LOGGED_IN_KEY',     '!e7A?JbTlhM>.oKxrou_.UHx(X)stJz4Oh2`Ii!ISnAH&&brq+dfT:Z^3*u/Y#_o' );
define( 'NONCE_KEY',         'vfR$xGL+$=$yIz/CXY7ZAx/%i6mXVi0p1(o.Q0;LCcf`;><+q]W~b},.uyn8+T%u' );
define( 'AUTH_SALT',         'vv$lW][RGtIEX5C.s3[%XPy9vMyGY5tNO]Q4&!#*Fr27{DpT6HQI1YK?td<& :C-' );
define( 'SECURE_AUTH_SALT',  ')}F6RPQPxr-&[lf3rtJaauyg8+&p|!}qPmmfT&aU-b@]4.|l5%{F(h u3kIp.Pn5' );
define( 'LOGGED_IN_SALT',    'kb4XCzEf@Y*1A=I?rXY[a;|5.tJX}y^L~L6N2D;umwrJf/K1])l*He8[6{id,/4}' );
define( 'NONCE_SALT',        '[{+W %NQ~JqF$nbdTPL#no%c=YB:uPbZF&9#f;46aw}m:[j$.&1J_qZhoKhV5f!5' );
define( 'WP_CACHE_KEY_SALT', 'UHN~oq9j&^%bM]}=j,IIz1XDMk@h4QAt/Z}*OZkhZeP1^z`2MI|$?rmNZs$F@7l]' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
