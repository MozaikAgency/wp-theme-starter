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
