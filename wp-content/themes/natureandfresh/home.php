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
    <section class="container">
        <header class="row">
            <nav class="main-nav col-md-4 col-xs-4">
                <a id="nav-icon1" href="javascript:void(0)" class="closebtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>

                <a id="nav-menu" href="#" class="menu">
                    menu
                </a>

                <a class="hidden-xs" href="/shop" title="shop">shop</a>
            </nav>

            <a id="logo" class="col-md-4 col-xs-4"  href="/" title="Nature & Fresh">
                <img class="lazy-load" src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/logo.svg"  data-delay="500" alt="Nature and Fresh">
            </a>

            <div class="menu-account col-md-4 col-xs-4">
                <a href="/sign-in">sign in</a>

                <a href="/cart">cart
                    <small>(5)</small>
                </a>
            </div>
        </header>

        <!--overlay-menu-->
        <div id="overlay-menu" class="overlay-menu">
            <div class="container">
                <div class="row">
                    <nav class="col-md-4">
                        <a class="menu-item" href="#">shop</a>
                        <a class="menu-item" href="#">about</a>
                        <a class="menu-item" href="#">the photo</a>
                        <a class="menu-item" href="#">wholesale</a>
                        <a class="menu-item" href="#">get in touch</a>
                    </nav>
                    <div class="col-md-6" id="instafeed"></div>
                    <div class="col-md-2 overlay-menu_facebook">
                        <a target="_blank" href="https://www.facebook.com/Nature-Fresh-409725865782785/?fref=ts">
                            <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/ft_facebook.svg">
                        </a>
                    </div>
                </div>
            </div>
        </div><!--Ends overlay-menu-->
    </section>

    <div id="homepage">
        <section class="container-fluid overHidden"> 

            <div class="row home-feature">
                <article class="col-sm-6 home-feature_left">

                    <h1>Macadamia Nuts</h1>
                    <h2>Organic, creamy, sweet &amp; crunchy</h2>
                    <p>Our organic certified macadamia nuts are grown and hand picked with care in a quiet franklin suburb. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magnaLorem.</p>

                    <div class="home-feature_left__img hidden-xs">
                        <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia-side.png?v=1" data-delay="500" data-class=""/>
                    </div>

                    <div class="home-feature_left__stamp">
                        <img class="nutshell lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_shelled.png?v=1.2" data-delay="300">
                        <img class="hr lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/hr.svg" data-delay="900">
                        <img class="organic-stamp lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/label-organic.svg" data-delay="1500">
                    </div>

                </article>

                <div class="col-sm-6 home-feature_right">
                    <div class="home-feature__productSlider">
                        <div class="home-feature__productSlider_inner">
                            <span class="carousel-prev">
                                <img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/>
                            </span>
                            <span class="carousel-next">
                                <img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/>
                            </span>

                            <div class="owl-carousel owl-theme featured">
                                <span class="is-img owl-item">
                                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_pouch.png"/>
                                </span>
                                <span class="is-img owl-item">
                                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia_spread.png"/>
                                </span>
                            </div>
                        </div>


                        <div class="control">
                            <form>
                                <div class="control_quantity">
                                    <div class="remove"></div>
                                    <input value="1" class="amount" type="text"/>
                                    <div class="add"></div>
                                </div>
                                <button type="button" class="btn btn-sm">Add to cart</button>
                            </form>
                        </div>
                    </div>

                    <div class="home-feature_right__img hidden-xs">
                        <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia-branch.png" data-delay="1000" data-class=""/>
                    </div>
                </div>
            </div>

            <div class="text-center nuts-progression_img">
                <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNutx5.png">
            </div>

        </section>

        <section class="container-fluid article-offset">
            <div class="row">
                <div class="article-offset_img col-md-6 col-xs-12 noPadding lazy-load" data-style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img-farm_birdview.png'); background-size: cover; background-position: center;">
                </div>
                <article class="col-md-6 col-xs-12">
                    <div class="article-offset_heading">
                        <h2>Title to be placed here, lorem our farm is spray and pesticide free.</h2>
                    </div>
                    <p>Introduction copy to be placed here, we try our best not to use machines in the orchard. Instead, we use natural fertilizers such as Agrissentials Rok Solid and comfrey. We use comfrey as a liquid fertilizer on our trees for the nutrients and minerals it brings up from deep in the ground.</p>
                    <p>We are out on the farm daily picking the macadamia nuts which are then husked and dried at a low temperature for eight weeks. The cracked nuts are then vacuum packed to preserve that fresh, original macadamia taste that we love. From growing to harvesting, drying and packaging, you can enjoy natural quality foods that have been grown and prepared with care.</p>
                    <p>With more products to come, it is an exciting time for everyone at Nature & Fresh! Stay tuned to our website for more updates and information as we continue to work on bringing you more of the fresh, natural taste you love.</p>
                    <p><a href="/about" class="btn btn-lg">About us</a></p>
                </article>

            </div>
        </section>
    </div><!--Ends #homepage-->
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>

</div>
