/*eslint "no-underscore-dangle": 0*/
/*eslint "camelcase": 0*/

/**
 * Set Webpack's
 * public path
 *
 */
const scripts = document.getElementsByTagName('script');
const src = scripts[scripts.length - 1].getAttribute('src');
__webpack_public_path__ = src.substr(0, src.lastIndexOf('/') + 1);