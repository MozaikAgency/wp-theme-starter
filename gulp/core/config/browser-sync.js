// utils
var deepMerge = require('../utils/deepMerge');

// config
var overrides = require('../../config/browser-sync');

/**
 * BrowserSync
 * configuration
 * object
 *
 */
module.exports = deepMerge({
	logSnippet: false,
	open: false,
	ghostMode: false,
	reloadDelay: 100,
	reloadDebounce: 100
}, overrides);