<?php
$count = 0;

global $woocommerce;
$items = $woocommerce->cart->get_cart();
foreach ($items as $item) {
    $count += $item['quantity'];
}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Nature &amp; Fresh</title>
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

<!--	<title>--><?php //wp_title( '|', true, 'right' ); ?><!--</title>-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.theme.default.min.css" />
    
    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/develop.css?v=3.5" type="text/css"/>

</head>
<body>

<div class="preload-loading">
    <div class="loading-widgets">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" />
        <input type="text" value="0" class="dial" autocomplete="off">
    </div>
</div>
<div class="preload-content">
</div>


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
            <img src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="Nature and Fresh">
        </a>

        <div class="menu-account col-md-4 col-xs-4">
            <a href="/sign-in">sign in</a>

            <a href="/cart">cart
                <small>(<?php echo $count; ?>)</small>
            </a>
        </div>
    </header>

    <!--overlay-menu-->
    <div id="overlay-menu" class="overlay-menu">
        <div class="container">
            <div class="row">
                <nav class="col-sm-4">
                    <a class="menu-item" href="#">shop</a>
                    <a class="menu-item" href="#">about</a>
                    <a class="menu-item" href="#">the photo</a>
                    <a class="menu-item" href="#">wholesale</a>
                    <a class="menu-item" href="#">get in touch</a>
                </nav>
                <div class="col-md-6 hidden-xs" id="instafeed"></div>
                <div class="col-md-2 overlay-menu_facebook">
                    <a target="_blank" href="https://www.facebook.com/Nature-Fresh-409725865782785/?fref=ts">
                        <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/ft_facebook.svg">
                    </a>
                </div>
            </div>
        </div>
    </div><!--Ends overlay-menu-->
</section>
<section class="content">