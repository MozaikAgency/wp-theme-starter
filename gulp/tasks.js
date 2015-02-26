var gulp = require('gulp');

var scssCompile = require('./recipes/scss-compile');
var themeMove   = require('./recipes/theme-move');



/**
 * Styles
 */
gulp.task('scss-compile', [], scssCompile);


/**
 * Theme
 */
gulp.task('theme-move', [], themeMove);
gulp.task('theme-build', ['theme-move', 'scss-compile']);