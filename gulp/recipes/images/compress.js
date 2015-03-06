var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var imagemin     = require('gulp-imagemin');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');
var project      = require('../../../package.json');


/**
 * Compress Images in
 * the built theme
 *
 */
module.exports = function () {
	return gulp.src(['../' + project.name + '/assets/img/**/*.{gif,ico,jpg,jpeg,png,webp}'])
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(imagemin({
			progressive: true,
			interlaced: true
		}))

		.pipe(gulp.dest('../' + project.name + '/assets/img'))
		.pipe(notify({
			message: pumped('Images Compressed'),
			onLast: true
		}));
};