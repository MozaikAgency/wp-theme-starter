/**
 * Project info config object
 *
 * @params {
 *  string      name         The built theme dirname and the theme text-domain
 *  string      prettyName   The theme name as shown in the theme selector admin
 *  string      description  A short description of the theme
 *  bool|string parentTheme  (optional) If this is a child theme, then put the parent
 *                           theme's directory name here
 *  string      version      The theme's version
 *  string      author       The theme's author
 *  string      authorURI    The theme's author URI
 *  string      license      The theme's license
 *  array       keywords     Keywords that could be associated with the theme
 * }
 */
module.exports = {
	name: 'you_should_probably_change_this',
	prettyName: 'You should probably change this...',
	description: 'The 2015 theme for {Example.com}. Built by Mozaik Ltd. for {Example}',
	parentTheme: false,
	version: '0.1.0',
	author: 'John Doe <john@example.com>',
	authorURI: 'http://example.com',
	license: 'GPLv2 or later',
	keywords: []
};