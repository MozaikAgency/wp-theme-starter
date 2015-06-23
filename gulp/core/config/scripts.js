var path               = require('path');
var webpack            = require('gulp-webpack').webpack;
var BowerWebpackPlugin = require('bower-webpack-plugin');

// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/scripts');
var assets = require('./common').paths.assets;

/**
 * Script Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = deepMerge({
	paths: {
		watch: assets.src  + '/js/**/*.js',
		src:   [
			assets.src + '/js/*.js',
			'!' + assets.src + '/js/**/_*'
		],
		dest:  assets.dest + '/js',
		clean: assets.dest + '/js/**/*.{js,map}'
	},

	options: {
		webpack: {

			// merged with defaults
			// for :watch task
			watch: {
				cache: true,
				watch: true,
				devtool: 'eval',
				keepalive: true
			},


			// merged with defaults
			// for :dev task
			dev: {
				devtool: 'eval'
			},


			// merged with defaults
			// for :prod task
			prod: {
				plugins: [
					new webpack.optimize.DedupePlugin(),
					new webpack.optimize.OccurenceOrderPlugin(true),
					new webpack.optimize.UglifyJsPlugin({
						minimize: true
					})
				]
			},

			defaults: {
				resolve: {
					extensions: ['', '.js', '.jsx']
				},
				output: {
					chunkFilename: 'chunk-[name].js'
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
					new BowerWebpackPlugin({
						excludes: [
							/\.(le|s?c|sa)ss$/,
							/\.png$/,
							/\.jpg$/,
							/\.gif$/,
							/mCSB/,
							/fonts/
						]
					})
				],
				eslint: {
					emitError: true,
					emitWarning: true,
					configFile: path.resolve('./.eslintrc')
				}
			}

		}
	}
}, overrides);
