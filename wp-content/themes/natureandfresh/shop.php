<?php
/*
Template Name: Shop
*/
?>

<?php get_header(); ?>

<div id="shop" class="container">
    <div class="row page-description">
        <div class="col-md-5 col-sm-12">
            <h4>Finest nuts</h4>
        </div>
        <div class="col-md-7 col-sm-12">
            <p class="text">Our ingredients are carefully selected. We’re ridiculously proud of our product and love nothing more than to share what we do with others. Lorem ispum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.</p>
        </div>
    </div>

    <div class="row row-centered products">
        <?php foreach ($myProducts->products as $product) { ?>
            <div class="col-md-4 col-sm-6 col-xs-12 col-centered">

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
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>

