var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var transform    = require('vinyl-transform');
var map          = require('map-stream');
var add          = require('gulp-add');
var filter       = require('gulp-filter');
var insert       = require('gulp-insert');
var notify       = require('gulp-notify');
var displayError = require('../../utils/displayError');
var pumped       = require('../../utils/pumped');

// config
var project      = require('../../../package.json');
var config       = require('../../config/theme');
var includeDev   = require('../../config/templates/devmode.php.include');
var style        = require('../../config/templates/wordpress.style.css');
var bSSnippet    = require('../../config/templates/browser-sync.snippet');


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
	var filterPHP  = filter('**/*.php');
	var filterFunc = filter('functions.php');

	return gulp.src(config.paths.src)
		.pipe(plumber({ errorHandler: displayError }))

		.pipe(filterPHP) // Filter php files and transform
		                 // them to simply include the file
		                 // from the dev theme. This is to
		                 // make it possible to debug php from
		                 // within the dev theme
		.pipe(transform(function (filename) {
			return map(function (chunk, next) {
				var templateDef = chunk.toString().match(/Template Name:.+/);
				if (templateDef) {
					templateDef = templateDef[0];
				}
				return next(null, includeDev(filename, templateDef));
			});
		}))
		.pipe(filterPHP.restore())

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
