// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/svg');
var assets = require('./common').paths.assets;

/**
 * Svg Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: [
			assets.src + '/svg/**/*.svg',
			'!' + assets.src + '/svg/sprite'
		],
		src: [
			assets.src + '/svg/**/*.svg',
			'!' + assets.src + '/svg/sprite'
		],
		dest: assets.dest + '/svg',
		clean: [
			assets.dest + '/svg/**/*.svg',
			'!' + assets.dest + '/svg/sprite-*.svg'
		]
	},

	options: {
		svgmin: {
			multipass: true,
			plugins: [{cleanupIDs: false}]
		}
	}

}, overrides);