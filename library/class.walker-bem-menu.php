<?php
/**
 * Walker Nav Menu extension
 * to support BEM class naming
 * conventions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


// make sure this file is called by wp
defined( 'ABSPATH' ) or die();



/**
 * Class MOZ_Walker_BEM_Menu
 *
 * Prints the Html for the multi tier navigation
 * menus
 *
 * @since 1.0
 *
 * @uses  Walker_Nav_Menu
 */
class MOZ_Walker_BEM_Menu extends Walker_Nav_Menu {


	/**
	 * Starts the list before the elements are added.
	 *
	 * @see   Walker_Nav_Menu::start_lvl()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$output .= "$indent<ul class=\"menu__list menu__list--submenu menu__list--level-{$depth}\">\n";
	}



	/**
	 * Start the element output.
	 *
	 * @see   Walker_Nav_Menu::start_el()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$item_classes = 'menu__item';

		// add classes to current/parent/ancestor items
		if ( isset( $item->current ) && $item->current ) {
			$item_classes .= ' menu__item--current';
		}
		if ( isset( $item->current_item_ancestor ) && $item->current_item_ancestor ) {
			$item_classes .= ' menu__item--ancestor';
		}
		if ( isset( $item->current_item_parent ) && $item->current_item_parent ) {
			$item_classes .= ' menu__item--parent';
		}
		if ( isset( $item->has_children ) && $item->has_children ) {
			$item_classes .= ' menu__item--has-children';
		}
		if ( isset( $item->classes[0] ) && ! empty( $item->classes[0] ) ) {
			// the first item in the 'classes' array is the user-set class
			// the rest of the classes are superfluous
			$item_classes .= " {$item->classes[0]}";
		}

		$output .= "$indent<li class=\"{$item_classes}\">";

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ( ! empty( $item->url ) && '#' !== $item->url ) ? $item->url : '';
		$atts['class']  = 'menu__link';

		$tag = empty( $atts['href'] ) ? 'span' : 'a';

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= "<{$tag}{$attributes}>";
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= "</{$tag}>";
		$item_output .= $args->after;

		$output .= $item_output;
	}



	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see   Walker_Nav_Menu::end_lvl()
	 *
	 * @since 1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );

		$output .= "$indent</ul>\n"; // end of .menu__list
	}



	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth. It is possible to set the
	 * max depth to include all depths, see walk() method.
	 *
	 * This method should not be called directly, use the walk() method instead.
	 *
	 * @uses  Walker_Nav_Menu::display_element()
	 * @see   Walker_Nav_Menu::display_element()
	 *
	 * @since 1.0
	 *
	 * @param object $element           Data object.
	 * @param array  $children_elements List of elements to continue traversing.
	 * @param int    $max_depth         Max depth to traverse.
	 * @param int    $depth             Depth of current element.
	 * @param array  $args              An array of arguments.
	 * @param string $output            Passed by reference. Used to append additional content.
	 *
	 * @return null Null on failure with no changes to parameters.
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( isset( $children_elements[$element->ID] ) && ! empty( $children_elements[$element->ID] ) ) {
			$element->has_children = true;
			$element->current_item_ancestor = self::array_any( $children_elements[$element->ID], array( &$this, 'is_ancestor_of'	)	);
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}



	/**
	 * Return whether a particular child
	 * is a active ancestor
	 *
	 * @param $child
	 *
	 * @return bool
	 */
	function is_ancestor_of( $child ) {
		return $child->current || $child->current_item_parent || $child->current_item_ancestor;
	}



	/**
	 * Array Any implementation
	 * return true if callback
	 * returns true for any element
	 * of the array
	 *
	 * @param array $array
	 * @param bool  $callable
	 *
	 * @return bool
	 */
	function array_any( array $array, $callable = false ) {
		$callable = $callable ? : function ( $value ) { return ! ! $value; };
		foreach ( $array as $value ) {
			if ( call_user_func( $callable, $value ) ) {
				return true;
			}
		}

		return false;
	}
}