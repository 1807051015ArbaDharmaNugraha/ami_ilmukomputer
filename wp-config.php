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
define( 'AUTH_KEY',         '9<Wxi<?_(v@pM5]:F7:H&jIlpc2;O*cO5BuN]{<+V}<D`UYzZV0ws)Xo#x6O>Mvu' );
define( 'SECURE_AUTH_KEY',  'IlT2J:ACJ34Y_r[!kSRG-Ae>Sg ]cl8PnV`s =0*PkM#.P}}9jbeM[h~Dq0B/jWX' );
define( 'LOGGED_IN_KEY',    'Wv<ou~`Y,<^[x@ptU8EaSZGBd[p*ct#Iq6L+2E$5jr&OfEN@Ot0>gH8etW<J0t!a' );
define( 'NONCE_KEY',        '2mc4bp~a{/t|owG*!9}[0uY/cF&ILXFC+#C%> 2<c,CQ,K 1`7<^<J,K#4 0@72,' );
define( 'AUTH_SALT',        'mfMCMsD2GT`L)WlS[sWB]].sfy]q_#Ykbnf;Ue:zZ3mzY=BJS|tTxq_aSzfH?8_T' );
define( 'SECURE_AUTH_SALT', 'Owr(c@yI=zzimH|d|FntPDr}2|Y4a`QX)]zr(VjIKZCNg$~qZPfKI}:Zs{Ur9>Gp' );
define( 'LOGGED_IN_SALT',   '5<i|c=%Nhm-9]LBN/7m-W08EG*Vl0cmWyIRi@6E/3gwpw347wE9~6n4!6UA+hm.L' );
define( 'NONCE_SALT',       'K4}`u:}4?qo4=&0.g^^f+[[F=a%J*D=GeZtdU6P<zxFot4M3}v97+=/VMf;(HGg-' );

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
