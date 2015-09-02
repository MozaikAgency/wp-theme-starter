/**
 * Setup webpack public path
 * to enable lazy-including of
 * js chunks
 *
 */
import './vendor/webpack.publicPath';

/**
 * Your theme's js starts
 * here...
 */

// silly example:
import obj from './elements/example';
for (let val of obj) {
	window.console.log(val);
}
