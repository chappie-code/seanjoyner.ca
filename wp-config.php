<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'seanjoyner.ca');

/** MySQL database username */
define('DB_USER', 'i3283682_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'Y^mhJX[P5U6HHgUt&y(59[*3');

/** MySQL hostname */
define('DB_HOST', 'puffpuffshare-db.cafck54lrxjo.us-west-2.rds.amazonaws.com');

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
define('AUTH_KEY',         'DIMOnRrNKHhhdhL9GNYNMjlDaBUUAnrlNAsir1pUbKX9UUWRV0YHU3wIPjeFLcJS');
define('SECURE_AUTH_KEY',  'oqTU3DbSvnrfpjCuoX0dVOJJz002DBtgdvmvDCREIxeNBWvRIuezklXQcqx0Y7yG');
define('LOGGED_IN_KEY',    'SS4c58wehtYyA6JwVwwgE1yvMTuTaH2XG5RLmU4OY85OOVwqC0AwsCu1CqoK1mZ2');
define('NONCE_KEY',        'j4oYC0QAKQ2oghZBwbTwFTBGq9sXtXK2lXtLXdkRtkfOC2IoCN0ZWM6KRYOQCS2e');
define('AUTH_SALT',        'j3KXSaStRhtfhIoTQ1p9dW3pE2I90UQD85IdAyR5c1YHPkhEU5tzamMzeqF0TcrO');
define('SECURE_AUTH_SALT', 'd03C7gASBWRpg0mnfbQ3iwKQYmLsKJar9PapaJdGc1Z8BnIAUpkAh3OGn8HunpY3');
define('LOGGED_IN_SALT',   'qgvAACCpxWVmTiRu1dOEaXilY2G31tm1fDsRTS4AjFPp7yRTmJcBy2ZZn20ertxP');
define('NONCE_SALT',       'MPViLYrQXQGtPSmuTXhqi7g0aQuoIrjMiULVCiUyjbefRXhGacbt4f6rAzcGtxfL');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
