<?php
/*
Template Name: Get in touch
*/
?>

<?php get_header(); ?>

<div id="get-in-touch" class="container-fluid">
    <div id="get-in-touch-form" class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12 noPadding">
                <br />
                <h4>Get in touch</h4>
                <p>info@natureandfresh.co.nz</p>
                <br />
                <h4>Address</h4>
                <p>1340C Glenbrook Road, Rd1, Waiuku 2681, New Zealand</p>
                <br />
                <h4>Phone</h4>
                <p>+64 21 079 0102</p>
                <br />
                <a target="_blank" href="https://www.facebook.com/Nature-Fresh-409725865782785/?fref=ts">
                    <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/ft_facebook.svg">
                </a>
            </div>
            <div class="col-md-6 col-xs-12">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    the_content();
                endwhile;
                else: ?>
                    <p>Sorry, no posts matched your criteria.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container-fluid map-container">
        <div id="google-map"></div>
    </div>
</div>




<?php get_sidebar(); ?>
<?php get_footer(); ?>

