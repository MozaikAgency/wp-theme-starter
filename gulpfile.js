var gulp = require('gulp');


/**
 * Grouped
 */
var yargs = require('yargs');

if (yargs.argv.build) {
	gulp.task('default', [
		'scripts:minify',
		'styles:minify',
		'theme:move'
	]);
} else {
	gulp.task('default', [
		'scripts:watch',
		'styles:watch',
		'theme:watch',
		'browser:sync'
	]);
}



/**
 * Browser
 */
var browserSync = require('./gulp/recipes/browser-sync');

gulp.task('browser:sync', [], browserSync);



/**
 * Scripts
 */
var scriptsClean  = require('./gulp/recipes/scripts/clean');
var scriptsPack   = require('./gulp/recipes/scripts/webpack.pack.js');
var scriptsWatch  = require('./gulp/recipes/scripts/webpack.watch.js');
var scriptsMinify = require('./gulp/recipes/scripts/webpack.minify.js');

gulp.task('scripts:clean',  [], scriptsClean);
gulp.task('scripts:pack',   ['scripts:clean'], scriptsPack);
gulp.task('scripts:watch',  ['scripts:clean'], scriptsWatch);
gulp.task('scripts:minify', ['scripts:clean'], scriptsMinify);



/**
 * Styles
 */
var stylesClean   = require('./gulp/recipes/styles/clean');
var stylesCompile = require('./gulp/recipes/styles/compile');
var stylesWatch   = require('./gulp/recipes/styles/watch');
var stylesMinify  = require('./gulp/recipes/styles/minify');

gulp.task('styles:clean',   [], stylesClean);
gulp.task('styles:compile', ['styles:clean'],   stylesCompile);
gulp.task('styles:watch',   ['styles:compile'], stylesWatch);
gulp.task('styles:minify',  ['styles:compile'], stylesMinify);



/**
 * Theme
 */
var themeClean = require('./gulp/recipes/theme/clean');
var themeMove  = require('./gulp/recipes/theme/move');
var themeWatch = require('./gulp/recipes/theme/watch');

gulp.task('theme:clean', [], themeClean);
gulp.task('theme:move',  ['theme:clean'], themeMove);
gulp.task('theme:watch', ['theme:move'],  themeWatch);



/**
 * Project
 */
var projectZip = require('./gulp/recipes/project/zip');

gulp.task('project:zip', ['theme:build'], projectZip);