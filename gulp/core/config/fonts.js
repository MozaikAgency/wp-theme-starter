// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/fonts');
var assets = require('./common').paths.assets;

/**
 * Font Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: assets.src  + '/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		src:   assets.src  + '/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		dest:  assets.dest + '/fonts',
		clean: assets.dest + '/fonts/**/*.{eot,ttf,woff,woff2,svg}'
	}
}, overrides);