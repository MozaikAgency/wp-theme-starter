var config       = require('../config/common');

module.exports = function (filename, definitions) {

	var preservedDefs = (definitions && definitions.length)
		? ' * ' + definitions.join('\n * ') + '\n *'
		: ' *';
	
	/**
	 * Replace the file path in case config.override_file_path is set.
	 */
	if(typeof config.override_file_path != "undefined")
	{
		var filename = filename.replace( config.override_file_path.src, config.override_file_path.dest);

	}

	return [
		'<?php',
		'/**',
		preservedDefs,
		' * DEVELOPMENT MODE ONLY',
		' *',
		' * Includes and Runs php files directly',
		' * from the dev theme to enable debugging',
		' * php from within the dev theme!',
		' *',
		' * Run "gulp build" to generate the theme',
		' * for production before deploying!',
		' *',
		' */',
		'include \'' + filename + '\';'
	].join('\n');
};