var webpack     = require('webpack');
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
		plugins: [
			new webpack.optimize.DedupePlugin(),
			new webpack.optimize.OccurenceOrderPlugin(true),
			new webpack.optimize.UglifyJsPlugin({
				minimize: true
			})
		]
	});
};