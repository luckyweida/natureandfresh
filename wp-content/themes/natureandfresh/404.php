<?php
/**
 * Template Name: 404
 */

get_header(); ?>

    <div id="primary" class="content-area container">
        <div id="content" class="site-content row row-centered" role="main">
            <div class="col-md-8 col-xs-12 col-centered">
                <header class="page-header">
                    <h1 class="page-title"><?php _e('Opps! We can not seem to find the page you are looking for.', 'twentythirteen'); ?></h1>
                </header>

                <div class="page-wrapper">
                    <div class="page-content">
                        <!--
                        <h2><?php //_e('We can not seem to find the page you are looking for.', 'twentythirteen'); ?></h2>
                         -->
                        <a class="btn btn-lg" href="<?php echo get_site_url(); ?>/shop" title="shop">Let's go to the shop page</a>

                        <?php /** get_search_form(); */ ?>
                    </div><!-- .page-content -->
                </div><!-- .page-wrapper -->
            </div>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>