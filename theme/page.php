<?php get_header(); ?>

<article class="tests">

	<h1 class="tests__title">
		Responsive Images Tests
	</h1>

	<dl class="tests__results">
		<dt>Windows Chrome</dt> <dd>Works</dd>
		<dt>Windows Firefox</dt><dd>Works</dd>
		<dt>Windows Opera</dt>  <dd>Works</dd>
		<dt>Windows Safari</dt> <dd>Object-fit broken</dd>
		<dt>Windows IE 11</dt>  <dd>Object-fit broken</dd>
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

		<p style="height: 300px;position: relative;">
			<?php
			// using a background image
			MOZ_RI::background( 9, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			) );
			?>
		</p>

		<p>
			<?php
			MOZ_RI::picture( 7, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			) );
			?>
		</p>

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

		<p class="tests__object-fit">
			<?php
			MOZ_RI::picture( 5, 'medium', array(
				'large' => '(min-width: 500px)',
				'full'  => '(min-width: 1200px)'
			) );
			?>
		</p>

		<p class="tests__object-fit">
			<?php
			MOZ_RI::image( 4, array(
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
			Lazy Loaded Responsive Images
		</h2>
		<p class="tests__notice">
			Check the Network tab and note
			when the pictures are requested
		</p>

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
