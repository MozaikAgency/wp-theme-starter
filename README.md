# The Mozaik WordPress Theme Boilerplate

The goals of the boilerplate are to:

1. be a product used and produced by the entire team (suggestions, issues and pull requests are welcome and encouraged)
1. be easy to set up / easy to use
1. guide the development  process to be consistent where it can be
1. offer a robust development and build workflow (currently powered by the cli and gulp)
1. make getting off the ground with a new project really fast

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

1. Install WordPress somewhere and clear it of default themes/plugins
1. Clone/Download this repository into a directory in your WordPress `wp-content/themes` directory
1. Change the `package.json` with your new theme's configuration
1. Change the `WP_DEBUG` const to `true` in the WordPress `wp-config.php` file <-- under consideration
1. Open the terminal and `cd wp-content/themes/<themename>` <-- bummer, but hey
1. Run `npm install` to install all dev dependencies
1. Run `gulp` to begin the dev build process with gulp watch and browsersync <-- Not implemented yet!
1. Log in to the admin and enable the *built theme*
1. Develop your theme in the `/assets` and `/theme` directories, the built theme will be generated by gulp
1. [Add a screenshot.png](http://codex.wordpress.org/Theme_Development#Screenshot)
1. Delete files you are not using inside the `/theme` directory
1. Change the `WP_DEBUG` const to `false` in the WordPress `wp-config.php` file <-- under consideration
1. Before deploying run `gulp production` <-- Not implemented yet
1. Deploy the built theme directory, *not the dev directory*