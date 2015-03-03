var del = require('del');
var project = require('../../../package.json');


/**
 * Delete all JS files
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (cb) {
	del(['../' + project.name + '/assets/js/*.js'], { force: true }, cb);
};