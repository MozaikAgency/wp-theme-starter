# Mozaik Theme Starter - Library

The Library is a collection of potentially useful custom WordPress related classes.

_This readme is an overview of the library. The code is fully documented with
 doc-blocks so go ahead and dig into the different classes to see their methods
 and what they do!_

**Note: Avoid modifying files in the library directly, instead extend their functionality from 
within the includes directory.** This will allow you to easily pull in updates to this (vendor)
part of the mozaik-theme-starter.

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

Which is roughly equivalent to the following:

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

## SVG

The `MOZ_SVG` class has a few very simple static methods to help working with SVG in your theme.

To print an svg from within your `assets` folder (eg: `assets/svg/medal.svg`) simply use:

```php
MOZ_SVG::svg( 'medal' );
```

The `::get_icon()`/`::icon()` are helpers for printing the necessary markup when using _SVG sprites_.

```php
<a title="<?php esc_attr_e( 'Follow us on Facebook!', 'text-domain' ); ?>"
   href="http://facebook.com/example-page"
   target="_blank"
   rel="nofollow">
	<?php MOZ_SVG::icon( 'facebook' ); ?>
</a>
```

**Note:** *You will need to create your svg sprite correctly and to include
 it into your page somehow for this to work. See:*

- [Using SVG](https://css-tricks.com/using-svg/)
- [Icon System with SVG Sprites](https://css-tricks.com/svg-sprites-use-better-icon-fonts/)
- [Ajaxing for your SVG Sprite](https://css-tricks.com/ajaxing-svg-sprite/)

## Pagination

`MOZ_Pagination` supports printing custom pagination for normal as well as custom WordPress Loops:

For normal loops it can be as simple as:

```php
MOZ_Pagination::pagination();  
```

For custom loops all you need to do is pass in the `max_num_pages` query property
to the `pagination` method, as well as make sure to add the `paged` arg to your
custom query, as below:
 
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
MOZ_Menu::nav_menu( 'sitemap', array(
	'menu_class' => 'sitemap'
) );
```

## Crumbs (Breadcrumbs)

`MOZ_Crumbs` is a simple wp nav menu based breadcrumbs implementation that does not
use a nav menu walker to be printed.

Printing breadcrumbs based on a given nav menu can be as simple as:

```php
MOZ_Crumbs::crumbs( 'primary' );
```

## Utils

The `MOZ_Utils` class holds a few miscellaneous utility methods to make certain things easier.

`MOZ_Utils::get_upper( 'string' )` returns the given string in uppercase with all accents removed.
 
`MOZ_Utils::get_copyright_years( 2014 )` returns a string like '2014-2015' representing a year range
between the given year and the current year.

## Link

`MOZ_Link` contains a few methods to make it easier to work with links in WordPress.

For instance, to print a link where your `$link_data` comes from data entry and you
want to intelligently add things like `rel="nofollow"` to the link depending if it is
local or not, you would use something like:

```php
// link data could come from a custom field
// eg: $link_data = get_field( 'link' );
// it was built for leveraging Advanced Custom Fields
// and particularly the Reusable Custom Fields extension
// https://github.com/mvpdesign/acf-reusable-field-group
$link_data = array(
  'type'     => 'internal' // alt: external
  'internal' => 'http://example.com/page'
  'external' => ''
);

MOZ_Link::link( $link_data, array(
  'class' => 'button--big',
), MOZ_Utils::get_upper( ') )
```
