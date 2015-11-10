// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/theme');
var paths = require('./common').paths;
var theme = paths.theme;

/**
 * Theme Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: theme.src + '/**/*.{json,php,png,jpg}',
		src:   theme.src + '/**/*.{json,php,png,jpg}',
		dest:  theme.dest,
		clean: [
			theme.dest + '/**/*.{css,json,php,png}',
			'!' + paths.assets.dest + '/**/*'
		]
	},

	options: {
		transform: {
			// Preserves matching comment strings
			// from templates during theme template
			// transformation in watch & dev mode
			preserve: new RegExp([
				"(^|\\s)Template Name:.*"
			].join('|'), 'g')
		}
	}
}, overrides);
