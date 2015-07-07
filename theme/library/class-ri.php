<?php
/**
 * WordPress Responsive Images
 * Implementation
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_RI
 */
class MOZ_RI {



	/**
	 * Get the markup for a
	 * responsive background
	 * image
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array|null $sizes
	 * @param array|null $extras
	 *
	 * @return bool|string
	 */
	public static function get_background( $image, $base_size, $sizes, $extras = array() ) {
		if ( ! is_array( $sizes ) ) {
			$sizes = array();
		}

		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$attrs = array_merge( array(
			'class' => '',
			'role'  => 'img',
			'alt'   => MOZ_Helpers::get_img_alt( $image )
		), $extras );

		$unique = uniqid( 'moz-background-picture--' );
		$attrs['class'] .= " moz-background-picture $unique";

		$alt = $attrs['alt'];
		unset( $attrs['alt'] );

		$content = MOZ_Helpers::get_element( 'span', array( 'class' => 'visuallyhidden' ), $alt );

		ob_start(); ?>

		<style>
			.<?php echo $unique; ?> {
				background-image: url('<?php echo wp_get_attachment_image_src( $image, $base_size )[0]; ?>');
			}

			<?php foreach ( $sizes as $size => $query ) : ?>
			@media all and <?php echo esc_html( $query ); ?> {
				.<?php echo $unique; ?> {
					background-image: url('<?php echo wp_get_attachment_image_src( $image, $size )[0]; ?>');
				}
			}

			<?php endforeach; ?>
		</style>

		<?php
		$content .= ob_get_clean();

		return MOZ_Helpers::get_element( 'span', $attrs, $content );
	}



	/**
	 * Print the markup for a
	 * responsive background
	 * image
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array|null $sizes
	 * @param array|null $extras
	 */
	public static function background( $image, $base_size, $sizes, $extras = array() ) {
		echo self::get_background( $image, $base_size, $sizes, $extras );
	}



	/**
	 * Get the markup for a
	 * picture element
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array|null $sizes
	 * @param array|null $extras
	 *
	 * @return bool|string
	 */
	public static function get_picture( $image, $base_size, $sizes, $extras = array() ) {
		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$content = array();

		foreach ( array_reverse( $sizes ) as $size => $query ) {
			$src       = wp_get_attachment_image_src( $image, $size, false );
			$content[] = MOZ_Helpers::get_sc_element( 'source', array(
				'srcset' => esc_attr( $src[0] ),
				'media'  => esc_attr( $query ),
				'type'   => esc_attr( get_post_mime_type( $image ) )
			) );
		}

		$base_src  = wp_get_attachment_image_src( $image, $base_size, false );
		$attrs     = array_merge( array(
			'srcset' => esc_attr( $base_src[0] ),
			'alt'    => MOZ_Helpers::get_img_alt( $image )
		), $extras );
		$content[] = MOZ_Helpers::get_sc_element( 'img', $attrs );

		return MOZ_Helpers::get_element( 'picture', array(), implode( '', $content ) );
	}


	/**
	 * Print the markup for a
	 * picture element
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array|null $sizes
	 * @param array|null $extras
	 */
	public static function picture( $image, $base_size, $sizes, $extras = array() ) {
		echo self::get_picture( $image, $base_size, $sizes, $extras );
	}



	/**
	 * Get the markup for an image
	 * using srcset and sizes
	 *
	 * @param int   $image
	 * @param array $sources
	 * @param array $sizes
	 * @param array $extras
	 *
	 * @returns string
	 */
	public static function get_image( $image, $sources, $sizes, $extras = array() ) {
		if ( ! is_array( $sizes ) ) {
			$sizes = array();
		}

		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$srcset = array();
		foreach ( $sources as $size ) {
			if ( $src = wp_get_attachment_image_src( $image, $size, false ) ) {
				$srcset[] = "{$src[0]} {$src[1]}w";
			}
		}

		if ( empty( $srcset ) ) {
			return false;
		}

		$attrs = array_merge( array(
			'srcset' => implode( ', ', $srcset ),
			'sizes'  => implode( ', ', $sizes ),
			'alt'    => MOZ_Helpers::get_img_alt( $image )
		), $extras );

		return MOZ_Helpers::get_sc_element( 'img', $attrs );
	}



	/**
	 * Print the markup for an image
	 * using srcset and sizes
	 *
	 * @param int   $image
	 * @param array $sources
	 * @param array $sizes
	 * @param array $extras
	 */
	public static function image( $image, $sources, $sizes, $extras = array() ) {
		echo self::get_image( $image, $sources, $sizes, $extras );
	}
}