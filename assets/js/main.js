/**
 * Support for ES6+ via Babel.js!
 */

import message from './_partial';

let { foo, baz } = {
	foo: 'Hello',
	bar: 'Cruel',
	baz: 'World'
};

console.log(foo, baz, message);