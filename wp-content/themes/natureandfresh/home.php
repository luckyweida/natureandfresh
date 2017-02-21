<?php
/*
Template Name: Home page
*/
?>

<?php get_header(); ?>

<section id="homepage">
    <div class="container-fluid overHidden">

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


                <!--@Weida Please update to show one product only-->
                <div class="row">
                    <?php foreach ($myProducts->products as $idx => $product) { ?>
                        <?php if ($idx === 0) { ?>
                            <div class="product-slider col-md-6 col-md-offset-3 text-center">

                                <div class="product-slider">
                                    <div class="product-slider_inner">

                                        <!-- @Weida this needs to be dynamic -->
                                        <div class="product-slider__discount">
                                            <span>-20%</span>
                                        </div>

                                        <span class="carousel-prev"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/></span>
                                        <span class="carousel-next"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/></span>

                                        <div class="owl-carousel owl-theme">

                                            <?php foreach ($product->images as $image) { ?>
                                                <a href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>">
                                                    <div class="is-img item">
                                                        <div class="owl-carousel-bgImg" style="background-image: url('<?php echo $image->src; ?>')"></div>
                                                        <!-- <img data-src="<?php //echo $image->src; ?>"/> -->
                                                    </div>
                                                </a>
                                            <?php } ?>
                                        </div>

                                        <div class="control">
                                            <form class="text-center" enctype="multipart/form-data" autocomplete="off" novalidate method="post">
                                                <h2 class="product-slider-title_sm">
                                                    <a href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>"><?php echo $product->title; ?></a>
                                                </h2>

                                                <div class="price-details"></div>

                                                <select class="variation js-variation">
                                                    <?php foreach ($product->variations as $variation) { ?>
                                                        <?php
                                                        $optionsHtml = join(' ', array_map(function($obj) { return $obj->option; }, $variation->attributes));
                                                        $optionsJson = urlencode(json_encode(array_map(function($obj) { return array($obj->slug, $obj->option); }, $variation->attributes)));
                                                        $priceHtml = '';
                                                        if ($variation->price != $variation->regular_price) {
                                                            $priceHtml .= "<span class='dollar regular'>$</span><span class='regular regular-price price'>{$variation->regular_price}</span><span class='regular-arrow'>&rsaquo;</span>";
                                                        }
                                                        $priceHtml .= "<span class='dollar'>$</span><span class='price'>{$variation->price}</span>";
                                                        ?>
                                                        <option data-attrs="<?php echo $optionsJson; ?>" data-id="<?php echo $variation->id; ?>" data-price="<?php echo $priceHtml; ?>"><?php echo $optionsHtml; ?></option>
                                                    <?php } ?>
                                                </select>

                                                <div class="control_quantity">
                                                    <div class="remove"></div>
                                                    <input value="1" name="quantity" class="amount" type="text"/>
                                                    <div class="add"></div>
                                                </div>

                                                <button type="submit" class="btn btn-sm">Add to cart</button>
                                                <div class="js-params" style="display: none;">
                                                    <input name="add-to-cart" value="<?php echo $product->id; ?>" type="text">
                                                    <input name="product_id" value="<?php echo $product->id; ?>" type="text">
                                                    <input name="variation_id" class="variation_id" type="text">
                                                    <div class="js-attrs"></div>
                                                </div>


                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="home-feature_right__img hidden-xs">
                    <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamia-branch.png" data-delay="1000" data-class=""/>
                </div>
            </div>
                
        </div>
    </div>

    <div class="text-center nuts-progression_img">
        <img class="lazy-load" src="http://placehold.it/350x150/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNutx5.png">
    </div>

    </div>

    <div class="container-fluid article-offset">
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
    </div>
</section><!--Ends #homepage-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

