<?php
/**
 * The Library Loader
 *
 */


// make sure this file is called by wp
defined( 'ABSPATH' ) or die();


// Register the class autoloader for
// the mozaik library
spl_autoload_register( function ( $class ) {
	$prefix = 'MOZ_';

	if ( substr( $class, 0, strlen( $prefix ) ) == $prefix ) {
		$class = substr( $class, strlen( $prefix ) );
	} else {
		return;
	}

	$class = strtolower( $class );
	$class = str_replace( '_', '-', $class );

	$path = "class-$class.php";

	foreach ( array( '', 'helpers' ) as $dir ) {
		if ( ! empty( $dir ) ) {
			$dir = $dir . DIRECTORY_SEPARATOR;
		}

		if ( file_exists( __DIR__ . DIRECTORY_SEPARATOR . $dir . $path ) ) {
			include $dir . $path;
			break;
		}
	}
} );