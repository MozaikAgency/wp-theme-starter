<?php
/**
 * WordPress Breadcrumb Utilities
 * to support BEM class namings
 * conventions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_Crumbs
 *
 */
class MOZ_Crumbs {


	/**
	 * Print the breadcrumbs HTML
	 * based on the given menu
	 * location
	 *
	 * @param string $theme_location
	 * @param array  $options
	 */
	public static function crumbs( $theme_location = 'primary', $options = array() ) {
		echo self::get_crumbs( $theme_location, $options );
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
	public static function get_crumbs( $theme_location = 'primary', $options = array() ) {
		$breadcrumbs_items = self::get_crumbs_array( $theme_location, $options );
		if ( ! $breadcrumbs_items || empty( $breadcrumbs_items ) ) {
			return '';
		}

		ob_start();
		?>

		<nav class="crumbs">
			<ul class="crumbs__list">
				<?php foreach ( $breadcrumbs_items as $item ) : ?>

					<li class="crumbs__list-item">
						<?php
							$classes = 'crumbs__item';
							if ( $item['current'] ) {
								$classes .= ' crumbs__item--current';
							}

							$tag   = 'span';
							$attrs = array( 'class' => $classes );
							if ( $item['link'] && '#' !== $item['link'] ) {
								$tag           = 'a';
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
	 * Get the breadcrumbs based on
	 * a menu location for the
	 * current content
	 *
	 * @param string $theme_location
	 * @param array  $options
	 *
	 * @return array
	 */
	public static function get_crumbs_array( $theme_location = 'primary', $options = array() ) {
		$clean_options = wp_parse_args( $options, array(
			'home_title'   => __( 'Home' )
		) );

		$current_item = self::get_current_crumb_item();
		$crumbs       = array( $current_item );

		if ( $current_item['id'] && ( $parents = MOZ_Menu::get_parent_menu_items( $theme_location, $current_item['id'] ) ) ) {
			$crumbs = array_merge( self::menu_items_to_crumbs( $parents ), $crumbs );
		}

		if ( ! is_front_page() ) {
			array_unshift( $crumbs, self::get_crumb_item( 'home', home_url(), $clean_options['home_title'], array(
				'type' => 'home'
			) ) );
		}

		return apply_filters( 'moz_crumbs_array', $crumbs, $theme_location, $options );
	}


	/**
	 * Transform menu items into
	 * breadcrumb items
	 *
	 * @param $menu_items
	 *
	 * @return array
	 */
	public static function menu_items_to_crumbs( $menu_items ) {
		$crumbs = array();
		foreach ( $menu_items as $i => $menu_item ) {
			$crumbs[] = self::get_crumb_item(
				$menu_item->object_id,
				$menu_item->url,
				$menu_item->title
			);
		}

		return $crumbs;
	}


	/**
	 * Get the breadcrumb item
	 * for the content being
	 * currently viewed
	 *
	 * @return array
	 */
	public static function get_current_crumb_item() {
		$item_id = $type = $url = $title = false;

		if ( is_search() ) {
			$url     = get_search_link();
			$title   = __( 'Search' );
			$type    = 'search';

		} else if ( is_author() ) {
			/* @var $user WP_User */
			$user    = get_queried_object();

			$item_id = $user->ID;
			$url     = get_author_posts_url( $user->ID );
			$title   = $user->display_name;
			$type    = 'author';

		} else if ( is_post_type_archive() ) {
			$item_id = get_post_type();
			$url     = get_post_type_archive_link( $item_id );
			$title   = post_type_archive_title( '', false );
			$type    = 'archive';

		} else if ( is_archive() ) {
			$term    = get_queried_object();

			$item_id = $term->term_id;
			$url     = get_term_link( $item_id, $term->taxonomy );
			$title   = single_term_title( '', false );
			$type    = 'taxonomy';

		} else if ( is_single() ) {
			$item_id = get_the_ID();
			$url     = get_permalink();
			$title   = get_the_title();
			$type    = 'single';

		}

		return self::get_crumb_item( $item_id, $url, $title, array(
			'current' => true,
			'type'    => $type
		) );
	}


	/**
	 * Return a single normalized
	 * breadcrumb properties array
	 *
	 * @param string $item_id
	 * @param string $link
	 * @param string $text
	 * @param array  $flags
	 *
	 * @return array
	 */
	protected static function get_crumb_item( $item_id, $link, $text, $flags = array() ) {
		$flags = wp_parse_args( $flags, array(
			'current'   => false,
			'parent'    => false,
			'type'      => false
		) );

		return array_merge( array(
			'id'   => $item_id,
			'link' => $link,
			'text' => $text,
		), $flags );
	}
}
