var assets = require('./common').paths.assets;

/**
 * Style Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = {
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
				'ie >= 8'
			]
		},
		minify: {
			advanced: true,
			aggressiveMerging: true,
			keepBreaks: false,
			keepSpecialComments: 0,
			compatibility: 'ie8',
			mediaMerging: true,
			restructuring: true,
			rebase: true,
			roundingPrecision: 2,
			shorthandCompacting: true
		}
	}
};