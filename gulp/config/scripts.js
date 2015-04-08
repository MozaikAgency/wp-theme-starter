var assets = require('./common').paths.assets;
var BowerWebpackPlugin = require('bower-webpack-plugin');

/**
 * Script Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = {
	paths: {
		watch: assets.src  + '/js/**/*.js',
		src:   [assets.src + '/js/*.js', '!' + assets.src + '/js/**/_*'],
		dest:  assets.dest + '/js',
		clean: assets.dest + '/js/**/*.{js,map}'
	},

	options: {
		webpack: {
			resolve: {
				extensions: ['', '.js', '.jsx']
			},
			stats: {
				colors: true
			},
			module: {
				loaders: [
					{
						test: /\.jsx?$/,
						exclude: /node_modules|bower_components/,
						loader: 'babel-loader'
					}
				],
				preLoaders: [
					{
						test: /\.jsx?$/,
						exclude: /node_modules|bower_components/,
						loader: 'jshint-loader'
					}
				]
			},
			plugins: [
				new BowerWebpackPlugin()
			],
			jshint: {
				bitwise: true,
				browser: true,
				curly: true,
				eqeqeq: true,
				forin: true,
				noarg: true,
				noempty: true,
				strict: true,
				undef: true,
				esnext: true
			}
		}
	}
};