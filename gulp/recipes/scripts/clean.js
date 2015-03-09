var del    = require('del');
var config = require('../../config/scripts');


/**
 * Delete all JS files
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (done) {
	del(config.paths.clean, { force: true }, done);
};