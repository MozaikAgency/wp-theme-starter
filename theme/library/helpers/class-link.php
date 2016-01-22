<?php
/**
 * WordPress Link-making Helpers
 *
 * @author Max G J Panas <http://maxpanas.com>
 */



/**
 * Class MOZ_Link
 *
 */
class MOZ_Link {


	/**
	 * Get the href from an
	 * acf internal/external
	 * link
	 *
	 * Note: assumes $data is an array like eg:
	 *       [
	 *         'type' => 'internal' or 'custom'
	 *         'internal' => url...
	 *         'custom' => url...
	 *       ]
	 *
	 * @param array $data
	 *
	 * @return bool
	 */
	public static function get_link_href( $data ) {
		return ( isset( $data[ $data['type'] ] ) && ! empty( $data[ $data['type'] ] ) )
			? $data[ $data['type'] ]
			: false;
	}


	/**
	 * Print the href from an
	 * acf internal/external
	 * link
	 *
	 * Note: assumes $data is an array like eg:
	 *       [
	 *         'type' => 'internal' or 'custom'
	 *         'internal' => url...
	 *         'custom' => url...
	 *       ]
	 *
	 * @param array $data
	 */
	public static function link_href( $data ) {
		echo self::get_link_href( $data );
	}


	/**
	 * Add target="_blank"
	 * to the given attribute
	 * array if the specified
	 * href is external
	 *
	 * @param array $attrs
	 *
	 * @return mixed
	 */
	public static function add_link_target( $attrs ) {
		if (
			! isset( $attrs['target'] )
			&& isset( $attrs['href'] )
			&& ! wp_validate_redirect( $attrs['href'], false )
		) {
			$attrs['target'] = '_blank';
		}

		return $attrs;
	}


	/**
	 * Add rel="nofollow"
	 * to the given attribute
	 * array if the specified
	 * href is external
	 *
	 * @param array $attrs
	 *
	 * @return mixed
	 */
	public static function add_link_rel( $attrs ) {
		if (
			isset( $attrs['href'] )
			&& ! empty( $attrs['href'] )
			&& ! wp_validate_redirect( $attrs['href'], false )
		) {
			$attrs['rel'] = 'nofollow';
		}

		return $attrs;
	}


	/**
	 * Get an anchor tag
	 *
	 * @param array  $data
	 * @param array  $attrs
	 * @param string $content
	 *
	 * @return string
	 */
	public static function get_link( $data = null, $attrs = array(), $content = '' ) {
		if ( ! empty( $data ) && $href = self::get_link_href( $data ) ) {
			$attrs['href'] = $href;
		}

		return MOZ_Html::get_element( 'a', self::add_link_target( $attrs ), $content );
	}


	/**
	 * Print an anchor tag
	 *
	 * @param null   $data
	 * @param array  $attrs
	 * @param string $content
	 */
	public static function link( $data = null, $attrs = array(), $content = '' ) {
		echo self::get_link( $data, $attrs, $content );
	}
}
