<?php
/*
Template Name: Shop
*/
?>

<?php get_header(); ?>

<?php
    require_once(__DIR__ . '/lib/woocommerce-api.php');
    $options = array(
        'debug' => true,
        'return_as_array' => false,
        'validate_url' => false,
        'timeout' => 300,
        'ssl_verify' => false,
    );

    try {
        $client = new WC_API_Client(get_site_url(), WC_CONSUMER_KEY, WC_CONSUMER_SECRET, $options);
        $result = $client->products->get();
    } catch (WC_API_Client_Exception $e) {
    }
?>
<div id="shop" class="container">
    <div class="row header">
        <div class="col-sm-5">
            <h4>Finest nuts</h4>
        </div>
        <div class="col-sm-7">
            <p class="text">Our ingredients are carefully selected. We’re ridiculously proud of our product and love nothing more than to share what we do with others. Lorem ispum lorem ipsum lorem ipsum lorem ipsum lorem ipsum.</p>
        </div>
    </div>

    <div class="row products">
        <?php foreach ($result->products as $product) { ?>
        <div class="col-sm-4">
            <div class="home-feature__productSlider">
                <div class="home-feature__productSlider_inner">
                    <span class="carousel-prev"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/></span>
                    <span class="carousel-next"><img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/></span>

                    <div class="owl-carousel owl-theme featured">
                        <?php foreach ($product->images as $image) { ?>
                            <a href="<?php echo $product->permalink ?>"><span class="is-img owl-item"><img data-src="<?php echo $image->src; ?>"/></span></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="control">

                    <form enctype="multipart/form-data" autocomplete="off" novalidate method="post">
                        <div class="info">
                            <a href="<?php echo $product->permalink ?>"><?php echo $product->title; ?></a>
                        </div>
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
                        <div class="price-wrap"></div>
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
        <?php } ?>
    </div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>

