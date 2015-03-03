var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var minify       = require('gulp-minify-css');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');
var project      = require('../../../package.json');


/**
 * Minify CSS
 *
 */
module.exports = function () {
	return gulp.src(['../' + project.name + '/assets/css/**/*.css'])
		.pipe(plumber({ errorHandler: displayError }))
		.pipe(minify())
		.pipe(gulp.dest('../' + project.name + '/assets/css'))
		.pipe(notify({
			message: pumped('CSS Minified.'),
			onLast: true
		}));
};