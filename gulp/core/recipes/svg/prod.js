var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var svgmin       = require('gulp-svgmin');
var notify       = require('gulp-notify');

// utils
var pumped       = require('../../utils/pumped');

// config
var config       = require('../../config/svg');


/**
 * Compress Svgs and
 * move them to the
 * built theme
 *
 */
module.exports = function () {
	return gulp.src(config.paths.src)
		.pipe(plumber())

		.pipe(svgmin(config.options.svgmin))

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('Svgs Compressed'),
			onLast: true
		}));
};