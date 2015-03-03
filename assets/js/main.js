


var partial = require('./_partial');



var { foo, bar } = {
	foo: ['1', '2', '3'],
	bar: { hello: 'World' },
	baz: 'Oh, No!'
};


console.log(foo);
console.log(bar);
console.log(partial);