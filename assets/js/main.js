/**
 * Support for ES6+ via Babel.js!
 */

import './vendor/webpack.publicPath';

import message from './partials/partial';

let { foo, baz } = {
	foo: 'Hello',
	bar: 'Cruel',
	baz: 'World'
};

console.log(foo, baz, message);

if ('Hello' === foo) {
	/**
	 * Webpack Chunking
	 */
	require.ensure(['./chunks/module'], function (require) {
		var moduleMessage = require('./chunks/module');
		console.log(moduleMessage);
	}, 'module');
}