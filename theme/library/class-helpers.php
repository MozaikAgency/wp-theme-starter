<?php
/**
 * WordPress HTML Helpers
 *
 * @author Max G J Panas <http://maxpanas.com>
 */



/**
 * Class MOZ_Helpers
 *
 *
 */
class MOZ_Helpers {


	/**
	 * Get an image's alt
	 * attribute
	 *
	 * @param $image
	 *
	 * @return string
	 */
	public static function get_img_alt( $image ) {
		return trim( strip_tags( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) );
	}


	/**
	 * Returns a self-closing HTML
	 * element constructed
	 * by php
	 *
	 * @param $tag     string
	 * @param $attrs   array
	 *
	 * @return string
	 */
	static function get_sc_element( $tag = 'img', $attrs = array() ) {
		$html = "<$tag";
		foreach ( $attrs as $attr => $value ) {
			$html .= " $attr=\"$value\"";
		}
		$html .= '>';

		return $html;
	}


	/**
	 * Prints a self-closing HTML
	 * element constructed
	 * by php
	 *
	 * @param $tag     string
	 * @param $attrs   array
	 *
	 * @return string
	 */
	static function sc_element( $tag = 'img', $attrs = array() ) {
		echo self::get_sc_element( $tag, $attrs );
	}


	/**
	 * Returns an HTML
	 * element constructed
	 * by php
	 *
	 * @param $tag     string
	 * @param $attrs   array
	 * @param $content string
	 *
	 * @return string
	 */
	static function get_element( $tag = 'div', $attrs = array(), $content = '' ) {
		$html = self::get_sc_element( $tag, $attrs );

		$html .= $content;

		$html .= "</$tag>";

		return $html;
	}


	/**
	 * Prints an HTML
	 * element constructed
	 * by php
	 *
	 * @param $tag     string
	 * @param $attrs   array
	 * @param $content string
	 *
	 * @return string
	 */
	static function element( $tag = 'div', $attrs = array(), $content = '' ) {
		echo self::get_element( $tag, $attrs, $content );
	}
}