<?php
/*
Template Name: Get in touch
*/
?>

<?php get_header(); ?>

<div id="get-in-touch" >
	<div class="container">
		<div id="get-in-touch-form" class="row">
			<div class="col-md-6 col-xs-12 contact-info">
				<h3 class="contact-info_title">Get in touch</h3>
				<p><a href="mailto:info@natureandfresh.co.nz" title="Email us">info@natureandfresh.co.nz</a></p>
				<h3 class="contact-info_title">Address</h3>
				<p>1340C Glenbrook Road, Rd1, Waiuku 2681, New Zealand</p>
				<h3 class="contact-info_title">Phone</h3>
				<p>+64 21 079 0102</p>
				<a class="fb" target="_blank" href="https://www.facebook.com/Nature-Fresh-409725865782785/?fref=ts">
					<img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/ft_facebook.svg">
				</a>
				<a class="insta" target="_blank" href="https://www.instagram.com/natureandfresh/">
                    <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/icon-instagram.svg">
                </a>
			</div>

			<div class="col-md-6 col-xs-12">
				<?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; else: ?>
					<p>Sorry, no posts matched your criteria.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="container-fluid map-container noPadding">
		<div id="google-map"></div>
	</div>

</div>




<?php get_sidebar(); ?>
<?php get_footer(); ?>

