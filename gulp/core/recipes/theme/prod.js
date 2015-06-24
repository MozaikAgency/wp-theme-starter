var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var add          = require('gulp-add');
var notify       = require('gulp-notify');

// utils
var pumped       = require('../../utils/pumped');

// config
var project      = require('../../../../project.config');
var config       = require('../../config/theme');

// templates
var style        = require('../../templates/wordpress-style-css.js');


/**
 * Move the Theme to
 * the build directory
 * and add required files
 *
 * @returns {*}
 */
module.exports = function () {
	return gulp.src(config.paths.src)
		.pipe(plumber())

		.pipe(add({
			'.gitignore': '*',
			'style.css': style
		}))

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('Theme Moved!'),
			onLast: true
		}));
};