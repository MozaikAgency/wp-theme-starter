var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var add          = require('gulp-add');
var changed      = require('gulp-changed');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');
var style        = require('../../config/wp.style');
var project      = require('../../../package.json');


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
			'style.css': style
		}))
		.pipe(changed('../' + project.name, { hasChanged: changed.compareSha1Digest }))
		.pipe(gulp.dest('../' + project.name))
		.pipe(notify({
			message: pumped('Theme Moved!'),
			onLast: true
		}));
};