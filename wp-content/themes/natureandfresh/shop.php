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
        'timeout' => 30,
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
            <h4>Finest nuts</>
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
                            <span class="is-img owl-item"><img data-src="<?php echo $image->src; ?>"/></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="control">

                    <form enctype="multipart/form-data" autocomplete="off" novalidate method="post">
                        <div class="info">
                            <?php echo $product->title; ?>
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

<?php /**
 <form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="9" data-product_variations="[{&quot;variation_id&quot;:27,&quot;variation_is_visible&quot;:true,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:true,&quot;display_price&quot;:900,&quot;display_regular_price&quot;:1000,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Original&quot;,&quot;attribute_size&quot;:&quot;95g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;del&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;1,000.00&lt;\/span&gt;&lt;\/del&gt; &lt;ins&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;900.00&lt;\/span&gt;&lt;\/ins&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;},{&quot;variation_id&quot;:32,&quot;variation_is_visible&quot;:true,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:true,&quot;display_price&quot;:30,&quot;display_regular_price&quot;:50,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Original&quot;,&quot;attribute_size&quot;:&quot;125g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;del&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;50.00&lt;\/span&gt;&lt;\/del&gt; &lt;ins&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;30.00&lt;\/span&gt;&lt;\/ins&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;},{&quot;variation_id&quot;:31,&quot;variation_is_visible&quot;:false,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:false,&quot;display_price&quot;:0,&quot;display_regular_price&quot;:0,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Chocolate&quot;,&quot;attribute_size&quot;:&quot;95g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;},{&quot;variation_id&quot;:30,&quot;variation_is_visible&quot;:true,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:true,&quot;display_price&quot;:80,&quot;display_regular_price&quot;:100,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Chocolate&quot;,&quot;attribute_size&quot;:&quot;125g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;del&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;100.00&lt;\/span&gt;&lt;\/del&gt; &lt;ins&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;80.00&lt;\/span&gt;&lt;\/ins&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;},{&quot;variation_id&quot;:29,&quot;variation_is_visible&quot;:true,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:true,&quot;display_price&quot;:180,&quot;display_regular_price&quot;:200,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Honey&quot;,&quot;attribute_size&quot;:&quot;95g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;del&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;200.00&lt;\/span&gt;&lt;\/del&gt; &lt;ins&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;180.00&lt;\/span&gt;&lt;\/ins&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;},{&quot;variation_id&quot;:28,&quot;variation_is_visible&quot;:true,&quot;variation_is_active&quot;:true,&quot;is_purchasable&quot;:true,&quot;display_price&quot;:65,&quot;display_regular_price&quot;:90,&quot;attributes&quot;:{&quot;attribute_flavour&quot;:&quot;Honey&quot;,&quot;attribute_size&quot;:&quot;125g&quot;},&quot;image_src&quot;:&quot;&quot;,&quot;image_link&quot;:&quot;&quot;,&quot;image_title&quot;:&quot;&quot;,&quot;image_alt&quot;:&quot;&quot;,&quot;image_caption&quot;:&quot;&quot;,&quot;image_srcset&quot;:&quot;&quot;,&quot;image_sizes&quot;:&quot;&quot;,&quot;price_html&quot;:&quot;&lt;span class=\&quot;price\&quot;&gt;&lt;del&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;90.00&lt;\/span&gt;&lt;\/del&gt; &lt;ins&gt;&lt;span class=\&quot;woocommerce-Price-amount amount\&quot;&gt;&lt;span class=\&quot;woocommerce-Price-currencySymbol\&quot;&gt;&amp;#36;&lt;\/span&gt;65.00&lt;\/span&gt;&lt;\/ins&gt;&lt;\/span&gt;&quot;,&quot;availability_html&quot;:&quot;&quot;,&quot;sku&quot;:&quot;&quot;,&quot;weight&quot;:&quot; kg&quot;,&quot;dimensions&quot;:&quot;&quot;,&quot;min_qty&quot;:1,&quot;max_qty&quot;:null,&quot;backorders_allowed&quot;:false,&quot;is_in_stock&quot;:true,&quot;is_downloadable&quot;:false,&quot;is_virtual&quot;:false,&quot;is_sold_individually&quot;:&quot;no&quot;,&quot;variation_description&quot;:&quot;&quot;}]">

    <table class="variations" cellspacing="0">
        <tbody>
        <tr>
            <td class="label"><label for="flavour">Flavour</label></td>
            <td class="value">
                <select id="flavour" class="" name="attribute_flavour" data-attribute_name="attribute_flavour" "="" data-show_option_none="yes"><option value="">Choose an option</option><option value="Original" selected="selected">Original</option><option value="Chocolate">Chocolate</option><option value="Honey">Honey</option></select>						</td>
        </tr>
        <tr>
            <td class="label"><label for="size">Size</label></td>
            <td class="value">
                <select id="size" class="" name="attribute_size" data-attribute_name="attribute_size" "="" data-show_option_none="yes"><option value="">Choose an option</option><option value="95g" selected="selected">95g</option><option value="125g">125g</option></select><a class="reset_variations" href="#">Clear</a>						</td>
        </tr>
        </tbody>
    </table>


    <div class="single_variation_wrap">
        <div class="woocommerce-variation single_variation"></div><div class="woocommerce-variation-add-to-cart variations_button">
            <div class="quantity">
                <input step="1" min="" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" type="number">
            </div>
            <button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>
            <input name="add-to-cart" value="9" type="hidden">
            <input name="product_id" value="9" type="hidden">
            <input name="variation_id" class="variation_id" value="0" type="hidden">
        </div>
    </div>


</form>
*/ ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

