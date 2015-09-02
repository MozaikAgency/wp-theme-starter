# Mozaik Theme Bootstrap - Library

The Library is a collection of potentially useful custom WordPress related classes.

An autoloader for the library is registered in `library-loader.php` that matches classes
starting with `MOZ_` and is included by default in the provided `theme_setup` function in 
the theme's `functions.php`.

All methods of the classes in the library are _static_ methods. This plus the aforementioned
autoloader mean that using a method from one of the library's classes is as easy as the following
examples:

```php
MOZ_Utils::get_upper( 'Ευχαριστώ' ); // => EΥΧΑΡΙΣΤΩ (notice no accents on uppercase)
```

Using the custom nav walker (to print a WP menu with less cruft) can also be as simple as:

```php
wp_nav_menu( array(
	'theme_location'  => 'primary',
	'container'       => 'nav',
	'container_class' => 'menu menu--primary',
	'items_wrap'      => '<ul class="menu__list">%3$s</ul>',
	'fallback_cb'     => false,
	'walker'          => new MOZ_Walker_Nav_Menu
) ); 
```

## Responsive Images

The `MOZ_RI` class offers a number of public static methods to help using responsive and even 
lazy-loaded images in your custom WordPress theme:

- `MOZ_RI::background` prints a responsive background image, given the image's attachment id
- `MOZ_RI::picture` prints a responsive image using a picture element, given the image's attachment id
- `MOZ_RI::images` prints a responsive image using srcset-sizes, given the image's attachment id

The responsive images implementation is based on the responsive images specification as it is
being implemented in browsers and is supported/polyfilled in non-supporting browsers using
'picturefill'.

Lazy-loading is supported via aFarkas' LazySizes.

The theme also comes with a polyfill for `object-fit: contain` and `object-fit: cover` which are
css properties for image-like elements to do the same thing to them as `background-size: cover`

For a full set of example implementations as well as a bit of information on browser support see:
[https://github.com/MozaikAgency/wp-theme-bootstrap/blob/tests/theme/page-respimg.php](https://github.com/MozaikAgency/wp-theme-bootstrap/blob/tests/theme/page-respimg.php)

## Pagination

`MOZ_Pagination` supports printing custom pagination for normal as well as custom WordPress Loops:

For normal loops it can be as simple as:

```php
MOZ_Pagination::pagination();  
```

For custom loops all you need to do is pass in the `max_num_pages` var:
 
```php
// custom query
$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$custom_query = new WP_Query( array(
  'post_type'      => 'football',
  'posts_per_page' => 5,
  'paged'          => $current_page
) );

// custom query loop
if ( $custom_query->have_posts() ) :
	while ( $custom_query->have_posts() ) : $custom_query->the_post();
		// print stuff ...
	endwhile;
endif;

// print pagination
MOZ_Pagination::pagination( array( 
	'total' => $custom_query->max_num_pages 
) );

// reset query/postdata (important!)
wp_reset_postdata();
```

## Breadcrumbs

`MOZ_Breadcrumbs` is a simple wp nav menu based breadcrumbs implementation that does not
use the a nav menu walker to be printed.

Printing breadcrumbs based on a given nav menu can be as simple as:

```php
MOZ_Breadcrumbs::breadcrumbs( 'primary' );
```
