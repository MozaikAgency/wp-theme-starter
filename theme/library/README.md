# Mozaik Theme Bootstrap - Library

The Library is a collection of potentially useful custom WordPress related classes
and functions.

# Responsive Images

The WordPress responsive images implementation offered here is based on
the proposed Responsive Images Standard as outlined here:
 
- [http://scottjehl.github.io/picturefill/](http://scottjehl.github.io/picturefill/)

For compatibility with older browsers (IE9+) you will need to add the following snippet
in the head of your theme, right before the **closing** `</head>` tag.

	<script async defer src="//cdnjs.cloudflare.com/ajax/libs/picturefill/2.3.1/picturefill.min.js"></script>

For compatibility with even older browsers (IE7+) you will need to add the following snippet
in the head of your theme, *right after the **opening** `<head>` tag.* 
(Or use [Modernizr](http://modernizr.com/) which includes the shim)

	<!--[if lt IE 9]>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->

Demo of responsive images use in theme, for an example image with id 10:

	<div style="height: 300px;position: relative;">
		<?php
		  // using a background image
			MOZ_RI::background( 10, 'thumbnail', array(
				'medium' => '(min-width: 500px)',
				'large'  => '(min-width: 1000px)',
				'full'   => '(min-width: 1200px)'
			), array(
				'alt' => __( 'A picture of penguins', 'moz' )
			) );
		?>
	</div>
	
	<?php
	  // using the picture element
		MOZ_RI::picture( 10, 'thumbnail', array(
			'medium' => '(min-width: 500px)',
			'large'  => '(min-width: 1000px)',
			'full'   => '(min-width: 1200px)'
		), array(
			'alt' => __( 'A picture of penguins', 'moz' )
		) );
	
	  // using an image with srcset/sizes
		MOZ_RI::image( 10, array(
			'thumbnail',
			'medium',
			'large',
			'full'
		), array(
			'(min-width: 1024px) 1024px',
			'100vw'
		), array(
			'alt' => __( 'A picture of penguins', 'moz' )
		) );
	?>
