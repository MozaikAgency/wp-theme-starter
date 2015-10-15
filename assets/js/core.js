/**
 * NOTE: You should not need to modify
 * this file!
 *
 * You can if you want to though, of course :)
 *
 */

/** Responsive Images Polyfill */
import 'picturefill';

/** Lazyload Images */
import '../../node_modules/lazysizes/plugins/bgset/ls.bgset.js';
import 'lazysizes';

/** Object-fit/Object-position Polyfill */
import objectFit from 'object-fit';

window.objectFit = objectFit;

const addEvent = () => window.addEventListener || window.attachEvent;
const event = ( window.addEventListener ? '' : 'on' ) + 'DOMContentLoaded';

addEvent()(event, () => {
	objectFit.polyfill({
		selector: '[data-object-fit="cover"]',
		fittype: 'cover',
		disableCrossDomain: true
	});

	objectFit.polyfill({
		selector: '[data-object-fit="contain"]',
		fittype: 'contain',
		disableCrossDomain: true
	});
});
