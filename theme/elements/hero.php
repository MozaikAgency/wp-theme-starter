<?php
/**
 * Simple Page Hero Element
 *
 * @author: Mozaik Ltd. <http://mozaik.com/>
 */
?>
<article class="hero">
	<div class="hero__content">

		<header>
			<h1>The Mozaik WordPress Theme Bootstrap</h1>
		</header>

		<p>
			Build tools included! :)
		</p>

		<p>
			<strong>Happy Hacking!</strong>
		</p>

		<footer>
			<a class="hero__cta"
			   target="_blank"
			   href="https://github.com/MozaikAgency/wp-theme-bootstrap">
				check out the README
			</a>

			<?php get_template_part( 'elements/github' ); ?>
		</footer>

	</div>
</article>