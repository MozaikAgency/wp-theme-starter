var browserSync = require('browser-sync');

// config
var paths       = require('../config/common').paths;

/**
 *
 */
module.exports = function () {
  browserSync({
    files: [
			paths.theme.dest + '/**/*',
			'!' + paths.assets.dest + '/**/*.map',
			'!' + paths.theme.dest + '/README.md',
			'!' + paths.theme.dest + '/style.css'
		],
		logSnippet: false,
		server: false,
		open: false
  });
};