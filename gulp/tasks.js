var gulp = require('gulp');


/**
 * Grouped
 */
gulp.task('default', ['styles:watch', 'theme:watch', 'scripts:watch']);


/**
 * Scripts
 */
var scriptsClean  = require('./recipes/scripts/clean');
var scriptsPack   = require('./recipes/scripts/webpack.pack');
var scriptsWatch  = require('./recipes/scripts/webpack.watch');
var scriptsMinify = require('./recipes/scripts/webpack.minify');

gulp.task('scripts:clean',  [], scriptsClean);
gulp.task('scripts:pack',   ['scripts:clean'], scriptsPack);
gulp.task('scripts:watch',  ['scripts:clean'], scriptsWatch);
gulp.task('scripts:minify', ['scripts:clean'], scriptsMinify);



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