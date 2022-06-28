<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file.
 * 
 * Please note if you add constants in this file (i.e. define statements) 
 * these cannot be overridden in environment config files so make sure these are only set once.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    2.0.0
 * @author     Studio 24 Ltd  <hello@studio24.net>
 */
  

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '|jW<p0iH:I]5&h/sW<1f]Q+;DDi<o#A|uObf?!|za|-]~-WgzR-ou:FQ+h_]jyRd');
define('SECURE_AUTH_KEY',  'A)tk%{8~I?z/-+qGT%wL2%EVz1H(-C$ 9izTi|^JMEWlzr{=:=Zi&|{7hBRCv7Q3');
define('LOGGED_IN_KEY',    'qN%$-K{GayjXBly}Cws}GC&#bQow7:$ok+VdZ8#K@lW= 14/H#IF0RCe5-2>}2^_');
define('NONCE_KEY',        'Y4K|iEe|`pVH CFM if0&^}c+0T^ L/]2B9;^KN%2?|:rp+#<GmErzLWT${^jrYd');
define('AUTH_SALT',        '13x-:)N-HU|0wYD(O7,U/P+Z{[v_g%`WON4b,#9]&K{dP2Gw>iIX(~|:thhEZ*i,');
define('SECURE_AUTH_SALT', 'Z=}$l<VV*[?{a(}N`h_bCS-y.-FkI,*JNjIT,SIEB=uH^(lBdB+?X..Nd6_||Nj,');
define('LOGGED_IN_SALT',   ';8ND{J_m/h7vkf|jD$U[$Kd+Mlf0]oR|/|`F<wI.e /KEGw3MH,}K)T%W=`lY|cD');
define('NONCE_SALT',       '*|95P]VgFDbPji3z2oHR~rC 8x+=T.BPP?R TB{we*QVPc_ ~yI&*-wN$:(joBpe');

/**#@-*/


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * Increase memory limit. 
 */
define('WP_MEMORY_LIMIT', '64M');

/**
 * Ben - Disable automatic updates as they will be managed through version control
 */
define('AUTOMATIC_UPDATER_DISABLED', true);

define('DISALLOW_FILE_EDIT', true);

define('WP_ROCKET_EMAIL', 'dan@tessellate.co.uk');
define('WP_ROCKET_KEY', '5a42258a');
define('WPMDB_LICENCE', 'b5b3dcc9-bfcf-4d88-97da-7edd0761d7b1');
define('ACF_PRO_LICENSE', 'b3JkZXJfaWQ9MzM5NTB8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA5IDA2OjU3OjA3');

define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', false);