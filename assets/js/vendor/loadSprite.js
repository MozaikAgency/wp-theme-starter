/**
 * Ajax load a sprite definition map
 * and prepend it to the document body
 *
 * @see https://css-tricks.com/ajaxing-svg-sprite/
 * @see https://css-tricks.com/svg-sprites-use-better-icon-fonts/
 * @see https://css-tricks.com/svg-symbol-good-choice-icons/
 * @see https://css-tricks.com/icon-fonts-vs-svg/
 * @see https://css-tricks.com/using-svg/
 *
 * @param base
 * @param name
 * @param extension
 */
export default function loadSprite({
	base = __webpack_public_path__ + '../svg/sprite-',
	name = 'default',
	extension = '.svg'
} = {}) {
	const spriteURI = base + name + extension;

	const ajax = new XMLHttpRequest();
	ajax.open('GET', spriteURI, true);
	ajax.onload = event => {
		if (ajax.status !== 200) return window.console.error(new Error(`Sprite ${spriteURI} was ${ajax.statusText}`));
		const div = document.createElement('div');
		div.style.display = 'none';
		div.innerHTML = ajax.responseText;
		document.body.insertBefore(div, document.body.childNodes[0]);
	};

	ajax.send();
}
