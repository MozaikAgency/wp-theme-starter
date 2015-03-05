var project = require('../../../package.json');

module.exports = [
'/*\n\
Theme Name: ',  project.prettyName, '\n\
Author: ',      project.author, '\n\
Author URI: ',  project.authorURI, '\n\
Description: ', project.description, '\n\
Version: ',     project.version, '\n\
License: ',     project.license, '\n\
Text Domain: ', project.name, '\n\
\n\
!! NOTE !!\n\
* Theme Styles are in the assets/scss folder,\n\
* this file is only used for theme initialization\n\
\n\
\n\
*/'
].join('');