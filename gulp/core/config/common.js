// utils
var deepMerge = require('../utils/deepMerge');

// config
var project = require('../../../project.config');
var overrides = require('../../config/common');


/**
 * Common config
 * for all tasks
 *
 */
module.exports = deepMerge({
	paths: {
		theme: {
			src: 'theme',
			dest: '../' + project.name
		},
		assets: {
			src: 'assets',
			dest: '../' + project.name +  '/assets'
		}
	}
}, overrides);