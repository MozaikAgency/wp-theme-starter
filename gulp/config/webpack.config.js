var BowerWebpackPlugin = require('bower-webpack-plugin');


/**
 * Config for WebPack
 *
 * @type {{}}
 */
module.exports = {
	resolve: {
		extensions: ['', '.js', '.jsx']
	},
	stats: {
		colors: true
	},
	module: {
		loaders: [
			{
				test: /\.jsx?$/,
				exclude: /node_modules|bower_components/,
				loader: 'babel-loader'
			}
		]
	},
	plugins: [
		new BowerWebpackPlugin()
	]
};