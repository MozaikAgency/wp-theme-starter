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
	 * Determine whether an
	 * image should be
	 * lazy-loaded
	 *
	 * @param array $extras
	 *
	 * @return bool
	 */
	public static function is_lazy( &$extras ) {
		$lazy = false;

		if ( isset( $extras['lazy'] ) ) {
			$lazy = ! ! $extras['lazy'];
			unset( $extras['lazy'] );
		}

		return $lazy;
	}


	/**
	 * Determine whether an
	 * image should have the
	 * lazy class from the
	 * start
	 *
	 * @param array $extras
	 *
	 * @return bool
	 */
	public static function should_add_lazy_class( &$extras ) {
		$should_add = true;

		if ( isset( $extras['lazy_class'] ) ) {
			$should_add = ! ! $extras['lazy_class'];
			unset( $extras['lazy_class'] );
		}

		return $should_add;
	}


	/**
	 * Maybe "lazify" the attributes
	 * of an image depending on
	 * whether it should
	 * be lazy-loaded
	 *
	 * @param bool  $is_lazy
	 * @param array $attrs
	 * @param bool  $add_class
	 * @param bool  $add_src
	 *
	 * @return array
	 */
	public static function maybe_lazify( $is_lazy = false, $attrs = array(), $add_class = true, $add_src = true ) {
		if ( ! $is_lazy ) {
			return $attrs;
		}

		$lazifiables = array( 'src', 'srcset', 'sizes' );
		foreach ( $lazifiables as $lazifiable ) {
			if ( isset( $attrs[ $lazifiable ] ) ) {
				$attrs["data-$lazifiable"] = $attrs[ $lazifiable ];
				unset( $attrs[ $lazifiable ] );
			}
		}

		if ( $add_class && self::should_add_lazy_class( $attrs ) ) {
			$attrs['class'] = isset( $attrs['class'] )
				? "{$attrs['class']} lazyload"
				: 'lazyload';
		}

		if ( $add_src ) {
			$attrs['src'] = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		}

		return $attrs;
	}


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

		$is_lazy = self::is_lazy( $extras );

		$attrs = array_merge( array(
			'class' => '',
			'role'  => 'img',
			'alt'   => self::get_img_alt( $image )
		), $extras );

		$alt = $attrs['alt'];
		unset( $attrs['alt'] );

		$content = MOZ_Html::get_element( 'span', array( 'class' => 'visuallyhidden' ), $alt );

		$unique = uniqid( 'moz-background-picture--' );
		$attrs['class'] .= " moz-background-picture $unique";

		if ( $is_lazy ) {
			if ( self::should_add_lazy_class( $attrs ) ) {
				$attrs['class'] .= ' lazyload';
			}

			$bgset = array( wp_get_attachment_image_src( $image, $base_size, false )[0] );
			foreach ( $sizes as $size => $query ) {
				$src = wp_get_attachment_image_src( $image, $size, false );
				$bgset[] = "$src[0] [$query]";
			}
			$attrs['data-sizes'] = 'auto';
			$attrs['data-bgset'] = implode( ' | ', array_reverse( $bgset ) );

		} else {
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
		}

		return MOZ_Html::get_element( 'span', $attrs, $content );
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

		$is_lazy = self::is_lazy( $extras );

		$content = array();

		// required for IE9 support...
		$content[] = '<!--[if IE 9]><video style="display: none;"><![endif]-->';

		foreach ( array_reverse( $sizes ) as $size => $query ) {
			$src = wp_get_attachment_image_src( $image, $size, false );

			$attrs = self::maybe_lazify( $is_lazy, array(
				'srcset' => esc_attr( $src[0] ),
				'media'  => esc_attr( $query ),
				'type'   => esc_attr( get_post_mime_type( $image ) )
			), false, false );

			$content[] = MOZ_Html::get_sc_element( 'source', $attrs );
		}

		$base_src = wp_get_attachment_image_src( $image, $base_size, false );

		$attrs = self::maybe_lazify( $is_lazy, array_merge( array(
			'srcset' => esc_attr( $base_src[0] ),
			'alt'    => self::get_img_alt( $image )
		), $extras ) );

		$content[] = MOZ_Html::get_sc_element( 'img', $attrs );

		$content[] = '<!--[if IE 9]></video><![endif]-->';

		return MOZ_Html::get_element( 'picture', array(), implode( '', $content ) );
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
				$srcset[] = "{$src[0]} {$src[1]}w {$src[2]}h";
			}
		}

		if ( empty( $srcset ) ) {
			return false;
		}

		$is_lazy = self::is_lazy( $extras );

		$attrs = self::maybe_lazify( $is_lazy, array_merge( array(
			'srcset' => implode( ', ', $srcset ),
			'sizes'  => implode( ', ', $sizes ),
			'alt'    => self::get_img_alt( $image )
		), $extras ) );

		return MOZ_Html::get_sc_element( 'img', $attrs );
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