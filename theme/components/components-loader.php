<?php
/**
 * The Includes Loader
 *
 * How to:
 * 1. Create a file like: class-content.php
 * 2. In the file write a class like: Component_Content
 * 3. The class will be autoloaded when called (no need to require/include), eg:
 *    `Component_Content::render();`
 */


// make sure this file is called by wp
defined( 'ABSPATH' ) or die();


// Register the class autoloader for
// the mozaik library
spl_autoload_register( function ( $class ) {
	$prefix = 'Component_';

	if ( substr( $class, 0, strlen( $prefix ) ) == $prefix ) {
		$class = substr( $class, strlen( $prefix ) );
	} else {
		return;
	}

	$class = strtolower( $class );
	$class = str_replace( '_', '-', $class );

	$path = "class-$class.php";

	foreach ( array( '' ) as $dir ) {
		if ( ! empty( $dir ) ) {
			$dir = $dir . DIRECTORY_SEPARATOR;
		}

		if ( file_exists( __DIR__ . DIRECTORY_SEPARATOR . $dir . $path ) ) {
			include $dir . $path;
			break;
		}
	}
} );
