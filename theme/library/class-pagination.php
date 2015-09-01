<?php
/**
 * WordPress Pagination renderer
 * to support BEM class naming
 * conventions
 *
 * @author Max G J Panas <http://maxpanas.com>
 */


/**
 * Class MOZ_Pagination
 *
 */
class MOZ_Pagination {


	/**
	 * Print pagination HTML
	 * for the currently
	 * active loop
	 *
	 * @param array|string $args
	 */
	public static function pagination( $args = '' ) {
		echo self::get_pagination( $args );
	}



	/**
	 * Returns pagination HTML
	 * for the currently
	 * active loop
	 *
	 * @param array|string $args
	 *
	 * @return string
	 */
	public static function get_pagination( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'prev_next' => false
		) );

		$pagination_items = array_filter( self::get_pagination_arr( $args ), function ( $item ) {
			return false !== $item['text'];
		});
		if ( empty( $pagination_items ) ) {
			return '';
		}

		ob_start();
		?>

			<nav class="pagination">
				<ul class="pagination__list">
					<?php foreach ( $pagination_items as $item ) : ?>

						<li class="pagination__list-item">
							<?php
								$classes = 'pagination__item';
								if ( 'page' !== $item['type'] ) {
									$classes .= " pagination__item--{$item['type']}";
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
	 * Retrieve paginated link for archive post pages.
	 *
	 * Technically, the function can be used to create paginated link list for any
	 * area. The 'base' argument is used to reference the url, which will be used to
	 * create the paginated links. The 'format' argument is then used for replacing
	 * the page number. It is however, most likely and by default, to be used on the
	 * archive post pages.
	 *
	 * The 'type' argument controls format of the returned value. The default is
	 * 'plain', which is just a string with the links separated by a newline
	 * character. The other possible values are either 'array' or 'list'. The
	 * 'array' value will return an array of the paginated link list to offer full
	 * control of display. The 'list' value will place all of the paginated links in
	 * an unordered HTML list.
	 *
	 * The 'total' argument is the total amount of pages and is an integer. The
	 * 'current' argument is the current page number and is also an integer.
	 *
	 * An example of the 'base' argument is "http://example.com/all_posts.php%_%"
	 * and the '%_%' is required. The '%_%' will be replaced by the contents of in
	 * the 'format' argument. An example for the 'format' argument is "?page=%#%"
	 * and the '%#%' is also required. The '%#%' will be replaced with the page
	 * number.
	 *
	 * You can include the previous and next links in the list by setting the
	 * 'prev_next' argument to true, which it is by default. You can set the
	 * previous text, by using the 'prev_text' argument. You can set the next text
	 * by setting the 'next_text' argument.
	 *
	 * If the 'show_all' argument is set to true, then it will show all of the pages
	 * instead of a short list of the pages near the current page. By default, the
	 * 'show_all' is set to false and controlled by the 'end_size' and 'mid_size'
	 * arguments. The 'end_size' argument is how many numbers on either the start
	 * and the end list edges, by default is 1. The 'mid_size' argument is how many
	 * numbers to either side of current page, but not including current page.
	 *
	 * It is possible to add query vars to the link by using the 'add_args' argument
	 * and see {@link add_query_arg()} for more information.
	 *
	 * The 'before_page_number' and 'after_page_number' arguments allow users to
	 * augment the links themselves. Typically this might be to add context to the
	 * numbered links so that screen reader users understand what the links are for.
	 * The text strings are added before and after the page number - within the
	 * anchor tag.
	 *
	 * @since 2.1.0
	 *
	 * @param string|array $args               {
	 *                                         Optional. Array or string of arguments for generating paginated links for archives.
	 *
	 * @type string        $base               Base of the paginated url. Default empty.
	 * @type string        $format             Format for the pagination structure. Default empty.
	 * @type int           $total              The total amount of pages. Default is the value WP_Query's
	 *                                      `max_num_pages` or 1.
	 * @type int           $current            The current page number. Default is 'paged' query var or 1.
	 * @type bool          $show_all           Whether to show all pages. Default false.
	 * @type int           $end_size           How many numbers on either the start and the end list edges.
	 *                                      Default 1.
	 * @type int           $mid_size           How many numbers to either side of the current pages. Default 2.
	 * @type bool          $prev_next          Whether to include the previous and next links in the list. Default true.
	 * @type bool          $prev_text          The previous page text. Default 'Previous'.
	 * @type bool          $next_text          The next page text. Default 'Next'.
	 * @type bool          $dots_text          The dots text. Default '&hellip'.
	 * @type array         $add_args           An array of query args to add. Default false.
	 * @type string        $add_fragment       A string to append to each link. Default empty.
	 * @type string        $before_page_number A string to appear before the page number. Default empty.
	 * @type string        $after_page_number  A string to append after the page number. Default empty.
	 * }
	 * @return array array of page links.
	 */
	public static function get_pagination_arr( $args = array() ) {
		/**
		 * @var $wp_query WP_Query
		 * @var $wp_rewrite WP_Rewrite
		 */
		global $wp_query, $wp_rewrite;

		// Setting up default values based on the current URL.
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$url_parts    = explode( '?', $pagenum_link );

		// Get max pages and current page out of the current query, if available.
		$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
		$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		// Append the format placeholder to the base URL.
		$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

		// URL base depends on permalink settings.
		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' )
			: '?paged=%#%';

		$defaults = array(
			'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
			'format'             => $format, // ?page=%#% : %#% is replaced by the page number
			'total'              => $total,
			'current'            => $current,
			'show_all'           => false,
			'prev_next'          => true,
			'prev_text'          => __( 'Previous' ),
			'next_text'          => __( 'Next' ),
			'dots_text'          => __( '&hellip;' ),
			'end_size'           => 1,
			'mid_size'           => 2,
			'add_args'           => array(), // array of query args to add
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => ''
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! is_array( $args['add_args'] ) ) {
			$args['add_args'] = array();
		}

		// Merge additional query vars found in the original URL into 'add_args' array.
		if ( isset( $url_parts[1] ) ) {
			// Find the format argument.
			$format_query = parse_url( str_replace( '%_%', $args['format'], $args['base'] ), PHP_URL_QUERY );
			wp_parse_str( $format_query, $format_arg );

			// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
			wp_parse_str( remove_query_arg( array_keys( $format_arg ), $url_parts[1] ), $query_args );
			$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $query_args ) );
		}

		// Who knows what else people pass in $args
		$total = (int) $args['total'];
		if ( $total < 2 ) {
			return array();
		}

		$current  = (int) $args['current'];
		$end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.

		if ( $end_size < 1 ) {
			$end_size = 1;
		}

		$mid_size = (int) $args['mid_size'];
		if ( $mid_size < 0 ) {
			$mid_size = 2;
		}

		$add_args   = $args['add_args'];
		$page_links = array();
		$dots       = false;

		// Maybe add Prev Page to array
		if ( $args['prev_next'] && $current && 1 < $current ) {

			$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current - 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			/**
			 * Filter the paginated links for the given archive pages.
			 *
			 * @since 3.0.0
			 *
			 * @param string $link The paginated link URL.
			 */
			$page_links[] = array(
				'type' => 'prev',
				'link' => esc_url( apply_filters( 'paginate_links', $link ) ),
				'text' => $args['prev_text']
			);
		}

		// Add page number pages to array
		for ( $n = 1; $n <= $total; $n ++ ) {

			// Add current page number to array
			if ( $n == $current ) {
				$page_links[] = array(
					'type' => 'current',
					'link' => false,
					'text' => join(
						'', array(
						$args['before_page_number'],
						number_format_i18n( $n ),
						$args['after_page_number']
					) )
				);

				$dots = true;

			} else {

				// Add other page numbers to array
				if ( $args['show_all']
				     || ( $n <= $end_size
				          || ( $current && $n >= $current - $mid_size
				               && $n <= $current + $mid_size )
				          || $n > $total - $end_size )
				) {

					$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args ) {
						$link = add_query_arg( $add_args, $link );
					}
					$link .= $args['add_fragment'];

					/** This filter is documented in wp-includes/general-template.php */
					$page_links[] = array(
						'type' => 'page',
						'link' => esc_url( apply_filters( 'paginate_links', $link ) ),
						'text' => join(
							'', array(
							$args['before_page_number'],
							number_format_i18n( $n ),
							$args['after_page_number']
						) )
					);

					$dots = true;

					// Maybe add dots to array
				} else if ( $dots && ! $args['show_all'] ) {
					$page_links[] = array(
						'type' => 'dots',
						'link' => false,
						'text' => $args['dots_text']
					);
					$dots         = false;
				}
			}
		}

		// Maybe add next page link to array
		if ( $args['prev_next'] && $current && ( $current < $total || - 1 == $total ) ) {

			$link = str_replace( '%_%', $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current + 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			/** This filter is documented in wp-includes/general-template.php */
			$page_links[] = array(
				'type' => 'next',
				'link' => esc_url( apply_filters( 'paginate_links', $link ) ),
				'text' => $args['next_text']
			);
		}

		return $page_links;
	}
}