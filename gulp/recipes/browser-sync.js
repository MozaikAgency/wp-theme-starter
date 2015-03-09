var browserSync = require('browser-sync');
var assets      = require('../config/common').paths.assets;

/**
 *
 */
module.exports = function () {
  browserSync({
    files: [assets.dest + '/**/*', '!' + assets.dest + '/**/*.map'],
		logSnippet: false,
		server: false,
		open: false
  });
};