<?php get_header(); ?>

<article class="tests">

	<h1 class="tests__title">
		Responsive Images Tests
	</h1>

	<p>
		Polyfills and Libraries used:
	</p>
	<ul class="tests__link-list">
		<li>
			<a href="https://github.com/scottjehl/picturefill" target="_blank">
				PictureFill - Responsive images specification polyfill
			</a>
			- Required for FF &lt; v38, IE and safari
		</li>
		<li>
			<a href="https://github.com/aFarkas/lazysizes" target="_blank">
				LazySizes - Lazy-load images
			</a>
			(+ <a href="https://github.com/aFarkas/lazysizes/tree/gh-pages/plugins/bgset" target="_blank"><i>bgset plugin</i></a>)
			- Required for lazy-loading responsive images and background images
		</li>
		<li>
			<a href="https://github.com/anselmh/object-fit" target="_blank">
				Object-fit Polyfill - Object-fit/position specification polyfill
			</a>
			- Required for FF &lt; v36 and IE object-fit/position support
		</li>
	</ul>

	<p>
		Tested on:
	</p>
	<dl class="tests__results">
		<dt>iOS 8.4 (iPad) Safari</dt>          <dd>All Cases Work (Note: lazy-loaded images load after scrollEnd, not on scroll)</dd>
		<dt>iOS 8.4 (iPad) Chrome</dt>          <dd>All Cases Work (Note: lazy-loaded images load after scrollEnd, not on scroll)</dd>
		<dt>Android 5.1 Firefox</dt>            <dd>All Cases Work</dd>
		<dt>Android 5.1 Chrome</dt>             <dd>All Cases Work</dd>
		<dt>Android 5.1 Opera</dt>              <dd>All Cases Work</dd>
		<dt>Mac Chrome</dt>                     <dd>All Cases Work</dd>
		<dt>Mac Safari</dt>                     <dd>All Cases Work</dd>
		<dt>Windows 7 Chrome</dt>               <dd>All Cases Work</dd>
		<dt>Windows 7 Firefox</dt>              <dd>All Cases Work</dd>
		<dt>Windows 7 Opera</dt>                <dd>All Cases Work</dd>
		<dt>Windows 7 IE 9 &#8211; 11</dt>      <dd>All Cases Work (Be careful how you implement object-fit! If the images disappear, you're doing it wrong!)</dd>
		<dt>Windows 10 Edge</dt>                <dd class="tests__warn">Object-fit broken</dd>
		<dt>Windows 7 Safari 5.1.7</dt>         <dd class="tests__warn">Object-fit broken</dd>
		<dt>Windows XP IE 8</dt>                <dd class="tests__error">Nothing Works...</dd>
	</dl>

	<section class="tests__section">
		<h2 class="tests__section-title">
			Basic Responsive Images
		</h2>
		<p class="tests__notice">
			Images should load different sizes
			at different viewport widths. Note
			the differences between art directed
			picture and img srcset-sizes
		</p>

		<h3 class="tests__section-subtitle">
			Background Image (no lazy-load)
		</h3>
		<p style="height: 300px;position: relative;">
			<?php
			// using a background image
			MOZ_Image::background( 9, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Picture Element (no lazy-load)
		</h3>
		<p>
			<?php
			MOZ_Image::picture( 7, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Image with srcset/sizes (no lazy-load)
		</h3>
		<p>
			<?php
			MOZ_Image::image( 6, array(
				'full',
				'large',
				'medium'
			), array(
				'(min-width: 1024px) 1024px',
				'100vw'
			) );
			?>
		</p>
	</section>

	<section class="tests__section">
		<h2 class="tests__section-title">
			Responsive Images using object-fit
		</h2>
		<p class="tests__notice">
			These are not background images. Images
			should not look stretched
		</p>

		<h3 class="tests__section-subtitle">
			Picture Element (no lazy-load, object-fit: cover)
		</h3>
		<p class="tests__object-fit">
			<?php
			MOZ_Image::picture( 5, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			), array(
				'data-object-fit' => 'cover'
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Image with srcset/sizes (lazy-load, object-fit: contain)
		</h3>
		<p class="tests__object-fit">
			<?php
			MOZ_Image::image( 4, array(
				'full', 'large', 'medium'
			), array(
				'(min-width: 1024px) 1024px',
				'100vw'
			), array(
				'data-object-fit' => 'contain'
			), array(
				'lazy' => true,
			) );
			?>
		</p>
	</section>

	<section class="tests__section">
		<h2 class="tests__section-title">
			Lazy Loaded Responsive Images
		</h2>
		<p class="tests__notice">
			Check the Network tab and note
			when the pictures are requested
		</p>

		<h3 class="tests__section-subtitle">
			Background Image (lazy-load)
		</h3>
		<p style="height: 300px;position: relative;">
			<?php
			// using a background image
			MOZ_Image::background( 11, 'medium', array(
				'large'  => '(min-width: 500px)',
				'full'   => '(min-width: 1200px)'
			), null, array(
				'lazy' => true
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Picture Element (lazy-load)
		</h3>
		<p>
			<?php
			MOZ_Image::picture( 10, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			), null, array(
				'lazy' => true
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Image with srcset/sizes (lazy-load)
		</h3>
		<p>
			<?php
			MOZ_Image::image( 8, array(
				'full',
				'large',
				'medium'
			), array(
				'(min-width: 1024px) 1024px',
				'100vw'
			), null, array(
				'lazy' => true
			) );
			?>
		</p>
	</section>

</article>

<?php get_footer(); ?>
