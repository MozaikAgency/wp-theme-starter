<?php
/**
 * Generic/Miscellaneous Utility
 * functions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_Utils
 *
 */
class MOZ_Utils {


	/**
	 * Removes accents from
	 * characters in
	 * string
	 *
	 * @param string $str
	 *
	 * @returns string
	 */
	static function remove_accents( $str ) {
		$accents_to_remove = array( 'Ü','Ý','Þ','ß','ü','ý','þ','¢','¸','¹','º','À','¼','¾','¿','ò','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?' );
		$replace_with      = array( 'á','å','ç','é','ï','õ','ù','Á','Å','Ç','É','é','Ï','Õ','Ù','Ó','A','A','A','A','A','C','E','E','E','E','I','O','O','O','O','O','U','U','U','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','u','u','u','u' );
		return str_replace( $accents_to_remove, $replace_with, remove_accents( $str ) );
	}


	/**
	 * Convert a string to
	 * uppercase and remove
	 * accents
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	static function get_upper( $str ) {
		$all_uppercase = mb_strtoupper( self::remove_accents( $str ), 'UTF-8' );

		return str_replace(
			array( '&AMP;', '&RSQUO;' ),
			array( '&amp;', '&rsquo;' ),
			$all_uppercase
		);
	}


	/**
	 * Convert a string to
	 * uppercase and remove
	 * accents then print it
	 *
	 * @param string $str
	 */
	static function upper( $str ) {
		echo self::get_upper( $str );
	}
}