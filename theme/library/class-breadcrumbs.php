<?php
/**
 * WordPress Breadcrumbs renderer
 * to support BEM class namings
 * conventions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */



/**
 * Class MOZ_Breadcrumbs
 *
 */
class MOZ_Breadcrumbs {


	/**
	 * Print the breadcrumbs HTML
	 * based on the given menu
	 * location
	 *
	 * @param string $theme_location
	 * @param array  $options
	 */
	public static function breadcrumbs( $theme_location = 'primary', $options = array() ) {
		echo self::get_breadcrumbs( $theme_location, $options );
	}


	/**
	 * Return the breadcrumbs HTML
	 * based on the given menu
	 * location
	 *
	 * @param string $theme_location
	 * @param array  $options
	 *
	 * @return string
	 */
	public static function get_breadcrumbs( $theme_location = 'primary', $options = array() ) {
		$breadcrumbs_items = self::get_breadcrumbs_arr( $theme_location, $options );
		if ( ! $breadcrumbs_items || empty( $breadcrumbs_items ) ) {
			return '';
		}

		ob_start();
		?>

			<nav class="breadcrumbs">
				<ul class="breadcrumbs__list">
					<?php foreach ( $breadcrumbs_items as $item ) : ?>

						<li class="breadcrumbs__list-item">
							<?php
								$classes = 'breadcrumbs__item';
								if ( $item['current'] ) {
									$classes .= ' breadcrumbs__item--current';
								}

								$tag = 'span';
								$attrs = array( 'class' => $classes );
								if ( false !== $item['link'] && '#' !== $item['link'] ) {
									$tag = 'a';
									$attrs['href'] = $item['link'];
								}

								MOZ_Html::element( $tag, $attrs, $item['text'] );
							?>
						</li>

					<?php endforeach; ?>
				</ul>
			</nav>

		<?php
		return ob_get_clean();
	}



	/**
	 * Return a single normalized
	 * breadcrumb properties array
	 *
	 * @param string $link
	 * @param string $text
	 * @param array  $flags
	 *
	 * @return array
	 */
	protected static function get_breadcrumb_arr( $link, $text, $flags = array() ) {
		$flags = wp_parse_args( $flags, array(
			'current'   => false,
			'parent'    => false,
			'ancestor'  => false,
			'home_link' => false
		) );

		return array_merge( array(
			'link' => $link,
			'text' => $text,
		), $flags );
	}



	/**
	 * Return the breadcrumbs array
	 * based on a given menu
	 *
	 * @param string $theme_location
	 * @param array  $options
	 *
	 * @return array|bool
	 */
	public static function get_breadcrumbs_arr( $theme_location = 'primary', $options = array() ) {
		$locations = get_nav_menu_locations();

		if ( ! isset( $locations[ $theme_location ] ) ) {
			return false;
		}

		$options = wp_parse_args( $options, array(
			'home_title' => __( 'Home' )
		) );

		$menu  = wp_get_nav_menu_object( $locations[ $theme_location ] );
		$items = wp_get_nav_menu_items( $menu->term_id );

		if ( empty( $items ) ) {
			return array();
		}

		// Set up the class variables, including current-classes
		_wp_menu_item_classes_by_context( $items );

		$crumbs  = array();
		$current_exists = false;
		foreach ( $items as $item ) {
			if ( $item->current_item_parent || $item->current_item_ancestor || $item->current ) {
				$crumbs[] = self::get_breadcrumb_arr( $item->url, $item->title, array(
					'current'  => $item->current,
					'parent'   => $item->current_item_parent,
					'ancestor' => $item->current_item_ancestor
				) );

				if ( $item->current ) {
					$current_exists = true;
				}
			}
		}

		if ( empty( $crumbs ) ) {
			return array();
		}

		if ( ! $current_exists ) {
			array_push( $crumbs, self::get_breadcrumb_arr( get_permalink(), get_the_title(), array(
				'current' => true
			) ) );
		}

		if ( ! is_front_page() ) {
			array_unshift( $crumbs, self::get_breadcrumb_arr( home_url(), $options['home_title'], array(
				'home_link' => true
			) ) );
		}

		return $crumbs;
	}
}
