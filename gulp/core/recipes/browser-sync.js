var browserSync = require('browser-sync');

// config
var paths       = require('../config/common').paths;

/**
 * Spin up the browser-sync
 * socket server to listen for
 * and push code changes to the
 * browser
 *
 */
module.exports = function (done) {
  browserSync({
		logSnippet: false,
		server: false,
		open: false,
		reloadDelay: 100,
		reloadDebounce: 100
  });

	done();
};