var gulp   = require('gulp');
var watch  = require('gulp-watch');

// config
var config = require('../../config/theme');


/**
 * Watch theme files
 * for changes
 *
 * @param done
 */
module.exports = function (done) {
	watch(config.paths.watch, function () {
		gulp.start('theme:dev');
	});

	done();
};