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
			new webpack.optimize.DedupePlugin({minimize: true}),
			new webpack.optimize.UglifyJsPlugin({minimize: true})
		]
	});
};