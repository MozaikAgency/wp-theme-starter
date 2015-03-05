var browserSync = require('browser-sync');
var project     = require('../../package.json');

/**
 *
 */
module.exports = function () {
  browserSync({
    files: [
			'../' + project.name + '/assets/**/*',
			'!../' + project.name + '/assets/**/*.map'
		],
		logSnippet: false,
		server: false,
		open: false
  });
};