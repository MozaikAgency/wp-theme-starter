var _            = require('lodash');
var yargs        = require('yargs');
var gulp         = require('gulp');
var filter       = require('gulp-filter');
var plumber      = require('gulp-plumber');
var gulpif       = require('gulp-if');
var sourcemaps   = require('gulp-sourcemaps');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify       = require('gulp-notify');
var browserSync  = require('browser-sync');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');
var project      = require('../../../package.json');

/**
 * Compile SCSS to CSS
 *
 */
module.exports = function (cb) {
	var filterCSS = filter('**/*.css');

	return gulp.src(['assets/scss/**/*.scss', '!assets/scss/**/_*'])
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(gulpif(!yargs.argv.build, sourcemaps.init()))

		.pipe(sass({ errorToConsole: true }))
		.pipe(autoprefixer(
			'last 2 version'
			/*'safari 5',
			 'ie 7',
			 'ie 8',
			 'ie 9',
			 'opera 12.1',
			 'ios 6',
			 'android 4'*/
		))

		.pipe(gulpif(!yargs.argv.build, sourcemaps.write('./')))

		.pipe(gulp.dest('../' + project.name + '/assets/css'))

		.pipe(gulpif(!yargs.argv.build, filterCSS))
		.pipe(gulpif(!yargs.argv.build, browserSync.reload({ stream: true })))
		.pipe(gulpif(!yargs.argv.build, filterCSS.restore()))

		.pipe(notify({
			message: pumped('SCSS compiled.'),
			onLast: true
    }));
};