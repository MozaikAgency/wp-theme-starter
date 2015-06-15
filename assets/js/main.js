/**
 * Support for ES6+ via Babel.js!
 */

import './vendor/webpack.publicPath';


import { foo, baz } from './partials/partial';


if ('Hello' === foo) {
	/**
	 * Webpack Chunking
	 */
	require.ensure(['./chunks/module'], function (require) {
		var moduleMessage = require('./chunks/module');
		console.log(moduleMessage);
	}, 'module');
}