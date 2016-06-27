// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/styles');
var assets = require('./common').paths.assets;

/**
 * Style Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: [
			assets.src + '/scss/**/*.scss',
			'!' + assets.src + '/scss/**/*_tmp\\d+.scss'
		],
		src:   [
			assets.src + '/scss/*.scss',
			'!' + assets.src + '/scss/**/_*'
		],
		dest:  assets.dest + '/css',
		clean: assets.dest + '/css/**/*.{css,map}'
	},

	options: {
		sass: {},
		autoprefixer: {
			browsers: [
				'last 2 version',
				'ie >= 9',
				'IOS >= 7'
			]
		},
		minify: {
			autoprefixer: false,
			discardComments: { removeAll: true }
		}
	}
}, overrides);
