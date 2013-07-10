<?php
// ** MySQL settings ** //
define('DB_NAME', 'neslenc_askwilla');    // The name of the database
define('DB_USER', 'neslenc_askwila');     // Your MySQL username
define('DB_PASSWORD', 'Lai3WN3N$.d!'); // ...and password
define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Change each KEY to a different unique phrase.  You won't have to remember the phrases later,
// so make them long and complicated.  You can visit http://api.wordpress.org/secret-key/1.1/
// to get keys generated for you, or just make something up.  Each key should have a different phrase.
define('AUTH_KEY', 'eBeP@DHpKot09x,g->QPA7I&4lUVqD}3d.?JYWQND5z_4BG4xPF'); // Change this to a unique phrase.
define('SECURE_AUTH_KEY', 'XS1I2MGCt5q=HfZ=G$rjUl193ZnAG4sdF7Tvb$>=E3z#1?JN'); // Change this to a unique phrase.
define('LOGGED_IN_KEY', 'D2@mRg1KVjTCgw&XJ+497lEp>aC>9t6haG3PN<Ji4d#nhKMkI0!#'); // Change this to a unique phrase.

// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = 'wp_';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-content/languages.
// For example, install de.mo to wp-content/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
?>
