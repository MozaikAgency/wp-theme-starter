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
		watch: assets.src  + '/scss/**/*.scss',
		src:   [assets.src + '/scss/**/*.scss', '!' + assets.src + '/scss/**/_*'],
		dest:  assets.dest + '/css',
		clean: assets.dest + '/css/**/*.{css,map}'
	},

	options: {
		sass: {
			errLogToConsole: true
		},
		autoprefixer: {
			browsers: [
				'last 2 version',
				'safari >= 5',
				'ie >= 7',
				'opera >= 12.1',
				'ios >= 6',
				'android >= 4'
			]
		}
	}
};