<?php
/*
Template Name: Home page
*/
?>

<?php get_header(); ?>
<div class="preload-loading">
    <div class="loading-widgets">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" />
        <input type="text" value="0" class="dial" autocomplete="off">
    </div>
</div>

<div class="preload-content">
    <section class="homepage">
        <div class="container">
            <header>
                <div class="left">
                    <a href="#">
                        <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/icon-menu.svg">
                        Menu
                    </a>

                    <a href="/shop">Shop</a>
                </div>

                <a href="/">
                    <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/logo.svg"  data-delay="500">
                </a>

                <div class="right">
                    <a href="/sign-in">Sign in</a>
                    <a href="/cart">Cart
                        <small>(5)</small>
                    </a>
                </div>
            </header>
            <div class="row top">
                <div class="col-md-6 left">

                    <h1>Macadamia Nuts</h1>
                    <h2>Cream, sweet, crunchy</h2>
                    <p>Our organic certified macadamia nuts are grown and hand picked with care in a quiet franklin suburb. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magnaLorem.</p>

                    <img class="nutshell lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_shelled.png" data-delay="300">
                    <img class="hr lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/hr.svg" data-delay="900">
                    <img class="organic lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/label-organic.svg" data-delay="1500">

                </div>

                <div class="col-md-6 right">
                    <div class="product">
                        <div class="inner">
                            <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/>
                            <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/>
                            <div class="owl-carousel owl-theme featured">
                                <span class="is-img owl-item"><img data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_pouch.png"/></span>
                                <span class="is-img owl-item"><img data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_pouch.png"/></span>
                                <span class="is-img owl-item"><img data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_pouch.png"/></span>
                            </div>
                        </div>


                        <div class="control">
                            <form>
                                <div class="first-row">
                                    <div class="remove">
                                        <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/icon-remove.svg">
                                    </div>
                                    <input value="1" type="text"/>
                                    <div class="add">
                                        <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/icon-add.svg">
                                    </div>
                                </div>
                                <div class="second-row">
                                    <button type="button" class="btn btn-success">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid middle">
            <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNutx5.png">
        </div>

        <div class="container-fluid bottom">
            <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-farm_birdview.png" data-class="leftHalf" />
            <div class="container">
                <div class="row top">
                    <div class="col-md-6 left">
                    </div>
                    <div class="col-md-6 right">
                        <div class="title-wrap">
                            <h2>Title to be placed here, lorem our farm is spray and pesticide free.</h2>
                        </div>
                        <p>Introduction copy to be placed here, we try our best not to use machines in the orchard. Instead, we use natural fertilizers such as Agrissentials Rok Solid and comfrey. We use comfrey as a liquid fertilizer on our trees for the nutrients and minerals it brings up from deep in the ground.</p>
                        <p>We are out on the farm daily picking the macadamia nuts which are then husked and dried at a low temperature for eight weeks. The cracked nuts are then vacuum packed to preserve that fresh, original macadamia taste that we love. From growing to harvesting, drying and packaging, you can enjoy natural quality foods that have been grown and prepared with care.</p>
                        <p>With more products to come, it is an exciting time for everyone at Nature & Fresh! Stay tuned to our website for more updates and information as we continue to work on bringing you more of the fresh, natural taste you love.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia-side.png" data-delay="500" data-class="leftBgImage"/>
    <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia-branch.png" data-delay="1000" data-class="rightBgImage"/>

    <?php get_sidebar(); ?>
    <?php get_footer(); ?>

</div>
