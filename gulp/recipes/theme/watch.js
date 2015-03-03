var gulp  = require('gulp');
var watch = require('gulp-watch');

module.exports = function () {
	watch(['theme/**/*', '!theme/README.md'], function () {
		gulp.start('theme:move');
	});
};