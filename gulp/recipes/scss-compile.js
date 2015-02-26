var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify       = require('gulp-notify');
var displayError = require('../utils/displayError');
var pumped       = require('../utils/pumped');


var project = require('../../package.json');


/**
 * Compile SCSS to CSS
 *
 */
module.exports = function () {
	return gulp.src(['assets/scss/**/*.scss', '!assets/scss/**/_*'])
		.pipe(plumber({errorHandler: displayError}))
		.pipe(sass({onError: console.log}))
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
		.pipe(gulp.dest('../' + project.name + '/assets/css'))
		.pipe(notify({
			message: pumped('SCSS compiled.'),
			onLast: true
		}));
};