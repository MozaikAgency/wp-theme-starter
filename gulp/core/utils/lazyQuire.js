/**
 * Return a function that lazily
 * requires a block only when
 * it is invoked and caches
 * it for future re-use
 *
 * @param require
 * @param path
 * @returns {Function}
 */
module.exports = function lazyQuire(require, path) {
	var worker;

	return function req() {
		if (!worker) {
			worker = require(path);
		}

		return worker.apply(null, arguments);
	};
};
