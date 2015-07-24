<?php get_header(); ?>

<article class="tests">

	<h1 class="tests__title">
		Responsive Images Tests
	</h1>

	<dl class="tests__results">
		<dt>Mac Chrome</dt>             <dd>All Cases Work</dd>
		<dt>Mac Safari</dt>             <dd>All Cases Work</dd>
		<dt>Windows 7 Chrome</dt>       <dd>All Cases Work</dd>
		<dt>Windows 7 Firefox</dt>      <dd>All Cases Work</dd>
		<dt>Windows 7 Opera</dt>        <dd>All Cases Work</dd>
		<dt>Windows 7 IE 9 &#8211; 11+</dt>     <dd>All Cases Work (Be careful how you implement object-fit! If the images disappear, you're doing it wrong!)</dd>
		<dt>Windows 7 Safari 5.1.7</dt> <dd class="tests__warn">Object-fit broken</dd>
		<dt>Windows XP IE 8</dt>        <dd class="tests__error">Nothing Works...</dd>
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
			MOZ_RI::background( 9, 'medium', array(
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
			MOZ_RI::picture( 7, 'medium', array(
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
			MOZ_RI::image( 6, array(
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
			MOZ_RI::picture( 5, 'medium', array(
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
			MOZ_RI::image( 4, array(
				'full',
				'large',
				'medium'
			), array(
				'(min-width: 1024px) 1024px',
				'100vw'
			), array(
				'lazy' => true,
				'data-object-fit' => 'contain'
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
			MOZ_RI::background( 11, 'medium', array(
				'large'  => '(min-width: 500px)',
				'full'   => '(min-width: 1200px)'
			), array(
				'lazy' => true
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Picture Element (lazy-load)
		</h3>
		<p>
			<?php
			MOZ_RI::picture( 10, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			), array(
				'lazy' => true
			) );
			?>
		</p>

		<h3 class="tests__section-subtitle">
			Image with srcset/sizes (lazy-load)
		</h3>
		<p>
			<?php
			MOZ_RI::image( 8, array(
				'full',
				'large',
				'medium'
			), array(
				'(min-width: 1024px) 1024px',
				'100vw'
			), array(
				'lazy' => true
			) );
			?>
		</p>
	</section>

</article>

<?php get_footer(); ?>
