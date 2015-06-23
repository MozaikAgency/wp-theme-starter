// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/images');
var assets = require('./common').paths.assets;

/**
 * Image Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: [
			assets.src + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
			'!' + assets.src + '/img/sprites'
		],
		src:   [
			assets.src + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
			'!' + assets.src + '/img/sprites'
		],
		dest:  assets.dest + '/img',
		clean: assets.dest + '/img/**/*.{gif,ico,jpg,jpeg,png,webp}'
	}
}, overrides);