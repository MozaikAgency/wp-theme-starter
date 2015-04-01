var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var named        = require('vinyl-named');
var gulpWebpack  = require('gulp-webpack');
var lodash       = require('lodash');
var browserSync  = require('browser-sync');
var notifier     = require('node-notifier');

// utils
var displayError = require('../../utils/displayError');
var deepMerge    = require('../../utils/deepMerge');
var pumped       = require('../../utils/pumped');

// config
var config       = require('../../config/scripts');


/**
 * Watch for changes
 * to JS assets and
 * update the JS packages
 * with webpack
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(config.paths.src)
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(named()) // vinyl-named is used to allow for
									 // multiple entry files
		.pipe(gulpWebpack(
			lodash.merge(config.options.webpack, {
				cache: true,
				watch: true,
				devtool: 'eval',
				keepalive: true
			}, deepMerge), null, function () {
				// reload browser-sync when
				// a package is updated
				browserSync.reload();

				notifier.notify({
					title:   'Webpack',
					message: pumped('JS Packaged'),
					onLast:  true
				});
   	 	})
		)

		.pipe(gulp.dest(config.paths.dest));
};