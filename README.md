# The Mozaik WordPress Theme Boilerplate

## Reading Recommendations

1. [WordPress Developer Documentation](http://codex.wordpress.org/Developer_Documentation)
1. We generally follow the [WordPress PHP Coding Standards](https://make.wordpress.org/core/handbook/coding-standards/php/) in our WP code.

## Important Prerequisites

1. Read [the WordPress theme development guidelines](http://codex.wordpress.org/Theme_Development)
1. Understand [the WordPress template hierarchy](http://codex.wordpress.org/images/9/96/wp-template-hierarchy.jpg)
1. Understand [the WordPress Loop](http://codex.wordpress.org/The_Loop)
1. Understand [how WordPress helps with Data Validation/Sanitization](http://codex.wordpress.org/Data_Validation)
1. Read up on the following WordPress core APIs:
	- [the Plugin API](http://codex.wordpress.org/Plugin_API)
	- [the Shortcode API](http://codex.wordpress.org/Shortcode_API)
1. Note the list of recommended plugins

## Development Guidelines

- Avoid committing the built theme to the project repository
- Avoid making changes directly to the built theme -- Always use the build process
- In production avoid uploading the theme development directory to a public server
- Avoid committing the `wp-uploads` directory to the project repository

## Standard Theme Checklist

1. Change the `package.json` with your new theme's configuration
1. [Add a screenshot.png](http://codex.wordpress.org/Theme_Development#Screenshot)
1. Delete files you are not using inside the `/theme` directory