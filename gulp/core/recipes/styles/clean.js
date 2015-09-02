var del = require('del');

// config
var config = require('../../config/styles');


/**
 * Delete all CSS and SourceMap
 * files within the built theme's
 * asset directory
 *
 */
module.exports = function (done) {
	del(config.paths.clean, { force: true })
		.then(function () { done(); });
};