<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function slugify($string, $replace = array(), $delimiter = '-')
{
    // https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
	if (!extension_loaded('iconv')) {
		throw new Exception('iconv module not loaded');
	}
    // Save the old locale and set the new locale to UTF-8
	$oldLocale = setlocale(LC_ALL, '0');
	setlocale(LC_ALL, 'en_US.UTF-8');
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
	if (!empty($replace)) {
		$clean = str_replace((array)$replace, ' ', $clean);
	}
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower($clean);
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	$clean = trim($clean, $delimiter);
    // Revert back to the old locale
	setlocale(LC_ALL, $oldLocale);
	return $clean;
}

require_once(get_template_directory() . '/lib/woocommerce-api.php');
$options = array(
	'debug' => true,
	'return_as_array' => false,
	'validate_url' => false,
	'timeout' => 300,
	'ssl_verify' => false,
	);

global $product;

$current = null;
$others = array();
try {
	$client = new WC_API_Client('http://natureandfresh.final.nz', WC_CONSUMER_KEY, WC_CONSUMER_SECRET, $options);
	$result = $client->products->get();
	foreach ($result->products as $itm) {
		if (strpos($itm->permalink, '/' . $product . '/') !== false) {
			$current = $itm;
		} else {
			$others[] = $itm;
		}
	}
//    var_dump('<pre>', $result->products, '</pre>');exit;
} catch (WC_API_Client_Exception $e) {
}

if (gettype($current) !== 'object') {
	global $wp_query;
	$wp_query->set_404();
	status_header(404);
	get_template_part(404);
	exit();
}

//var_dump('<pre>', $current, '</pre>');exit;

get_header('shop'); ?>

<div class="tab-benefit btn btn-sm desktop js-product-overlay hidden-xs" data-toggle="modal" data-target="#myModal">
	<div class="tab-benefit_title">Health Benefits</div>
</div>

<section id="product" class="container">

	<div class="row product-details">

		<div class="col-sm-5 col-xs-12">
			<div class="product-slider">
				<div class="product-slider_inner">

					<span class="carousel-prev">
                        <img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_left.svg" data-class="carousel-prev"/>
                    </span>
                    <span class="carousel-next">
                        <img class="svg loaded" src="<?php echo get_template_directory_uri(); ?>/images/icon-arrow_right.svg" data-class="carousel-next"/>
                    </span>

					<div class="owl-carousel owl-theme">
						<?php foreach ($current->images as $image) { ?>
						<div class="is-img item" style="width: 100%;">
							 <div class="owl-carousel-bgImg" style="background-image: url('<?php echo $image->src; ?>')"></div>
						</div>
						<?php } ?>
					</div>

				</div>
			</div>
		</div>


		<div class="col-md-offset-1 col-sm-6 product-details_contents">

			<h4 class="product-details__title"><?php echo $current->title; ?></h4>
			<article class="product-details_description"><?php echo $current->description; ?></article>

			<div class="product-details__price">
				<div class="price-details">
					
				</div>
				<!-- @Weida this needs to be dynamic -->
	            <div class="product-slider__discount">
	                <span>-20%</span>
	            </div>
            </div>

			<div class="attrs js-choices">
				<?php foreach ($current->attributes as $attrIdx => $attribute) { ?>
				<div class="product-attr">
					<h4 class="product-attr_title"><?php echo $attribute->name; ?></h4>
					<?php foreach ($attribute->options as $optIdx => $option) { ?>
					<input name="attr<?php echo $attrIdx; ?>" <?php if ($optIdx == 0) { ?>checked<?php } ?> id="opt-<?php echo $attrIdx . '-' . $optIdx; ?>" type="radio" autocomplete="off" value="<?php echo slugify($option); ?>"/>
					<label for="opt-<?php echo $attrIdx . '-' . $optIdx; ?>" class="btn btn-sm btn-option"><?php echo $option; ?></label>
					<?php } ?>
				</div>
				<?php } ?>
			</div>


			<div class="control">
				<form enctype="multipart/form-data" autocomplete="off" novalidate method="post">
					<h4 class="product-attr_title">Quantity</h4>
					<div class="control_quantity">
						<div class="remove"></div>
						<input value="1" name="quantity" class="amount" type="text"/>
						<div class="add"></div>
					</div>

					<button type="submit" class="btn btn-lg">Add to cart</button>
					<div class="js-params" style="display: none;">
						<?php foreach ($current->variations as $varIdx => $variation) { ?>
						<?php
						$optionsHtml = join(' ', array_map(function ($obj) {
							return slugify($obj->option);
						}, $variation->attributes));
						$optionsJson = urlencode(json_encode(array_map(function ($obj) {
							return array($obj->slug, $obj->option);
						}, $variation->attributes)));
						$priceHtml = '';
						if ($variation->price != $variation->regular_price) {
							$priceHtml .= "<span class='dollar regular'>$</span><span class='regular regular-price price'>{$variation->regular_price}</span><span class='regular-arrow'>&rsaquo;</span>";
						}
						$priceHtml .= "<span class='dollar'>$</span><span class='price'>{$variation->price}</span>";
						?>
						<div class="js-var">
							<input id="var-<?php echo $varIdx ?>" <?php if ($varIdx == 0) { ?>checked<?php } ?> name="variation_id" data-price="<?php echo $priceHtml; ?>" data-attrs="<?php echo $optionsJson; ?>" data-html="<?php echo $optionsHtml; ?>" type="radio" value="<?php echo $variation->id; ?>"/>
							<label for="var-<?php echo $varIdx ?>"><?php echo $optionsHtml; ?></label>
						</div>
						<?php } ?>

						<input name="add-to-cart" value="<?php echo $current->id; ?>" type="text"><br/>
						<input name="product_id" value="<?php echo $current->id; ?>" type="text"><br/>
						<div class="js-attrs"></div>
					</div>
				</form>
			</div>


		</div>
	</p>
</section>

<section class="container related-products">
	<h2>OH, AND YOU MIGHT LIKE THESE TOO</h2>
	<div class="owl-carousel owl-theme">
		<?php foreach ($others as $other) { ?>
		<div class="item">
			<a href="<?php echo str_replace('final.nz', 'hopto.org', $other->permalink); ?>">
				<div class="overlay">
					<h4><?php echo $other->title; ?></h4>
					<button class="btn btn-success">View detail</button>
				</div>
				<img src="<?php echo $other->images[0]->src; ?>"/>
			</a>
		</div>
		<?php } ?>
	</div>
</section>

<?php /**
 * <section class="container-fluid article-offset">
 * <div class="row">
 * <div class="article-offset_img col-md-6 col-xs-12 noPadding lazy-load" data-style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img-farm_birdview.png'); background-size: cover; background-position: center;"></div>
 * <article class="col-md-6 col-xs-12">
 * <div class="article-offset_heading">
 * <h2>Amazing Health Benefits Of Macadamia Nuts</h2>
 * </div>
 * <p>Macadamia nuts are considered the world’s finest nuts. Macadamia nuts are small buttery flavored nuts cultivated from macadamia nut trees that are grown in tropical climates of Australia, Brazil, Indonesia, Kenya, New Zealand, and South Africa. Although Australia is the largest producer of Macadamia nuts, nuts cultivated in Hawaii are the most acclaimed for their delicious taste. Their delicate flavor and crunchy texture make them a delight to consume.</p>
 * <p>Eating nuts on a regular basis has a positive effect on the health. These sweet, creamy, crunchy, and luxurious nuts are more often than not thought of as high fat indulgence rather than health food. But Macadamia contains a range of nutritious and health-promoting nutrients that make them an important part of our daily diet. A balanced diet containing macadamias promotes good health, longevity and a reduction in regenerative diseases.</p>
 * </article>
 * </div>
 *
 *
 * <div class="row">
 * <div class="article-offset_img col-md-6 col-xs-12 noPadding lazy-load" data-style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/img-farm_birdview.png'); background-size: cover; background-position: center;"></div>
 * <article class="col-md-6 col-xs-12">
 * <p>Macadamia nuts are considered the world’s finest nuts. Macadamia nuts are small buttery flavored nuts cultivated from macadamia nut trees that are grown in tropical climates of Australia, Brazil, Indonesia, Kenya, New Zealand, and South Africa. Although Australia is the largest producer of Macadamia nuts, nuts cultivated in Hawaii are the most acclaimed for their delicious taste. Their delicate flavor and crunchy texture make them a delight to consume.</p>
 * <p>Eating nuts on a regular basis has a positive effect on the health. These sweet, creamy, crunchy, and luxurious nuts are more often than not thought of as high fat indulgence rather than health food. But Macadamia contains a range of nutritious and health-promoting nutrients that make them an important part of our daily diet. A balanced diet containing macadamias promotes good health, longevity and a reduction in regenerative diseases.</p>
 * </article>
 * </div>
 * </section>
 */ ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<!--
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				
				<h4 class="modal-title" id="myModalLabel">Health Benefits</h4>
				
			</div>
			-->
			<div class="modal-body">
				<?php echo $current->short_description; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer('shop'); ?>

<script>
	$(function () {
		$('.owl-carousel').owlCarousel({
			center: true,
			loop: true,
			margin: 10,
			nav: true,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 3
				},
				1000: {
					items: 5
				}
			}
		})
	})
</script>