<?php
/**
 * WordPress Responsive Images
 * Implementation
 *
 * @author Max G J Panas <http://maxpanas.com>
 */



/**
 * Class MOZ_Image
 *
 */
class MOZ_Image {


	/**
	 * Determine whether an
	 * image should be
	 * lazy-loaded
	 *
	 * default: false
	 *
	 * @param array $flags
	 *
	 * @return bool
	 */
	protected static function is_lazy( $flags ) {
		return isset( $flags['lazy'] ) && ! ! $flags['lazy'];
	}


	/**
	 * Determine whether a
	 * lazy image should have
	 * the lazy class from the
	 * start
	 *
	 * default: true
	 *
	 * @param array $flags
	 *
	 * @return bool
	 */
	protected static function should_add_lazy_class( $flags ) {
		return isset( $flags['lazy_class'] )
			? ! ! $flags['lazy_class']
			: true;
	}


	/**
	 * Maybe "lazify" the attributes
	 * of an image depending on
	 * whether it should
	 * be lazy-loaded
	 *
	 * @param array     $flags
	 * @param array     $attrs
	 * @param bool|null $add_class
	 * @param bool|null $add_src
	 *
	 * @return array
	 */
	public static function maybe_lazify( $flags, $attrs, $add_class = true, $add_src = true ) {
		if ( ! self::is_lazy( $flags ) ) {
			return $attrs;
		}

		$lazifiables = array( 'src', 'srcset', 'sizes' );
		foreach ( $lazifiables as $lazifiable ) {
			if ( isset( $attrs[ $lazifiable ] ) ) {
				$attrs["data-$lazifiable"] = $attrs[ $lazifiable ];
				unset( $attrs[ $lazifiable ] );
			}
		}

		if ( $add_class && self::should_add_lazy_class( $flags ) ) {
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
	 * attribute content
	 *
	 * @param $image
	 *
	 * @return string
	 */
	public static function get_img_alt( $image ) {
		return trim( strip_tags( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) );
	}


	/**
	 * Print an image's alt
	 * attribute content
	 *
	 * @param $image
	 */
	public static function img_alt( $image ) {
		echo self::get_img_alt( $image );
	}


	/**
	 * Get an image's src
	 * attribute for the
	 * specified size
	 *
	 * @param        $image
	 * @param string $size
	 *
	 * @return bool
	 */
	public static function get_src( $image, $size = 'full' ) {
		if ( $src = wp_get_attachment_image_src( $image, $size, false ) ) {
			return $src[0];
		}

		return false;
	}


	/**
	 * Print an image's src
	 * attribute for the
	 * specified size
	 *
	 * @param        $image
	 * @param string $size
	 */
	public static function src( $image, $size = 'full' ) {
		echo self::get_src( $image, $size );
	}


	/**
	 * Get the markup for a
	 * responsive background
	 * image
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 *
	 * @return bool|string
	 */
	public static function get_background( $image, $base_size, $sizes, $attrs = array(), $flags = array() ) {
		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$bgel_attrs = array_merge( array(
			'class' => '',
			'role'  => 'img',
			'alt'   => self::get_img_alt( $image )
		), (array) $attrs );

		$alt = $bgel_attrs['alt'];
		unset( $bgel_attrs['alt'] );

		$content = MOZ_Html::get_element( 'span', array( 'class' => 'visuallyhidden' ), $alt );

		$bgel_attrs['class'] .= ' moz-background-picture';

		if ( self::is_lazy( $flags ) ) {
			// lazy loaded background image
			if ( self::should_add_lazy_class( $flags ) ) {
				$bgel_attrs['class'] .= ' lazyload';
			}

			$bgset = array( self::get_src( $image, $base_size ) );
			foreach ( $sizes as $size => $query ) {
				$src = self::get_src( $image, $size );
				$bgset[] = "$src [$query]";
			}
			$bgel_attrs['data-sizes'] = 'auto';
			$bgel_attrs['data-bgset'] = implode( ' | ', array_reverse( $bgset ) );

		} else {
			// not lazy-loaded background image
			$unique = uniqid( 'moz-background-picture--' );
			$bgel_attrs['class'] .= " $unique";

			ob_start(); ?>

			<style>
				.<?php echo $unique; ?> {
					background-image: url('<?php self::src( $image, $base_size ); ?>');
				}

				<?php foreach ( $sizes as $size => $query ) : ?>
				@media all and <?php echo esc_html( $query ); ?> {
					.<?php echo $unique; ?> {
						background-image: url('<?php self::src( $image, $size ); ?>');
					}
				}

				<?php endforeach; ?>
			</style>

			<?php
			$content .= ob_get_clean();
		}

		return MOZ_Html::get_element( 'span', $bgel_attrs, $content );
	}


	/**
	 * Print the markup for a
	 * responsive background
	 * image
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 */
	public static function background( $image, $base_size, $sizes, $attrs = array(), $flags = array() ) {
		echo self::get_background( $image, $base_size, $sizes, $attrs, $flags );
	}


	/**
	 * Get the markup for a
	 * picture element
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 *
	 * @return bool|string
	 */
	public static function get_picture( $image, $base_size, $sizes, $attrs = array(), $flags = array() ) {
		if ( ! wp_attachment_is_image( $image ) ) {
			return false;
		}

		$content = array();

		// required for IE9 support...
		$content[] = '<!--[if IE 9]><video style="display: none;"><![endif]-->';

		foreach ( array_reverse( $sizes ) as $size => $query ) {
			$source_attrs = self::maybe_lazify( $flags, array(
				'srcset' => esc_attr( self::get_src( $image, $size ) ),
				'media'  => esc_attr( $query ),
				'type'   => esc_attr( get_post_mime_type( $image ) )
			), false, false );

			$content[] = MOZ_Html::get_sc_element( 'source', $source_attrs );
		}

		$content[] = '<!--[if IE 9]></video><![endif]-->';

		$img_attrs = self::maybe_lazify( $flags, array_merge( array(
			'srcset' => esc_attr( self::get_src( $image, $base_size ) ),
			'alt'    => self::get_img_alt( $image )
		), (array) $attrs ) );

		$content[] = MOZ_Html::get_sc_element( 'img', $img_attrs );

		return MOZ_Html::get_element( 'picture', null, implode( '', $content ) );
	}


	/**
	 * Print the markup for a
	 * picture element
	 *
	 * @param int        $image
	 * @param string     $base_size
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 */
	public static function picture( $image, $base_size, $sizes, $attrs = array(), $flags = array() ) {
		echo self::get_picture( $image, $base_size, $sizes, $attrs, $flags );
	}


	/**
	 * Get the markup for an image
	 * using srcset and sizes
	 *
	 * @param int        $image
	 * @param array      $sources
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 *
	 * @returns string
	 */
	public static function get_image( $image, $sources, $sizes, $attrs = array(), $flags = array() ) {
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

		$img_attrs = self::maybe_lazify( $flags, array_merge( array(
			'srcset' => implode( ', ', $srcset ),
			'sizes'  => implode( ', ', $sizes ),
			'alt'    => self::get_img_alt( $image )
		), (array) $attrs ) );

		return MOZ_Html::get_sc_element( 'img', $img_attrs );
	}


	/**
	 * Print the markup for an image
	 * using srcset and sizes
	 *
	 * @param int        $image
	 * @param array      $sources
	 * @param array      $sizes
	 * @param array|null $attrs
	 * @param array|null $flags
	 */
	public static function image( $image, $sources, $sizes, $attrs = array(), $flags = array() ) {
		echo self::get_image( $image, $sources, $sizes, $attrs, $flags );
	}
}