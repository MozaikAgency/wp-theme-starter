var browserSync = require('browser-sync');

// config
var config = require('../config/browser-sync');

/**
 * Spin up the browser-sync
 * socket server to listen for
 * and push code changes to the
 * browser
 *
 */
module.exports = function (done) {
  browserSync(config);
	done();
};