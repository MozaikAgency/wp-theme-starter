var _             = require('lodash');
var gulp          = require('gulp');
var plumber       = require('gulp-plumber');
var named         = require('vinyl-named');
var webpack       = require('gulp-webpack');
var notifier      = require('node-notifier');
var browserSync   = require('browser-sync');
var displayError  = require('../../utils/displayError');
var pumped        = require('../../utils/pumped');
var webpackConfig = require('../../config/webpack.config');
var project       = require('../../../package.json');


/**
 * Create JS packages
 * with webpack
 *
 * Globally configure webpack
 * through webpack.config.js
 * or locally when using the
 * function
 *
 * @param cb
 * @param options
 *
 * @returns {*}
 */
module.exports = function (cb, options) {

	_.merge(webpackConfig, options);

	return gulp.src([
		'assets/js/**/*.js',
		'!assets/js/**/_*.js'
	]).pipe(plumber({ errorHandler: displayError }))
		.pipe(named())
		.pipe(webpack(webpackConfig, null, function () {
      browserSync.reload();
      notifier.notify({
        title: 'Webpack',
        message: pumped('JS Packaged!'),
        onLast: true
      });
    }))
		.pipe(gulp.dest('../' + project.name + '/assets/js'));
};