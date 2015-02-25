var gulp = require('gulp');


/**
 * Styles
 */
gulp.task('scss-compile', [], require('./recipes/scss-compile'));


/**
 * Theme
 */
gulp.task('theme-build', [], require('./recipes/theme-build'));