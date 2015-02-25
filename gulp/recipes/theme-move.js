var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var add          = require('gulp-add');
var notify       = require('gulp-notify');
var displayError = require('../utils/displayError');
var pumped       = require('../utils/pumped');


var project = require('../../package.json');


/**
 * Move the Theme to
 * the build directory
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(['theme/**/*'], { base: 'theme' })
		.pipe(plumber({ errorHandler: displayError }))
		.pipe(add('.gitignore', '*'))
		.pipe(gulp.dest('../' + project.code))
		.pipe(notify({
			message: pumped('Theme Built!'),
			onLast: true
		}));
};