<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress-lms' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'C,ux<S6UW(^I@({+`IlC+0H/{hLRv7h~AGBp}xp[V~9r<8qy_@J>Nf.m) 4[TWI-' );
define( 'SECURE_AUTH_KEY',  'D{X<@KC6hS&:Y=B>;#{@_+EKnwqu4BOqVI`:+e(Ecu78-C:jDy^0~%gy2C $=J8k' );
define( 'LOGGED_IN_KEY',    'Sd^KUO!0h#WMS|+[a>Z=D]:zmbYbh,DhDgA<?$PaouKIwDun^e,%L?$.V=ZV:xmW' );
define( 'NONCE_KEY',        '<p&xJWr=f22Rx1FTF &g2Xo%je^)M1p]M,1o-~Q|C&MT$J!>pIfA  }<Q&UyBY>.' );
define( 'AUTH_SALT',        'n18T9bZ@_]I.e8?Fb`FNoT9l](Zt_PV{~_RpW4}h/_^9)s#I):L$e=ikr j-uOtW' );
define( 'SECURE_AUTH_SALT', 'f(2#l[Vfuth8Wm_:lw%]N MKhV<!?wH5_/Dh%Fd]|D&]2Os2&iUV|0Vu`@NR|f{V' );
define( 'LOGGED_IN_SALT',   'fkq0->PiL$O)HqA$%]Bg+B2De~e*>*K^CQz8:L:oi:H^J3_@XC_D:BvL{2c77Pp0' );
define( 'NONCE_SALT',       'EY[lU;p}d!trZv/[/@Ep>Y1&V!<?f(}Bj1tu}{[~f-AfZK[F8P-oXU=lIc=eHC|y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
