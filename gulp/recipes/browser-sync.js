var browserSync = require('browser-sync');

// config
var paths       = require('../config/common').paths;

/**
 *
 */
module.exports = function () {
  browserSync({
    files: [
			paths.assets.dest + '/**/*',
			'!' + paths.assets.dest + '/**/*.map'
		],
		logSnippet: false,
		server: false,
		open: false,
		reloadDelay: 100,
		reloadDebounce: 100
  });
};