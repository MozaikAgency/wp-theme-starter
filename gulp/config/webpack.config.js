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
			{ test: /\.jsx?$/, exclude: /node_modules/, loader: 'babel-loader' }
		]
	}
};