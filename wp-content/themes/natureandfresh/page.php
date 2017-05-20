<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage natureandfresh
 * @since natureandfresh 1.0
 */

get_header(); ?>

<!--This template is col-md-8 and centered, a narrower content area for checkout process pages | francis wu-->
<div id="primary" class="content-area container 1234">
	<main id="main" class="site-main row row-centered" role="main">
		<div class="col-md-8 col-xs-12 col-centered">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// End of the loop.
			endwhile;
			?>
		</div>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
