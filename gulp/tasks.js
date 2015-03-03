var gulp = require('gulp');


/**
 * Grouped
 */
gulp.task('default', ['styles:watch', 'theme:watch']);



/**
 * Styles
 */
var stylesClean   = require('./recipes/styles/clean');
var stylesCompile = require('./recipes/styles/compile');
var stylesWatch   = require('./recipes/styles/watch');
var stylesMinify  = require('./recipes/styles/minify');

gulp.task('styles:clean',   [], stylesClean);
gulp.task('styles:compile', ['styles:clean'],   stylesCompile);
gulp.task('styles:watch',   ['styles:compile'], stylesWatch);
gulp.task('styles:minify',  ['styles:compile'], stylesMinify);



/**
 * Theme
 */
var themeClean = require('./recipes/theme/clean');
var themeMove  = require('./recipes/theme/move');
var themeWatch = require('./recipes/theme/watch');

gulp.task('theme:clean', [], themeClean);
gulp.task('theme:move',  ['theme:clean'], themeMove);
gulp.task('theme:watch', ['theme:move'],  themeWatch);



/**
 * Project
 */
var projectZip = require('./recipes/project/zip');

gulp.task('project:zip', ['theme:build'], projectZip);