var project = require('../../package.json');

module.exports = [
	'/**',
	' * Theme Name: '  + project.prettyName,
	' * Author: '      + project.author,
	' * Author URI: '  + project.authorURI,
	' * Description: ' + project.description,
	' * Version: '     + project.version,
	' * License: '     + project.license,
	' * Text Domain: ' + project.name,
	' *',
	' * Theme Styles are in the assets/css folder,',
	' * this file is only used for theme initialization',
	' *',
	' * This file is generated automagically by the',
	' * build system. To edit theme styles use the files',
	' * in the "dev theme", in the assets/scss folder',
	' *',
	' * See more at:',
	' * https://github.com/MozaikAgency/wp-theme-bootstrap',
	' *',
	' */'
].join('\n');