var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var add          = require('gulp-add');
var notify       = require('gulp-notify');
var displayError = require('../utils/displayError');
var pumped       = require('../utils/pumped');

var wpStyles = require('../config/wpStyles');
var project  = require('../../package.json');


/**
 * Move the Theme to
 * the build directory
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(['theme/**/*', '!theme/README.md'], { base: 'theme' })
		.pipe(plumber({ errorHandler: displayError }))
		.pipe(add({
			'.gitignore': '*',
			'styles.css': wpStyles
		}))
		.pipe(gulp.dest('../' + project.name))
		.pipe(notify({
			message: pumped('Theme Built!'),
			onLast: true
		}));
};