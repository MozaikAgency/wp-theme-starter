# The Mozaik WordPress Theme Boilerplate

This is a WordPress theme starter-kit meant to offer a first-class developer experience.

## Contents

- [Full Feature List](#full-feature-list)
- [Important Prerequisites](#important-prerequisites)
	- [Dev Environment](#dev-environment)
	- [WordPress](#wordpress)
	- [JavaScript](#javascript)
	- [CSS](#css)
- [Development Guidelines](#development-guidelines)
- [Standard Theme Development Process](#standard-theme-development-process)
	- [Setup](#setup)
	- [Development](#development)
	- [Production](#production)
- [Reading Recommendations](#reading-recommendations)
- [License](#license)
- [FAQ](#faq)
	- [1. How do I use jQuery with wp-theme-starter ?](#1-how-do-i-use-jquery-with-wp-theme-starter-)

## Full Feature List

- [x] Separate development theme and auto-generated clutter-free production (built) theme
- [x] Easy enough to port already existing themes over to it
- [x] gulp build process
	- [x] Dev Mode
		- [x] Auto browser refresh/injection on save (even for php files!) powered by BrowserSync
		- [x] JavaScript module bundling, chunking and sourcemaps powered by Webpack
		- [x] JavaScript ES6+ support via Babel
		- [x] JavaScript linting via eslint
		- [x] SCSS/SASS compilation and sourcemaps powered by libsass
		- [ ] SCSS linting via scss-lint (waiting for first stable release of scss-lint)
		- [x] CSS prefixing via autoprefixer
		- [x] SVG sprite generation via svg-sprite
	- [x] Production Mode
		- [x] Minified CSS via cssmin
		- [x] Uglify, dedupe JS via Webpack
		- [x] Theme image optimization via imagemin
		- [x] SVG optimization via svgmin
	- [x] Build process easily extendable
- [x] NPM and Bower workflows supported
- [x] Theme Helpers Library (For more details check out the [library's README](https://github.com/MozaikAgency/wp-theme-starter/tree/master/theme/library))
	- [x] Responsive images specification implementation
		- [x] Helper function to print WordPress media by attachment id using responsive background images,
		      the picture element or img-srcset-sizes
		- [x] Responsive images polyfill via picturefill
		- [x] Builtin lazyload helper supported by aFarkas/lazysizes
	- [x] BEM Style simplified customizable/extendable nav-menu-walker
	- [x] BEM Style simplified customizable/extendable pagination renderer that easily supports custom queries
	- [x] BEM Style simplified customizable/extendable breadcrumbs renderer that is based on a given menu
	- [x] Utility classes to make it easier working with SVGs and SVG Sprites
- [x] Battle tested. Used in a multitude of small and large scale projects!

## Important Prerequisites

### Dev Environment

1. Have [node and npm](https://nodejs.org/) installed on your system *(node@5.0.0)*
1. Have [gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) globally installed *(gulp@^3.9.0)*

- *You can use [`nvm`](https://github.com/creationix/nvm) to manage the node versions installed on your computer*
- *You can use [`npm-check-updates`](https://www.npmjs.com/package/npm-check-updates) to update the node modules in your theme (Note that updating may break things, so be careful)* 

#### Windows

On Windows you may need to do some of the following if you run into trouble when running `npm install` in this project:

- Install Python - Install version 2.7 of Python and add it to your path or/and create a PYTHONPATH environment variable.
- Install Visual Studio (Express Edition is fine) - We will need this for some of modules that are compiled when installing Theme Starter. [Download VS Express](https://www.visualstudio.com/en-us/products/visual-studio-express-vs.aspx), get one of the versions that has C++ - Express 2013 for Windows Desktop for example.
- Set Visual Studio Version Flags - We need to tell node-gyp (something that is used for compiling addons) what version of Visual Studio we want to compile with. You can do this either through an environment variable GYP_MSVS_VERSION. If you are using Express, you have to say GYP_MSVS_VERSION=2013e.

Thanks to [Ryanlanciaux](http://ryanlanciaux.github.io/blog/2014/08/02/using-jest-for-testing-react-components-on-windows/)

### WordPress

1. Read [the WordPress theme development guidelines](http://codex.wordpress.org/Theme_Development)
1. Understand [the WordPress template hierarchy](http://codex.wordpress.org/images/9/96/wp-template-hierarchy.jpg)
1. Understand [the WordPress Loop](http://codex.wordpress.org/The_Loop)
1. Understand [how WordPress helps with Data Validation/Sanitization](http://codex.wordpress.org/Data_Validation)
1. Read up on the following WordPress core APIs:
	- [the Plugin API](http://codex.wordpress.org/Plugin_API)
	- [the Shortcode API](http://codex.wordpress.org/Shortcode_API)
1. Understand when you should use a Custom Functionality Plugin instead of implementing functionality within a theme
 	- [Creating a custom functions plugin for end users](http://justintadlock.com/archives/2011/02/02/creating-a-custom-functions-plugin-for-end-users)
 	- [How to Create a Custom Functionality Plugin (And Why You Need One)](https://www.nutsandboltsmedia.com/how-to-create-a-custom-functionality-plugin-and-why-you-need-one/)
	
### JavaScript

1. This project uses [webpack](http://webpack.github.io/) to provide support for modular JS, read up on the functionality & tools it provides

### CSS

1. The boilerplate assumes you are using SCSS to write your styles and compiles to CSS using [Libsass](http://libsass.org/)
1. [Autoprefixer](https://github.com/postcss/autoprefixer) is used for adding the correct vendor prefixes to the final generated CSS

## Development Guidelines

- Avoid committing the built theme to the project repository
- Avoid committing the `wp-uploads` directory to the project repository
- Avoid making changes directly to the built theme -- Always use the build process
- In production avoid uploading the theme development directory to a public server
- It is good practice to enable `WP_DEBUG` in your `wp-config.php` file, *but only* during development

## Standard Theme Development Process

### Setup

1. Install WordPress and clear it of unnecessary default themes & plugins
1. Clone/Download the contents of this repository into a directory in your WordPress `wp-content/themes` directory (eg: "my-theme_dev") _this will be your "dev theme"_
1. Open the terminal and navigate to the dev theme, *eg:* `cd wp-content/themes/<my-theme>_dev`
1. (**Note:** The next steps **require** nodejs *@5.0.0* and gulpjs *@^3.9.0*)
1. Run `npm install` to install all dev dependencies
1. Change the `project.config.js` file with your new theme's configuration
1. Run `gulp build` to generate the "built theme" for the first time
1. Log in to the admin and enable the *built theme*
	 (**Note:** The *dev theme* is not a valid theme, that's fine! Don't delete it or try to enable it!)
1. Start Developing!

### Development

1. Run `gulp` to begin the dev build process that uses libsass, browser-sync and webpack
1. Develop your theme in the `/assets` and `/theme` directories, *the "built theme" will be generated by gulp*
1. Optional stuff:
	- use `npm install --save <module(s)>` or `bower install --save <module(s)>` to easily manage js dependencies, then use `var <module> = require('<module>');`
	  or `import <module> from '<module>';` anywhere in your js files you want to use them
	- explore the [`/library` directory](https://github.com/MozaikAgency/wp-theme-starter/tree/master/theme/library) in the dev theme for anything useful to your project.

### Production

1. Delete files you are not using from inside the `/theme` directory
1. [Add a screenshot.png](http://codex.wordpress.org/Theme_Development#Screenshot)
1. Before deploying run `gulp build` to generate a production ready version of the built theme
1. Deploy the built theme directory, *not the dev directory*

## Reading Recommendations

1. [WordPress Developer Documentation](http://codex.wordpress.org/Developer_Documentation)
1. We generally follow the [WordPress PHP Coding Standards](https://make.wordpress.org/core/handbook/coding-standards/php/) in our WP code
1. The build process supports [<abbr title="EcmaScript 2015+">ES6+</abbr> JavaScript syntax](https://babeljs.io/docs/learn-es6/) by using [babel.js](https://babeljs.io/) to transpile ES6+
   to ES5.
   
## License

This Theme Boilerplate is licensed under the [MIT license](http://opensource.org/licenses/MIT) see `license.txt`.

## FAQ

### 1. How do I use jQuery with wp-theme-starter ?

As mentioned above, wp-theme-starter uses [webpack](http://webpack.github.io/) to
handle concatenating, minifying and optimizing the javascript in the theme. Webpack,
like Browserify and RequireJS, is a module loader for javascript and as such requires
each module (file) to declare the dependencies it has within it. To use jQuery, or
any other global library, in your webpack-ed js you have a couple of choices:

- Use jQuery as an internal dependency of your bundle<br>_(this means jQuery will be included in the final JS bundle created)_
	1. With the terminal open _within the dev theme_, type `npm install jquery --save` or `bower install jquery --save` to install jquery for the project
	1. In the `./gulp/config/scripts.js` file add this line to the top of the file to expose webpack within this file:
	
			var webpack = require('webpack');
	    
	1. Then within the file declare that any instance of `$`,`jQuery` or `window.jQuery` within the project refers
	   to the jQuery package we downloaded earlier. We can achieve this by adding the following to the config object:
	   (it is worth checking out the `./gulp/core/config/scripts.js` file for the general structure of the config object)

			...
			options: {
				webpack: {
					defaults: {
						plugins: [
							new webpack.ProvidePlugin({
								'$': 'jquery',
								'jQuery': 'jquery',
								'window.jQuery': 'jquery'
							})
						]
					}
				}
			}
			...

- Use jQuery as an external package<br>_(this means jQuery will be requested as a separate resource from the rest of your bundle. Use this when you are working with WordPress plugins that include jquery dependant scripts on the front-end)_
	1. Declare jQuery as an external dependency of your `main.js` in the `theme_scripts` function in your `functions.php` file.
	   Something like this:
	   
			wp_enqueue_script( 'main', "$theme_dir/assets/js/main.js", array( 'jquery' ), null, true );

	1. In the `./gulp/config/scripts.js` file add this line to the top of the file to expose webpack within this file:
	
			var webpack = require('webpack');
			
	1. Declare jQuery as an external dependency in webpack. Add the following to `./gulp/config/scripts.js` in the webpack section of
		 the config:

			...
			options: {
				webpack: {
					defaults: {
						plugins: [
							new webpack.ProvidePlugin({
								'$': 'jquery'
							})
						],
						externals: {
							jquery: 'window.jQuery'
						}
					}
				}
			}
			...
