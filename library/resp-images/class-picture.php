<?php
/**
 * WordPress Picture Element
 * Helper
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_Picture
 *
 */
class MOZ_Picture extends MOZ_Srcset_Sizes {


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
	public function get_picture( $image, $base_size, $sizes, $extras = array() ) {
		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$this->image = $image;

		$options = wp_parse_args( $extras, array(
			'class' => '',
			'alt'   => self::get_img_alt( $image )
		) );

		ob_start(); ?>

			<picture<?php if ( ! empty( $options['class'] ) ) echo " {$options['class']}"; ?>>

				<?php foreach ( $sizes as $size => $query ) :
					$src = wp_get_attachment_image_src( $image, $size, false );
					?>
					<source srcset="<?php echo esc_attr( $src[0] ); ?>"
					        media="<?php echo esc_attr( $query ); ?>"
					        type="<?php echo esc_attr( get_post_mime_type( $image ) ); ?>"
						/>
				<?php endforeach; ?>

				<?php $base_src = wp_get_attachment_image_src( $image, $base_size, false ); ?>
				<img srcset="<?php echo esc_attr( $base_src[0] ); ?>"
				     alt="<?php echo esc_attr( $options['alt'] ); ?>"
					/>

			</picture>

		<?php
		return ob_get_clean();
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
	public function picture( $image, $base_size, $sizes, $extras = array() ) {
		echo self::get_picture( $image, $base_size, $sizes, $extras );
	}
}