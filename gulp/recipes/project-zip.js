var gulp         = require('gulp');
var plumber      = require('gulp-plumber');
var zip          = require('gulp-zip');
var notify       = require('gulp-notify');
var displayError = require('../utils/displayError');
var pumped       = require('../utils/pumped');



var project = require('../../package.json');


module.exports = function () {
	return gulp.src(['../../../**/*', '!../../../wp-content/themes/mbwp_theme/**/*'])
		.pipe(plumber({ errorHandler: displayError }))
		.pipe(zip(project.name + '.zip'))
		.pipe(gulp.dest('../../../'))
		.pipe(notify({
			message: pumped('Project Zipped and ready to go!'),
			onLast: true
		}));
};