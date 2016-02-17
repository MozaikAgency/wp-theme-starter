var fs = require('fs');
var path = require('path');

/**
 * Return an array of direct
 * subdirectories for a given
 * directory
 *
 * @param dir
 * @returns Array
 */
module.exports = function getFolders(dir) {
	try {
		return fs.readdirSync(dir).filter(function (file) {
			return fs.statSync(path.join(dir, file)).isDirectory();
		});
	} catch (error) {
		if (error.code === 'ENOENT') {
			// no dir found, that's ok just
			// return empty array
			return [];
		}

		throw error;
	}
};
