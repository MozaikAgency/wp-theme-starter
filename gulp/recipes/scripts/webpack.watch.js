var webpackPack = require('./webpack.pack');

/**
 * Use webpack to watch
 * for changes to JS files
 *
 * @param cb
 * @returns {*}
 */
module.exports = function (cb) {
	return webpackPack(cb, {
		watch: true,
		devtool: 'eval',
		keepalive: true
	});
};