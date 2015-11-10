<?php
/**
 * BEM class name convention
 * helper
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_BEM
 *
 */
class MOZ_BEM {


	/**
	 * Get the BEM className
	 * string given a list of
	 * element/modifier names
	 * and a block name
	 *
	 * @param $block
	 * @param $sub_classes
	 *
	 * @return string
	 */
	public static function get_bem( $block, $sub_classes = array() ) {
		return $block . implode( " $block", (array) $sub_classes );
	}


	/**
	 * Print the BEM className
	 * string given a list of
	 * element/modifier names
	 * and a block name
	 *
	 * @param $block
	 * @param $sub_classes
	 *
	 * @return string
	 */
	public static function bem( $block, $sub_classes = array() ) {
		echo self::get_bem( $block, $sub_classes );
	}
}
