var gulp = require('gulp');


/**
 * Grouped
 */
gulp.task('default', [
	 'images:watch',
	'scripts:watch',
	 'styles:watch',
	  'theme:watch',
	'browser:sync'
]);

gulp.task('build', [
	 'images:prod',
	'scripts:prod',
	 'styles:prod',
	  'theme:prod'
]);



/**
 * Browser
 */
var browserSync = require('./gulp/recipes/browser-sync');

gulp.task('browser:sync', [], browserSync);


/**
 * Images
 */
var imagesClean = require('./gulp/recipes/images/clean');
var imagesDev   = require('./gulp/recipes/images/dev');
var imagesProd  = require('./gulp/recipes/images/prod');
var imagesWatch = require('./gulp/recipes/images/watch');

gulp.task('images:clean', [], imagesClean);
gulp.task('images:dev',   ['images:clean'], imagesDev);
gulp.task('images:prod',  ['images:clean'], imagesProd);
gulp.task('images:watch', ['images:dev'],   imagesWatch);



/**
 * Scripts
 */
var scriptsClean = require('./gulp/recipes/scripts/clean');
var scriptsDev   = require('./gulp/recipes/scripts/dev');
var scriptsProd  = require('./gulp/recipes/scripts/prod');
var scriptsWatch = require('./gulp/recipes/scripts/watch');

gulp.task('scripts:clean', [], scriptsClean);
gulp.task('scripts:dev',   ['scripts:clean'], scriptsDev);
gulp.task('scripts:prod',  ['scripts:clean'], scriptsProd);
gulp.task('scripts:watch', ['scripts:clean'], scriptsWatch);



/**
 * Styles
 */
var stylesClean = require('./gulp/recipes/styles/clean');
var stylesDev   = require('./gulp/recipes/styles/dev');
var stylesProd  = require('./gulp/recipes/styles/prod');
var stylesWatch = require('./gulp/recipes/styles/watch');

gulp.task('styles:clean', [], stylesClean);
gulp.task('styles:dev',   ['styles:clean'], stylesDev);
gulp.task('styles:prod',  ['styles:clean'], stylesProd);
gulp.task('styles:watch', ['styles:dev'],   stylesWatch);



/**
 * Theme
 */
var themeClean = require('./gulp/recipes/theme/clean');
var themeDev   = require('./gulp/recipes/theme/dev');
var themeProd  = require('./gulp/recipes/theme/prod');
var themeWatch = require('./gulp/recipes/theme/watch');

gulp.task('theme:clean', [], themeClean);
gulp.task('theme:dev',   ['theme:clean'], themeDev);
gulp.task('theme:prod',  ['theme:clean'], themeProd);
gulp.task('theme:watch', ['theme:dev'],   themeWatch);