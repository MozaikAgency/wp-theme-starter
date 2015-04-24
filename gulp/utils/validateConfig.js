var gutil = require('gulp-util');
var path  = require('path');

/**
 * Validate the options passed
 * into the project's package.json
 *
 * @param project
 */
module.exports = function (project) {

	var validationFailed = false;

	/**
	 * Safely handle misconfigured
	 * project name
	 */
	if (project.name === path.basename(__dirname)) {
		validationFailed = true;

		gutil.log('Config Error', gutil.colors.red('The \"name\" value in your package.json configuration \'' + project.name + '\''));
		gutil.log('            ', gutil.colors.red('cannot be the same as the directory name of the development theme \'' + path.basename(__dirname) + '\'.'));

		gutil.log('Please either rename the development theme directory (to \'' + project.name + '_dev\' for example)');
		gutil.log('or change the name value in your package.json to something else.');
	}

	if (validationFailed) {
		// if validation has failed
		// do not continue further
		process.exit(1);
	}
};