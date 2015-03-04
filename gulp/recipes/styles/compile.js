var _            = require('lodash');
var gulp         = require('gulp');
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


var devmode = false;

/**
 * Compile SCSS to CSS
 *
 */
module.exports = function (cb) {
	return gulp.src(['assets/scss/**/*.scss', '!assets/scss/**/_*'])
		.pipe(plumber({ errorHandler: displayError }))
    .pipe(gulpif(devmode, sourcemaps.init()))
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
    .pipe(gulpif(devmode, sourcemaps.write()))
		.pipe(gulp.dest('../' + project.name + '/assets/css'))
    .pipe(gulpif(devmode, browserSync.reload({ stream: true })))
		.pipe(notify({
			message: pumped('SCSS compiled.'),
			onLast: true
    }));
};