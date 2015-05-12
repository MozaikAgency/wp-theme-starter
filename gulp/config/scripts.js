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
				preLoaders: [
					{
						test: /\.jsx?$/,
						exclude: [
							/node_modules/,
							/bower_components/,
							/vendor/,
							/polyfills/
						],
						loader: 'eslint-loader'
					}
				],
				loaders: [
					{
						test: /\.jsx?$/,
						exclude: [
							/node_modules/,
							/bower_components/,
							/vendor/,
							/polyfills/
						],
						loader: 'babel-loader'
					}
				]
			},
			plugins: [
				new BowerWebpackPlugin()
			],
			esling: {
				emitError: true,
				emitWarning: true,
				configFile: '../../.eslintrc'
			}
		}
	}
};