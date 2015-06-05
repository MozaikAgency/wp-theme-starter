/**
 * Return a function that lazily
 * requires a block only when
 * it is invoked and caches
 * it for future re-use
 *
 * @param path
 * @returns {Function}
 */
module.exports = function (require, path) {
	var worker = '';

	return function (a, b, c, d, e, f, g) {
		if (!worker) {
			worker = require(path);
		}

		return worker(a, b, c, d, e, f, g);
	};
};