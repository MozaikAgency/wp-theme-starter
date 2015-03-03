var del     = require('del');
var project = require('../../../package.json');


/**
 * Delete all php files
 * within the built theme
 * directory
 *
 */
module.exports = function (cb) {
	del(['../' + project.name + '/**/*.php'], { force: true }, cb);
};