var project = require('../../package.json');

module.exports = {
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
};