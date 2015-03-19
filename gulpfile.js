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
gulp.task('browser:sync', [], require('./gulp/recipes/browser-sync'));


/**
 * Images
 */
gulp.task('images:clean', [],               require('./gulp/recipes/images/clean'));
gulp.task('images:dev',   ['images:clean'], require('./gulp/recipes/images/dev'));
gulp.task('images:prod',  ['images:clean'], require('./gulp/recipes/images/prod'));
gulp.task('images:watch', ['images:dev'],   require('./gulp/recipes/images/watch'));


/**
 * Scripts
 */
gulp.task('scripts:clean', [],                require('./gulp/recipes/scripts/clean'));
gulp.task('scripts:dev',   ['scripts:clean'], require('./gulp/recipes/scripts/dev'));
gulp.task('scripts:prod',  ['scripts:clean'], require('./gulp/recipes/scripts/prod'));
gulp.task('scripts:watch', ['scripts:clean'], require('./gulp/recipes/scripts/watch'));


/**
 * Styles
 */
gulp.task('styles:clean', [],               require('./gulp/recipes/styles/clean'));
gulp.task('styles:dev',   ['styles:clean'], require('./gulp/recipes/styles/dev'));
gulp.task('styles:prod',  ['styles:clean'], require('./gulp/recipes/styles/prod'));
gulp.task('styles:watch', ['styles:dev'],   require('./gulp/recipes/styles/watch'));


/**
 * Theme
 */
gulp.task('theme:clean', [],              require('./gulp/recipes/theme/clean'));
gulp.task('theme:dev',   ['theme:clean'], require('./gulp/recipes/theme/dev'));
gulp.task('theme:prod',  ['theme:clean'], require('./gulp/recipes/theme/prod'));
gulp.task('theme:watch', ['theme:dev'],   require('./gulp/recipes/theme/watch'));