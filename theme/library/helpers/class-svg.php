<?php
/**
 * Static helpers for using svgs
 * in your theme
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_SVG
 */
class MOZ_SVG {


	/**
	 * Get a given svg's
	 * markup
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_svg( $filename ) {
		ob_start();
			locate_template( "assets/svg/$filename.svg", true, false );
		return ob_get_clean();
	}


	/**
	 * Print a given svg's
	 * markup
	 *
	 * @param $filename
	 */
	public static function svg( $filename ) {
		echo self::get_svg( $filename );
	}


	/**
	 * Get the markup for an
	 * svg sprite icon
	 *
	 * @param string $icon
	 * @param array  $options
	 *
	 * @return string
	 */
	public static function get_icon( $icon, $options = array() ) {
		if ( is_array( $icon ) && isset( $icon['icon'] ) ) {
			$icon = $icon['icon'];
		}

		$attrs = array_merge( array(
			'role' => 'img',
			'class' => 'icon'
		), $options );

		$svg_use = MOZ_Html::get_element( 'use', array(
			'xmlns:xlink' => 'http://www.w3.org/1999/xlink',
			'xlink:href'  => "#icon-$icon"
		) );

		return MOZ_Html::get_element( 'svg', $attrs, $svg_use );
	}


	/**
	 * Print the markup for an
	 * svg sprite icon
	 *
	 * @param string $icon
	 * @param array  $options
	 */
	public static function icon( $icon, $options = array() ) {
		echo self::get_icon( $icon, $options );
	}
}
