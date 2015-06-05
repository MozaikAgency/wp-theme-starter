<?php



/**
 * Class MOZ_SrcSetSizes
 *
 */
class MOZ_SrcSetSizes {

	/**
	 * @var int
	 */
	var $image;


	/**
	 * Get an image's alt
	 * attribute
	 *
	 * @param $image
	 *
	 * @return string
	 */
	protected static function get_img_alt( $image ) {
		return trim( strip_tags( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) );
	}


	/**
	 * Get the srcset for the given
	 * image size
	 *
	 * @param string $size
	 *
	 * @returns string|null
	 */
	protected function get_srcset( $size ) {
		if ( $src = wp_get_attachment_image_src( $this->image, $size, false ) ) {
			return "{$src[0]} {$src[1]}w";
		}

		return null;
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
	public function get_image( $image, $sources, $sizes, $extras = array() ) {
		if ( ! is_array( $sizes ) ) {
			$sizes = array();
		}

		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$this->image = $image;

		$srcset = array_map( array( &$this, 'get_srcset' ), $sources );

		$options = wp_parse_args( $extras, array(
			'class' => '',
			'alt'   => self::get_img_alt( $image )
		) );

		ob_start(); ?>

			<img class="<?php echo esc_attr( $options['class'] ); ?>"
			     srcset="<?php echo implode( ', ', $srcset ); ?>"
			     sizes="<?php echo implode( ', ', $sizes ); ?>"
			     alt="<?php echo esc_attr( $options['alt'] ); ?>"
				/>

		<?php
		return ob_get_clean();
	}


	/**
	 * Print the markup for an image
	 * using srcset and sizes
	 *
	 * @param int   $image
	 * @param array $sizes
	 * @param array $extras
	 */
	public function image( $image, $sizes, $extras = array() ) {
		echo self::get_image( $image, $sizes, $extras );
	}
}