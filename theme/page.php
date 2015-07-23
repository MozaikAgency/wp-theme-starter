<?php get_header(); ?>

<div style="height: 2000px;"></div>
<div style="height: 300px;position: relative;">
	<?php
	// using a background image
	MOZ_RI::background( 11, 'medium', array(
		'large'  => '(min-width: 500px)',
		'full'   => '(min-width: 1200px)'
	), array(
		'lazy' => true
	) );
	?>
</div>

<?php

MOZ_RI::picture( 10, 'medium', array(
	'large' => '(min-width: 500px)',
	'full'  => '(min-width: 1200px)'
), array(
	'lazy' => true
) );

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


<?php get_footer(); ?>
