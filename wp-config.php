<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '247lockdoc');

/** MySQL database username */
define('DB_USER', 'noam');

/** MySQL database password */
define('DB_PASSWORD', 'noam11');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '^R/sGq`qX$/=@c/BL?.&Vz#Vy;c-FyJU8|=!NM9.2 B<@oH3m(HJA{jt<V:3 38{');
define('SECURE_AUTH_KEY',  '-o|Em3{~BQkNnFX+o1!?IV=#iHI&E n8T+z5ZV:1%9#e*{>[?;qv=([|!iR+KweC');
define('LOGGED_IN_KEY',    '}$s,_c(>0-E*V~l)<h6o?Ru~4,ze}`V5v lUH<ZC;l6CM^Rc+2g.rHy=6;xQC;f5');
define('NONCE_KEY',        '3v7nwpz~A1+D,iHFl_)>-a&CB<*X0)hghs=*Pqi-UE Hx|zS+v~d]KE^$e)FOua/');
define('AUTH_SALT',        'X_Jk#.a-+JH(XHJPkYu-0LF^v8:6}+!LK]|}LtCLw!eHf.{i;ix1_oVkC}Z$aTuW');
define('SECURE_AUTH_SALT', 'X5<F9G6/ZKpf:4V7kx3/rZc4v-K8Rh5%+)qFM-O-6U*/HmIV~`mMN6REVfcbSC.:');
define('LOGGED_IN_SALT',   'TMXO{zwdnlZ!{XO?f_#PtfUt|#03`ue,;yurk_kC,dHSoAd|v9A)@}tT1eW|bc|k');
define('NONCE_SALT',       ':M^OceTT$&GP-651_WJ#y1T4e;5>2GO,me}LS7-ww!j.+#M>i%&weF-6NK-jj{{c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

