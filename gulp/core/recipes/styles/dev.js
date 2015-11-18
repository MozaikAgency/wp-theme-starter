var gulp         = require('gulp');
var filter       = require('gulp-filter');
var plumber      = require('gulp-plumber');
var sourcemaps   = require('gulp-sourcemaps');
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify       = require('gulp-notify');
var browserSync  = require('browser-sync');

// utils
var pumped       = require('../../utils/pumped');

// config
var config       = require('../../config/styles.js');

/**
 * Compile SCSS to CSS,
 * create Sourcemaps
 * and trigger
 * Browser-sync
 *
 *
 */
module.exports = function (cb) {
	var filterCSS = filter('**/*.css', { restore: true });

	return gulp.src(config.paths.src)
		.pipe(plumber())

		.pipe(sourcemaps.init())
		.pipe(sass.sync(config.options.sass).on('error', sass.logError))
		.pipe(autoprefixer(config.options.autoprefixer))
		.pipe(sourcemaps.write('./'))

		.pipe(gulp.dest(config.paths.dest))

		.pipe(filterCSS) // sourcemaps adds `.map` files to the gulp
		                 // stream, but we only want to trigger
		                 // Browser-sync on CSS files so we need to
		                 // filter the stream for the css files
		.pipe(browserSync.reload({ stream: true }))
		.pipe(filterCSS.restore)

		.pipe(notify({
			message: pumped('SCSS Compiled.'),
			onLast: true
    }));
};