<?php
/**
 * The Includes Loader
 *
 * How to:
 * 1. Create a file like: class-banner-controller.php
 * 2. In the file write a class like: MInc_Banner_Controller
 * 3. The class will be autoloaded when called (no need to require/include), eg:
 *    `new MInc_Banner_Controller();` or `MInc_Banner_Controller::get_title();`
 */


// make sure this file is called by wp
defined( 'ABSPATH' ) or die();


// Register the class autoloader for
// the mozaik library
spl_autoload_register( function ( $class ) {
	$prefix = 'MInc_';

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
