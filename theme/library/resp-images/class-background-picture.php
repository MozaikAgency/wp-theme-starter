<?php
/**
 * WordPress Responsive Background
 * Image Helper
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_Background_Picture
 *
 */
class MOZ_Background_Picture extends MOZ_Srcset_Sizes {


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
	static function get_background( $image, $base_size, $sizes, $extras = array() ) {

		if ( ! is_array( $sizes ) ) {
			$sizes = array();
		}

		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$options = wp_parse_args( $extras, array(
			'class' => '',
			'alt'   => self::get_img_alt( $image )
		) );

		$unique = uniqid( 'moz-picture--' );
		$options['class'] .= " $unique";

		ob_start(); ?>

			<span role="img" class="moz-picture--background <?php echo esc_attr( $options['class'] ); ?>">

				<?php if ( $options['alt'] && ! empty( $options['alt'] ) ) : ?>
					<span class="visuallyhidden">
						<?php echo esc_html( $options['alt'] ); ?>
					</span>
				<?php endif; ?>

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

			</span>

		<?php
		return ob_get_clean();
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
	static function background( $image, $base_size, $sizes, $extras = array() ) {
		echo self::get_background( $image, $base_size, $sizes, $extras );
	}
}