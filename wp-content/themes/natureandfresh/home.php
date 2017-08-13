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
                <p>Welcome to the Nature &amp; Fresh! It’s our goal to give our customers a great quality product with natural freshness. There is a wide variety of nuts in the market, but it’s rare to find New Zealand grown, spray-free nuts. You can find out more about our farm by reading our story and any feedback or comments are greatly appreciated so feel free to get in touch. Enjoy fresh at its finest!</p>

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
                    <?php $added = 0; ?>
                    <?php foreach ($myProducts->products as $idx => $product) { ?>
                        <?php if ($product->featured && !$added) { ?>
                            <?php $added = 1; ?>
                            <div class="product-slider col-md-6 col-md-offset-3 text-center">
                                <div class="product-slider">
                                    <div class="product-slider_inner">
                                        <?php if (($product->type == 'simple' && count($product->images) > 1) || ($product->type == 'variable' && count($product->variations) > 1)) { ?>
                                            <span class="carousel-prev"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/></span>
                                            <span class="carousel-next"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/></span>
                                        <?php } ?>

                                        <div class="owl-carousel owl-theme">
                                            <?php if ($product->type == 'variable') { ?>
                                                <?php foreach ($product->variations as $variation) { ?>
                                                    <?php
                                                    $optionsHtml = join(' ', array_map(function($obj) { return $obj->option; }, $variation->attributes));
                                                    if (count($variation->image) > 0) {
                                                        $image = $variation->image[0];
                                                    } else {
                                                        $image = $product->images[0];
                                                    }
//                                    var_dump($image);exit;
                                                    ?>
                                                    <a href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>" data-var="<?php echo $optionsHtml; ?>">
                                                        <div class="is-img item" style="width: 100%;">
                                                            <div class="owl-carousel-bgImg" style="background-image: url('<?php echo $image->src; ?>')"></div>
                                                            <!-- <img data-src="<?php //echo $image->src; ?>"/> -->
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php foreach ($product->images as $image) { ?>
                                                    <a href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>">
                                                        <div class="is-img item" style="width: 100%;">
                                                            <div class="owl-carousel-bgImg" style="background-image: url('<?php echo $image->src; ?>')"></div>
                                                            <!-- <img data-src="<?php //echo $image->src; ?>"/> -->
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>

                                        <div class="control">
                                            <form class="text-center js-add-cart-form" enctype="multipart/form-data" autocomplete="off" novalidate method="post">
                                                <h2 class="product-slider-title_sm">
                                                    <a href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>"><?php echo $product->title; ?></a>
                                                </h2>

                                                <div class="price-container">
                                                    <div class="price-details">
                                                        <?php if ($product->type == 'simple') { ?>
                                                            <?php if ($product->sale_price) { ?>
                                                                <span class="dollar regular">$</span>
                                                                <span class="regular regular-price price"><?php echo $product->regular_price; ?></span>
                                                                <span class="regular-arrow">›</span>
                                                                <span class="dollar">$</span>
                                                                <span class="price"><?php echo $product->price; ?></span>
                                                            <?php } else { ?>
                                                                <span class="dollar">$</span>
                                                                <span class="price"><?php echo $product->regular_price; ?></span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>

                                                    <div class="product-slider__discount js-discount" <?php if ($product->type == 'simple' && !$product->sale_price) { ?>style="display: none;"<?php } ?>>
                                        <span>
                                            <?php if ($product->type == 'simple' && $product->sale_price) { ?>
                                                -<?php echo (int)(($product->regular_price - $product->sale_price) / $product->regular_price * 100) ?>%
                                            <?php } ?>
                                        </span>
                                                    </div>
                                                </div>

                                                <div class="product-variables">
                                                    <?php if (count($product->variations) > 0) { ?>
                                                        <select class="variation js-variation custom-select">
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
                                                                <option data-regular="<?php echo $variation->regular_price; ?>" data-sale="<?php echo $variation->sale_price; ?>" data-now="<?php echo $variation->price; ?>" data-attrs="<?php echo $optionsJson; ?>" data-id="<?php echo $variation->id; ?>" data-price="<?php echo $priceHtml; ?>"><?php echo $optionsHtml; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>


                                                    <div class="control_quantity">
                                                        <div class="icon-minus remove"></div>
                                                        <input value="1" name="quantity" class="amount" type="text"/>
                                                        <div class="icon-add add"></div>
                                                    </div>
                                                </div>

                                                <a class="btn btn-sm btn-option" href="<?php echo str_replace(PRODUCT_FEED_URL, CURRENT_URL, $product->permalink) ?>">Tell me more</a>
                                                <button type="submit" class="btn btn-sm" data-toggle="modal" data-target="#cartModal">Add to cart</button>

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
                    <h2 class="article-title">Our farm is grown naturally, produced locally</h2>
                </div>
                <p>Our macadamias are grown in clean soil in Franklin suburb and we try our best not to use machines in the orchard. Instead, we use natural fertilizers such as Agrissentials Rok Solid and comfrey. We use comfrey as a liquid fertilizer on our trees for the nutrients and minerals it brings up from deep in the ground.</p>
                <p>We are out on the farm daily picking the macadamia nuts which are then husked and dried at a low temperature. The cracked nuts are then Nitrogen packed to preserve that fresh, original macadamia taste that we love. From growing to harvesting, drying and packaging, you can enjoy natural quality foods that have been grown and prepared with care.</p>
                <p><a href="/about" class="btn btn-lg">About us</a></p>
            </article>
        </div>
    </div>
    
</section><!--Ends #homepage-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

