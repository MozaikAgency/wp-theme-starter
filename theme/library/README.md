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
MOZ_Menu::nav_menu( 'primary' );
```

Which is equivalent to the following:

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

The `MOZ_Image` class offers a number of public static methods to help using responsive and even 
lazy-loaded images in your custom WordPress theme:

Given the image's attachment id,

- `MOZ_Image::background` prints a responsive background image
- `MOZ_Image::picture` prints a responsive image using a picture element
- `MOZ_Image::image` prints a responsive image using srcset-sizes

The responsive images implementation is based on the responsive images specification as it is
being implemented in browsers and is supported/polyfilled in non-supporting browsers using
'picturefill'.

Lazy-loading is supported via aFarkas' LazySizes.

The theme also comes with a polyfill for `object-fit: contain` and `object-fit: cover` which are
css properties for image-like elements to do the same thing to them as `background-size: cover`

For a full set of example implementations as well as a bit of information on browser support see:
[https://github.com/MozaikAgency/wp-theme-starter/blob/tests/theme/page-respimg.php](https://github.com/MozaikAgency/wp-theme-starter/blob/tests/theme/page-respimg.php)

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
$football_query = new WP_Query( array(
  'post_type'      => 'football',
  'posts_per_page' => 5,
  'paged'          => $current_page
) );

// custom query loop
if ( $football_query->have_posts() ) :

	while ( $football_query->have_posts() ) : $football_query->the_post();
		// print football stuff ...
	endwhile;

	// print pagination
	MOZ_Pagination::pagination( array( 
		'total' => $football_query->max_num_pages 
	) );

else :

	_e( 'Sorry, no footballs here!', 'custom-text-domain' );

endif;

// reset postdata (important!)
wp_reset_postdata();
```

## Menu

`MOZ_Menu` contains a simple helper to make using the BEM custom nav walker a little
easier. As mentioned above, just do the following to print a custom nav menu:

```php
MOZ_Menu::nav_menu( 'primary' );
```

You can also use the menu walker to print a sitemap based on a WP nav menu:

```php
MOZ_Menu::nav_menu( 'sitmap', array(
	'menu_class' => 'sitemap'
) );
```

`MOZ_Menu` also contains a simple wp nav menu based breadcrumbs implementation that does not
use a nav menu walker to be printed.

Printing breadcrumbs based on a given nav menu can be as simple as:

```php
MOZ_Menu::breadcrumbs( 'primary' );
```

## Link

`MOZ_Link` contains a few methods to make it easier to work with links in WordPress.
