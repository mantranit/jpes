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
define( 'DB_NAME', 'xqauaqxnzfz8' );

/** MySQL database username */
define( 'DB_USER', 'xqauaqxnzfz8' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ysqodsg9wwb0' );

/** MySQL hostname */
define( 'DB_HOST', 'mariadb103.websupport.sk:3313' );

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
define( 'AUTH_KEY',          'i<J <NtE3o%JY~JiceSL 4m&icy4X-6/6%W+Q86:ih<L*pl1|jpW|!CDL&!FXZ+z' );
define( 'SECURE_AUTH_KEY',   'aEUo-4cmmA:WN&${.9oK=(H4^_}dM(KEk5oUG?IgXz@Bhg mJM+O@ndYK:CA]hYV' );
define( 'LOGGED_IN_KEY',     'Y@yQwH%:>tA%3kPNK0Ij+}+&ag{kaP_ T>0 5Y<I8:5#*oL#7@K_wh_@twAy,a~2' );
define( 'NONCE_KEY',         'qj>@<wmmGgCD&]5g[Q(ppeJsX+DJ;KIa.||BBWEDjgK4Ar>|CIjI$SOv*wmjUp!?' );
define( 'AUTH_SALT',         'C<1aLX0sO_~?-Y.B]E|/RO.pPf2ZOEFx;KIBL^Xjmi@2g27%=p4L]U:lU_Za)xlx' );
define( 'SECURE_AUTH_SALT',  ':S&S9Rh9zkB}>C8gx.d.D#OHP=958Y-v7WDJ%([Lb#}qeL-c:f{*G l{#$0g=-lZ' );
define( 'LOGGED_IN_SALT',    '-}in|w>2HL^EI:V>gNnKtLvN#[EqP^ZzoMb~aIxS(|gw9h~wz;b=WGG)Y]`[<3!r' );
define( 'NONCE_SALT',        '9j(yRZ3=&Ln]0ws}2B5=2cgP|TQn@!H)=vS~Nl(PFk@B12 {r-q 0yRfGq:Dq/NC' );
define( 'WP_CACHE_KEY_SALT', '@qr2BaJ~vc=FA;t}P}TN~56};lX7oFnRj*elNjH%+ :mk`%G5HAMQ_D;0*i}F}bL' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define('WP_SITEURL','https://' . ($_SERVER['HTTP_X_WP_TEMPORARY'] ? $_SERVER['HTTP_X_WP_TEMPORARY'] : 'jpes.launch2go.net'));
define('WP_HOME', 'https://' . ($_SERVER['HTTP_X_WP_TEMPORARY'] ? $_SERVER['HTTP_X_WP_TEMPORARY'] : 'jpes.launch2go.net'));
define('WP_MEMORY_LIMIT', '256M');
define('WPLANG', 'en_US');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
