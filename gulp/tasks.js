var gulp = require('gulp');

/**
 * Styles
 */
var stylesCompile = require('./recipes/styles/compile');
var stylesWatch   = require('./recipes/styles/watch');
var stylesMinify  = require('./recipes/styles/minify');

gulp.task('styles:compile', [], stylesCompile);
gulp.task('styles:watch',   ['styles:compile'], stylesWatch);
gulp.task('styles:minify',  ['styles:compile'], stylesMinify);



/**
 * Theme
 */
var themeMove  = require('./recipes/theme/move');
var themeWatch = require('./recipes/theme/watch');

gulp.task('theme:move',  [], themeMove);
gulp.task('theme:watch', ['theme:move'], themeWatch);


/**
 * Project
 */
var projectZip = require('./recipes/project/zip');

gulp.task('project:zip', ['theme:build'], projectZip);