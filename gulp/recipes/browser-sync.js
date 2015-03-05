var browserSync = require('browser-sync');
var project     = require('../../package.json');

/**
 *
 */
module.exports = function () {
  browserSync({
    files: ['../' + project.name + '/assets/**'],
		logSnippet: false,
		server: false,
		open: false
  });
};