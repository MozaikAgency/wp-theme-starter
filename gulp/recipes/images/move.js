var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');
var project      = require('../../../package.json');


/**
 * Move Images to
 * the built theme
 *
 */
module.exports = function () {
	return gulp.src(['assets/img/**/*.{gif,ico,jpg,jpeg,png,webp}', '!assets/img/sprites'])
		.pipe(plumber({errorHandler: displayError}))
		.pipe(gulp.dest('../' + project.name + '/assets/img'))
		.pipe(notify({
			message: pumped('Images Moved'),
			onLast: true
		}));
};