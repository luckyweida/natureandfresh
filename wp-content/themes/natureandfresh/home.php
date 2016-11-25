<?php
/*
Template Name: Home page
*/
?>

<?php get_header(); ?>

<section class="homepage">
	<div class="container">
		<header>
			<div class="left">
				<a href="#">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icon-menu.svg">
					Menu
				</a>

				<a href="/shop">Shop</a>
			</div>

			<a href="/">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg">
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
				<p>Our organic certified macadamia nuts are groun and hand picked with care in quiet Franklin suburb.
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

				<img src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_shelled.png">

			</div>

			<div class="col-md-6 right">
				<div class="product">
					<img src="<?php echo get_template_directory_uri(); ?>/images/img-macadamiaNut_pouch.png"/>
					<div class="control">
						<div class="first-row">
							<div class="add">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icon-add.svg">
							</div>
							<input value="1" type="text"/>
							<div class="remove">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icon-remove.svg">
							</div>
						</div>
						<div class="second-row">
							<button type="button" class="btn btn-success">Add to cart</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
