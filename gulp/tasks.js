var gulp = require('gulp');


/**
 * Styles
 */
gulp.task('scss-compile', [], require('./recipes/scss-compile'));


/**
 * Theme
 */
gulp.task('theme-move', [], require('./recipes/theme-move'));
gulp.task('theme-build', ['theme-move', 'scss-compile']);