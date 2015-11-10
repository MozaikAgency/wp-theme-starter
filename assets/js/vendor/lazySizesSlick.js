/**
 * Lazy load slick slides
 * with lazysizes
 *
 * slick: http://kenwheeler.github.io/slick/
 * lazysizes: https://github.com/aFarkas/lazysizes
 *
 * @param $slideshow
 * @param imgSelector
 */
export default function lazySizesSlick($slideshow, imgSelector = 'img') {
	$slideshow.on('beforeChange', function (event, slick, direction, nextIndex) {
		$(this)
			.find(`[data-slick-index="${nextIndex}"] ${imgSelector}`)
			.addClass('lazyload');
	});
}
