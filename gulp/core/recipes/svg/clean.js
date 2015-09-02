var del = require('del');

// config
var config = require('../../config/svg');


/**
 * Delete all svgs
 * within the built theme's
 * asset directory
 *
 */
module.exports = function (done) {
	del(config.paths.clean, { force: true })
		.then(function () { done(); });
};