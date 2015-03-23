var browserSync = require('browser-sync');
var paths       = require('../config/common').paths;

/**
 *
 */
module.exports = function () {
  browserSync({
    files: [paths.theme.dest + '/**/*', '!' + paths.assets.dest + '/**/*.map'],
		logSnippet: false,
		server: false,
		open: false
  });
};