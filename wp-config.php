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
define( 'DB_NAME', 'bd_franci_sport' );

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
define( 'AUTH_KEY',         '}1>Lv?Q68M)&x)SJ]D0UgR>2/[EIlS_7vBQm&lyHs5WR+Ma`2#=.#9q7tR-QNx/,' );
define( 'SECURE_AUTH_KEY',  'Sda*j`r1_Bbup)3fVXaYRsQ3@RnHo2J#DaR[e2RX&8lpz<h@&>E[zg~l2q>?!Ag$' );
define( 'LOGGED_IN_KEY',    '%Nq^RMq|_,vt[h)&cte^5}.8^o*($iQNUr_/;$wsY,n#tWanI+vnXX[1rT_j){[&' );
define( 'NONCE_KEY',        ']h}#BjLGUXr_C+M-k9vE!t#Vi}2y=]@c/Io_w+Bl|h0=P$$;EV(lc=3f{)GtzjYA' );
define( 'AUTH_SALT',        '&3jp<ph#9h<@SDdQl T5Fy>7KQmXYc= 5eluiQf<@0HN>O8gcjL 12ZvQlmVDq@`' );
define( 'SECURE_AUTH_SALT', 'Q?k0oK_WUGVPzky=c0%OP*wvCXvIEp;,qOIQZF`/A/W|0}Xz^{#.SaZMKiA#gE8n' );
define( 'LOGGED_IN_SALT',   '4KHWH2?iqG@X+[i$g/SO*T?eRzM-80!d:cUu4.aiQgu]?*5ctUF9p4slq6Y$S;TX' );
define( 'NONCE_SALT',       'xy`wGZGWob&4]  _iM$P`D6am:oS6h}so1=V/BzvUl9h5!R]T&<>c@3/YA ^|l1V' );

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
