var assets = require('./common').paths.assets;

/**
 * Font Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = {
	paths: {
		watch: assets.src  + '/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		src:   assets.src  + '/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		dest:  assets.dest + '/fonts',
		clean: assets.dest + '/fonts/**/*.{eot,ttf,woff,woff2,svg}'
	}
};