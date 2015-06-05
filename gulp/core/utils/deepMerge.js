var lodash = require('lodash');

/**
 * Utility for lodash.merge
 * to manage deeply merging
 * objects as well as the
 * arrays they contain
 *
 * @param a
 * @param b
 * @returns {Array.<T>|string}
 */
module.exports = function (a, b) {
	if (lodash.isArray(a) && lodash.isArray(b)) {
		return a.concat(b);
	}
};