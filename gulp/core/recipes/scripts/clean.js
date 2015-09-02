var del = require('del');

// config
var config = require('../../config/scripts');


/**
 * Delete all JS files
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (done) {
	del(config.paths.clean, { force: true })
		.then(function () { done(); });
};