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
define( 'DB_NAME', 'xone' );

/** MySQL database username */
define( 'DB_USER', 'xone' );

/** MySQL database password */
define( 'DB_PASSWORD', 'xone' );

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
define( 'AUTH_KEY',         'X3Mz.l?R!q/dPoCYx*]KD3t>sKpoceR_1NI3vbmHeMeAk[O]M%:)O|,`]K.<f^J.' );
define( 'SECURE_AUTH_KEY',  'UJ4q3badrFXMwg))5<mpKopsT}C~Qlz]l8y 6U$em;lTFriSuf>>9%!D~|<,)Rf%' );
define( 'LOGGED_IN_KEY',    'Vv{K f+=^#j1%0o F8+;[0i/#L7qXRD,gtA^hPF~8%eDia]j8E.I?SR6LrNDJ<qb' );
define( 'NONCE_KEY',        'i5Q-4EQ8)cjpm]It}N&|cv#ftLPj$9[HyHrL@8E39G=Pm2@P7ivb)*._rRKNr96^' );
define( 'AUTH_SALT',        '_-;MUDUwTAMZ~*pqrR3g=dCBro|/p~au_y GlAW@-u{S|]fAI?>FDgwm*htXT@fV' );
define( 'SECURE_AUTH_SALT', 'n,DmXfrM)Fr|jKZYbB+!D! F&fq&$BcUWr4=Roe181]SjHwOA?N5Ix#0-}RQwE-d' );
define( 'LOGGED_IN_SALT',   'P+<k.#fvgH/|rn~Byod~]8gwbu<LV#fq9K-3v7#5*{)Wc#7&K7_|?;_+r6?JMI&q' );
define( 'NONCE_SALT',       '#WzM5Fuah4W t6,GP7[nxO}$5621]b-U7$zl%Wg(7(Dk@}er8u<Mpfg(FDrp/9(`' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'xne_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
