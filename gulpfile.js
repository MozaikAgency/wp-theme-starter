/* eslint
		no-var: 0,
	  no-multi-spaces: 0,
	  no-mixed-spaces-and-tabs: 0,
	  no-multiple-empty-lines: 0
*/
var gulp  = require('gulp');
var gutil = require('gulp-util');

// utils
var validateConfig = require('./gulp/core/utils/validateConfig');
var lazyQuire      = require('./gulp/core/utils/lazyQuire');

// config
var project = require('./project.config');

// validate the project
// configuration
validateConfig(project);

// gulpfile booting message
gutil.log(gutil.colors.green('Starting to Gulp! Please wait...'));



/**
 * Grouped
 */
gulp.task('default', [
	  'fonts:watch',
	    'svg:watch',
	 'sprite:watch',
	 'images:watch',
	'scripts:watch',
	 'styles:watch',
	  'theme:watch',
	'browser:sync'
]);

gulp.task('build', [
	  'fonts:prod',
	    'svg:prod',
	 'sprite:prod',
	 'images:prod',
	'scripts:prod',
	 'styles:prod',
	  'theme:prod'
]);


/**
 * Browser
 */
gulp.task('browser:sync', [], lazyQuire(require, './gulp/core/recipes/browser-sync'));


/**
 * Fonts
 */
gulp.task('fonts:clean', [],              lazyQuire(require, './gulp/core/recipes/fonts/clean'));
gulp.task('fonts:dev',   ['fonts:clean'], lazyQuire(require, './gulp/core/recipes/fonts/dev'));
gulp.task('fonts:prod',  ['fonts:clean'], lazyQuire(require, './gulp/core/recipes/fonts/prod'));
gulp.task('fonts:watch', ['fonts:dev'],   lazyQuire(require, './gulp/core/recipes/fonts/watch'));


/**
 * Svgs
 */
gulp.task('svg:clean', [],            lazyQuire(require, './gulp/core/recipes/svg/clean'));
gulp.task('svg:dev',   ['svg:clean'], lazyQuire(require, './gulp/core/recipes/svg/dev'));
gulp.task('svg:prod',  ['svg:clean'], lazyQuire(require, './gulp/core/recipes/svg/prod'));
gulp.task('svg:watch', ['svg:dev'],   lazyQuire(require, './gulp/core/recipes/svg/watch'));


/**
 * Svg Sprites
 */
gulp.task('sprite:clean', [],               lazyQuire(require, './gulp/core/recipes/sprite/clean'));
gulp.task('sprite:dev',   ['sprite:clean'], lazyQuire(require, './gulp/core/recipes/sprite/dev'));
gulp.task('sprite:prod',  ['sprite:clean'], lazyQuire(require, './gulp/core/recipes/sprite/prod'));
gulp.task('sprite:watch', ['sprite:dev'],   lazyQuire(require, './gulp/core/recipes/sprite/watch'));


/**
 * Images
 */
gulp.task('images:clean', [],               lazyQuire(require, './gulp/core/recipes/images/clean'));
gulp.task('images:dev',   ['images:clean'], lazyQuire(require, './gulp/core/recipes/images/dev'));
gulp.task('images:prod',  ['images:clean'], lazyQuire(require, './gulp/core/recipes/images/prod'));
gulp.task('images:watch', ['images:dev'],   lazyQuire(require, './gulp/core/recipes/images/watch'));


/**
 * Scripts
 */
gulp.task('scripts:clean', [],                lazyQuire(require, './gulp/core/recipes/scripts/clean'));
gulp.task('scripts:dev',   ['scripts:clean'], lazyQuire(require, './gulp/core/recipes/scripts/dev'));
gulp.task('scripts:prod',  ['scripts:clean'], lazyQuire(require, './gulp/core/recipes/scripts/prod'));
gulp.task('scripts:watch', ['scripts:clean'], lazyQuire(require, './gulp/core/recipes/scripts/watch'));


/**
 * Styles
 */
gulp.task('styles:clean', [],               lazyQuire(require, './gulp/core/recipes/styles/clean'));
gulp.task('styles:dev',   ['styles:clean'], lazyQuire(require, './gulp/core/recipes/styles/dev'));
gulp.task('styles:prod',  ['styles:clean'], lazyQuire(require, './gulp/core/recipes/styles/prod'));
gulp.task('styles:watch', ['styles:dev'],   lazyQuire(require, './gulp/core/recipes/styles/watch'));


/**
 * Theme
 */
gulp.task('theme:clean', [],              lazyQuire(require, './gulp/core/recipes/theme/clean'));
gulp.task('theme:dev',   ['theme:clean'], lazyQuire(require, './gulp/core/recipes/theme/dev'));
gulp.task('theme:prod',  ['theme:clean'], lazyQuire(require, './gulp/core/recipes/theme/prod'));
gulp.task('theme:watch', ['theme:dev'],   lazyQuire(require, './gulp/core/recipes/theme/watch'));
