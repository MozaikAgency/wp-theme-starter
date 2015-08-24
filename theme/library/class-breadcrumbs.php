<?php
/**
 * WordPress Responsive Images
 * Implementation
 *
 * @author Max G J Panas <http://maxpanas.com>
 */



/**
 * Class MOZ_Breadcrumbs
 *
 */
class MOZ_Breadcrumbs {


	/**
	 * Print the breadcrumbs based on
	 * the given menu location
	 *
	 * @param string $theme_location
	 * @param array  $options
	 */
	static function render( $theme_location = 'primary', $options = array() ) {
		$crumbs = self::get_as_array( $theme_location, $options );
		if ( ! $crumbs || empty( $crumbs ) ) {
			return;
		}

		?>

		<nav class="breadcrumb">
			<ul class="breadcrumb__list">
				<?php foreach ( $crumbs as $crumb ) : ?>
					<li class="breadcrumb__item">
						<?php
						$classes = 'breadcrumb__link';
						if ( $crumb['current'] ) {
							$classes .= ' breadcrumb__link--current';
						}

						$tag   = 'span';
						$attrs = array( 'class' => $classes );
						if ( $crumb['url'] && '#' !== $crumb['url'] ) {
							$tag           = 'a';
							$attrs['href'] = $crumb['url'];
						}

						MOZ_Html::element( $tag, $attrs, $crumb['title'] );
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<?php
	}


	/**
	 * Return the breadcrumbs array
	 *
	 * @param string $theme_location
	 * @param array  $options
	 *
	 * @return array|bool
	 */
	static function get_as_array( $theme_location = 'primary', $options = array() ) {
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
				$crumbs[] = array(
					'url'       => $item->url,
					'title'     => $item->title,
					'current'   => $item->current,
					'parent'    => $item->current_item_parent,
					'ancestor'  => $item->current_item_ancestor,
					'home_link' => false
				);

				if ( $item->current ) {
					$current_exists = true;
				}
			}
		}

		if ( empty( $crumbs ) ) {
			return array();
		}

		if ( ! $current_exists ) {
			array_push( $crumbs, array(
				'url'       => get_permalink(),
				'title'     => get_the_title(),
				'current'   => true,
				'parent'    => false,
				'ancestor'  => false,
				'home_link' => false
			) );
		}

		if ( ! is_front_page() ) {
			array_unshift( $crumbs, array(
				'url'       => home_url(),
				'title'     => $options['home_title'],
				'current'   => false,
				'parent'    => false,
				'ancestor'  => false,
				'home_link' => true
			) );
		}

		return $crumbs;
	}
}
