<?php
/**
 * Read up on the WP Template Hierarchy for
 * when this file is used
 *
 * @author: Mozaik Ltd. <http://mozaik.com/>
 */
?>
<?php get_header(); ?>

	<article class="hero">
		<div class="hero__content">

			<header>
				<h1 class="hero__title">
					The Mozaik WordPress Theme Bootstrap
				</h1>
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

<?php get_footer(); ?>