var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var notify       = require('gulp-notify');
var displayError = require('../utils/displayError');
var pumped       = require('../utils/pumped');


var project = require('../../package.json');


/**
 * Move and Build the
 * Theme
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(['theme/**/*'], { base: 'theme' })
		.pipe(plumber({ errorHandler: displayError }))
		.pipe(gulp.dest('../' + project.code))
		.pipe(notify({
			message: pumped('Theme Built!'),
			onLast: true
		}));
};