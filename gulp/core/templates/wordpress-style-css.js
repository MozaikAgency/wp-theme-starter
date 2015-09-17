var project = require('../../../project.config');

var possibleOptions = {
	name: 'Text Domain',
	prettyName: 'Theme Name',
	themeURI: 'Theme URI',
	description: 'Description',
	parentTheme: 'Template',
	version: 'Version',
	author: 'Author',
	authorURI: 'Author URI',
	license: 'License',
	licenseURI: 'License URI',
	tags: 'Tags'
};
var options = [];
var value;

for (var optionKey in possibleOptions) {
	if (possibleOptions.hasOwnProperty(optionKey) && project.hasOwnProperty(optionKey)) {
		value = project[optionKey];
		if (Array.isArray(value)) {
			value = value.join(', ');
		}

		options.push([' * ', possibleOptions[optionKey], ': ', value].join(''));
	}
}


module.exports = [
	'/**',
	options.join('\n'),
	' *',
	' * Theme Styles are in the assets/css folder,',
	' * this file is only used for theme initialization',
	' *',
	' * This file is generated automagically by the',
	' * build system. To edit theme styles use the files',
	' * in the "dev theme", in the assets/scss folder',
	' *',
	' * See more at:',
	' * https://github.com/MozaikAgency/wp-theme-starter',
	' *',
	' */'
].join('\n');