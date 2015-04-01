var paths  = require('./common').paths;
var theme  = paths.theme;

/**
 * Theme Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = {
	paths: {
		watch: [theme.src + '/**/*', '!' + theme.src + '/README.md'],
		src:   [theme.src + '/**/*', '!' + theme.src + '/README.md'],
		dest:  theme.dest,
		clean: [theme.dest + '/**/*.php', '!' + paths.assets.dest]
	},

	options: {
		transform: {
			// Preserves matching strings from
			// templates during theme template
			// transformation in watch & dev mode
			preserve: new RegExp([
				"Template Name:.*"
			].join('|'), 'g')
		}
	}
};