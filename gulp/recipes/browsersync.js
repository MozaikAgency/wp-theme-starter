var browserSync = require('browser-sync');
var project     = require('../../package.json');

/**
 *
 * @see https://gist.github.com/gaspanik/2dc9b9fd607c0980321e
 */
module.exports = function () {
  browserSync({
    files: ['../' + project.name + '/assets/**'],
    server: false,
    open: false
  });
};