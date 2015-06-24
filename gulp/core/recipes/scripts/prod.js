var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var named        = require('vinyl-named');
var gulpWebpack  = require('webpack-stream');
var notify       = require('gulp-notify');

// utils
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
		.pipe(plumber())

		.pipe(named()) // vinyl-named is used to allow for
									 // multiple entry files
		.pipe(gulpWebpack(
			deepMerge(
				config.options.webpack.defaults,
				config.options.webpack.prod
			)
		))

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('JS Packaged & Minified!'),
			onLast: true
		}));
};