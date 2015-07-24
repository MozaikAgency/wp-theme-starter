/** Responsive Images Polyfill */
import 'picturefill';

/** Lazyload Images */
import '../../node_modules/lazysizes/plugins/bgset/ls.bgset.js';
import 'lazysizes';

/** Object-fit/Object-position Polyfill */
window.objectFit = require('object-fit/dist/polyfill.object-fit');

let addEvent = window.addEventListener || window.attachEvent;
let event = window.addEventListener ? 'DOMContentLoaded' : 'onDOMContentLoaded';

addEvent(event, () => {

	window.objectFit.polyfill({
		selector: '[data-object-fit="cover"]',
		fittype: 'cover',
		disableCrossDomain: true
	});

	window.objectFit.polyfill({
		selector: '[data-object-fit="contain"]',
		fittype: 'contain',
		disableCrossDomain: true
	});
});
