var fs = require('fs');
var path = require('path');

/**
 * Return an array of direct
 * subdirectories for a given
 * directory
 *
 * @param dir
 * @returns {*}
 */
module.exports = function getFolders(dir) {
	return fs.readdirSync(dir).filter(function (file) {
		return fs.statSync(path.join(dir, file)).isDirectory();
	});
};
