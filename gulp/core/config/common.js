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
	/**
	 * Configure the following setting to replace the filepath which is
	 * used in dev mode. The override_file_path.src is replaced with
	 * override_file_path.dest. Useful when you run gulp on the local
	 * machine and use vagrant for your dev machine.
	 * 
	 */
	// 'override_file_path': {
	// 	'src': '/the/build/path',
	// 	'dest': '/the/include/path'
	// },
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