var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var add          = require('gulp-add');
var filter       = require('gulp-filter');
var insert       = require('gulp-insert');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');

// config
var project      = require('../../../package.json');
var config       = require('../../config/theme');
var style        = require('../../config/templates/wordpress.style.css.js');
var bSSnippet    = require('../../config/templates/browser-sync.snippet.js');


/**
 * Move the Theme to
 * the build directory
 * add required files
 * and add browser-sync
 * snippet
 *
 * @returns {*}
 */
module.exports = function () {
	var filterFunc = filter('functions.php');

	return gulp.src(config.paths.src)
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(add({
			'.gitignore': '*',
			'style.css': style
		}))

		.pipe(filterFunc) // We only want to append the
		                  // Browser-sync snippet to the
		                  // functions.php so we need to
		                  // filter the gulp stream
		.pipe(insert.append(bSSnippet))
		.pipe(filterFunc.restore())

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('Theme Moved!'),
			onLast: true
		}));
};