var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var transform    = require('vinyl-transform');
var path         = require('path');
var map          = require('map-stream');
var add          = require('gulp-add');
var filter       = require('gulp-filter');
var insert       = require('gulp-insert');
var notify       = require('gulp-notify');
var browserSync  = require('browser-sync');


// utils
var pumped       = require('../../utils/pumped');

// config
var project      = require('../../../../project.config');
var config       = require('../../config/theme');

// templates
var includeDev   = require('../../templates/devmode-php-include');
var style        = require('../../templates/wordpress-style-css');
var bSSnippet    = require('../../templates/browser-sync-snippet');

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
	var filterPHP  = filter('**/*.php', { restore: true });
	var filterFunc = filter('functions.php', { restore: true });

	return gulp.src(config.paths.src)
		.pipe(plumber())

		.pipe(filterPHP) // Filter php files and transform
		                 // them to simply include the file
		                 // from the dev theme. This is to
		                 // make it possible to debug php from
		                 // within the dev theme
		.pipe(transform(function (filename) {
			return map(function (chunk, next) {

				var definitions = [];
				if (config.options.transform.preserve) {
					definitions = chunk.toString().match(config.options.transform.preserve);
				}

				var relativeFilename = path.relative(config.paths.dest, filename);
				return next(null, includeDev(relativeFilename, definitions));
			});
		}))
		.pipe(filterPHP.restore)

		.pipe(add({
			'.gitignore': '*',
			'style.css': style
		}))

		.pipe(filterFunc) // We only want to append the
		                  // Browser-sync snippet to the
		                  // functions.php so we need to
		                  // filter the gulp stream
		.pipe(insert.append(bSSnippet))
		.pipe(filterFunc.restore)

		.pipe(gulp.dest(config.paths.dest))
		.pipe(notify({
			message: pumped('Theme Moved!'),
			onLast: true
		}))

		.on('end', browserSync.reload);
};
