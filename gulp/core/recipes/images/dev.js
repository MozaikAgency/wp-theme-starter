var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var notify       = require('gulp-notify');
var browserSync  = require('browser-sync');

// utils
var pumped       = require('../../utils/pumped');

// config
var config       = require('../../config/images');


/**
 * Move Images to
 * the built theme
 *
 */
module.exports = function () {
	return gulp.src(config.paths.src)
		.pipe(plumber())

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('Images Moved'),
			onLast: true
		}))

		.on('end', browserSync.reload);
};