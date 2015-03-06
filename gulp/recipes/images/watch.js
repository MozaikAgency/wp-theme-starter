var gulp  = require('gulp');
var watch = require('gulp-watch');


module.exports = function () {
	watch([
		'assets/img/**/*.{gif,ico,jpg,jpeg,png,webp}',
		'!assets/img/sprites'
	], function () {
		gulp.start('images:move');
	});
};