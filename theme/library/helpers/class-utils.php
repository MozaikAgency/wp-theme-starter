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
	 * Return an escaped telephone
	 * string to be used with
	 * <a href="tel:{...}"></a>
	 *
	 * @param $tel {string}
	 *
	 * @return mixed
	 */
	public static function get_esc_tel( $tel ) {
		return preg_replace( '/[^0-9]/i', '', preg_replace( '/^\+/', '00', $tel ) );
	}


	/**
	 * Print an escaped telephone
	 * string to be used with
	 * <a href="tel:{...}"></a>
	 *
	 * @param $tel {string}
	 */
	public static function esc_tel( $tel ) {
		echo self::get_esc_tel( $tel );
	}


	/**
	 * Removes accents from
	 * characters in
	 * string
	 *
	 * @param string $str
	 *
	 * @returns string
	 */
	public static function remove_accents( $str ) {
		$accents_to_remove = array( 'ά','έ','ή','ί','ό','ύ','ώ','Ά','Έ','Ή','Ί','ΐ','Ό','Ύ','Ώ','ς','À','Â','Á','Ã','Ä','Ç','È','É','Ê','Ë','Î','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','à','à','á','â','ã','ä','ç','è','é','ê','ë','ì','í','î','ï','ò','ó','ô','õ','ù','ú','û','ü' );
		$replace_with      = array( 'α','ε','η','ι','ο','υ','ω','Α','Ε','Η','Ι','ι','Ο','Υ','Ω','Σ','A','A','A','A','A','C','E','E','E','E','I','O','O','O','O','O','U','U','U','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','u','u','u','u' );
		return str_replace( $accents_to_remove, $replace_with, remove_accents( $str ) );
	}


	/**
	 * Convert a string to
	 * uppercase and remove
	 * accents
	 *
	 * NOTE: Avoid passing in HTML
	 *       This method will dumbly
	 *       transform HTML tags and
	 *       attributes to uppercase
	 *       HTML entities eg: "&nbsp;"
	 *       are OK
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	public static function get_upper( $str ) {
		$all_uppercase = mb_strtoupper( self::remove_accents( $str ), 'UTF-8' );

		return preg_replace_callback( '/&([a-z\d]+);/i', function ( $matches ) {
			return strtolower( $matches[0] );
		}, $all_uppercase );
	}


	/**
	 * Convert a string to
	 * uppercase and remove
	 * accents then print it
	 *
	 * NOTE: Avoid passing in HTML
	 *       This method will dumbly
	 *       transform HTML tags and
	 *       attributes to uppercase
	 *       HTML entities eg: "&nbsp;"
	 *       are OK
	 *
	 * @param string $str
	 */
	public static function upper( $str ) {
		echo self::get_upper( $str );
	}


	/**
	 * Get the copyright years string
	 * depending on the current year
	 * and the original copyright
	 * year
	 *
	 * eg: '2014-2020'
	 *
	 * @param int    $original_copyright_year
	 * @param string $separator
	 *
	 * @return string
	 */
	public static function get_copyright_years( $original_copyright_year, $separator = '-' ) {
		$current_year = (int) date( 'Y' );

		return $current_year > (int) $original_copyright_year
			? "{$original_copyright_year}{$separator}{$current_year}"
			: $original_copyright_year;
	}


	/**
	 * Print the copyright years string
	 * depending on the current year
	 * and the original copyright
	 * year
	 *
	 * eg: '2014-2020'
	 *
	 * @param int    $original_copyright_year
	 * @param string $separator
	 *
	 * @return string
	 */
	public static function copyright_years( $original_copyright_year, $separator = '-' ) {
		echo self::get_copyright_years( $original_copyright_year, $separator );
	}
}