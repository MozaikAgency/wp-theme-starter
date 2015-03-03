var gulp         = require('gulp');
var watch        = require('gulp-watch');


module.exports = function () {
	watch(['assets/scss/**/*.scss'], function () {
		gulp.start('styles:compile');
	});
};