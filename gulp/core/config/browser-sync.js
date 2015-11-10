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
	ghostMode: false,
	open: false
}, overrides);