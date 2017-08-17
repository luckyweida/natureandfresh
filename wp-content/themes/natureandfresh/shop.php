<?php
/*
Template Name: Shop
*/

//var_dump(json_encode($myProducts->products[0]));exit;
?>

<?php get_header(); ?>

<div id="shop" class="container">
    <div class="row page-description">
        <div class="col-md-5 col-sm-12">
            <h4>The Finest</h4>
        </div>
        <div class="col-md-7 col-sm-12">
            <?php /**
            <p class="text">Our ingredients are carefully selected. We’re incredibly proud of our product and love nothing more than to share what we do with others.</p>
             * */?>
            <p class="text"><?php echo get_field('intro_content'); ?></p>
        </div>
    </div>

    <div class="row row-centered products">
    
        <?php foreach ($myProducts->products as $idx => $product) { if ($idx > 99 || ($product->type == 'variable' && count($product->variations) == 0) || (count($product->images) == 0)) continue; ?>
            <div class="col-md-4 col-sm-6 col-xs-12 col-centered">
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
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>

