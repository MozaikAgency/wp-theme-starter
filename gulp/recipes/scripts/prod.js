var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var named        = require('vinyl-named');
var gulpWebpack  = require('gulp-webpack');
var lodash       = require('lodash');
var notify       = require('gulp-notify');

// utils
var displayError = require('../../utils/displayError');
var deepMerge    = require('../../utils/deepMerge');
var pumped       = require('../../utils/pumped');

// config
var config       = require('../../config/scripts');

/**
 * Create minified JS
 * packages with webpack
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(config.paths.src)
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(named()) // vinyl-named is used to allow for
									 // multiple entry files
		.pipe(gulpWebpack( lodash.merge(config.options.webpack, {
			plugins: [
				// gulp-webpack exposes the webpack library
				// it uses through the webpack property
				new gulpWebpack.webpack.optimize.DedupePlugin(),
				new gulpWebpack.webpack.optimize.OccurenceOrderPlugin(true),
				new gulpWebpack.webpack.optimize.UglifyJsPlugin({
					minimize: true
				})
			]
		}, deepMerge)))

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('JS Packaged & Minified!'),
			onLast: true
		}));
};