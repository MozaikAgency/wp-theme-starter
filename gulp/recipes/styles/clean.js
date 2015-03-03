var del     = require('del');
var project = require('../../../package.json');


/**
 * Delete all CSS files
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (cb) {
	del(['../' + project.name + '/assets/css/*.css'], {force: true}, cb);
};