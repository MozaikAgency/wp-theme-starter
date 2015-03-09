var paths  = require('./common').paths;
var theme  = paths.theme;

/**
 * Theme Building
 * Configuration
 * Object
 *
 * @type {{}}
 */
module.exports = {
	paths: {
		watch: [theme.src + '/**/*', '!' + theme.src + '/README.md'],
		src:   [theme.src + '/**/*', '!' + theme.src + '/README.md'],
		dest:  theme.dest,
		clean: [theme.dest + '/**/*.php', '!' + paths.assets.dest]
	}
};