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
            <div class="dropdown right-menu-item">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    cart
                    <small>(<?php echo $count; ?>)</small>
                    <span class="caret"></span>
                </div>
                <div class="cart-drop dropdown-menu" style="width: 30em;">
                    <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

                        <?php do_action( 'woocommerce_before_cart_table' ); ?>

                        <div class="" cellspacing="0">

                            <?php
                            do_action( 'woocommerce_before_cart_contents' );

                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    ?>
                                    <div class="row">



                                        <div class="col-md-3">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo $thumbnail;
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                            }
                                            ?>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
                                                } else {
                                                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
                                                }

                                                // Meta data
                                                echo WC()->cart->get_item_data( $cart_item );
                                                ?>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                    } else {
                                                        $product_quantity = woocommerce_quantity_input( array(
                                                            'input_name'  => "cart[{$cart_item_key}][qty]",
                                                            'input_value' => $cart_item['quantity'],
                                                            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                            'min_value'   => '0'
                                                        ), $_product, false );
                                                    }

                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                                    ?>
                                                </div>

                                                <div class="col-md-9  product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
                                                    x <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <?php
                                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                                '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                                __( 'Remove this item', 'woocommerce' ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ), $cart_item_key );
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            do_action( 'woocommerce_cart_contents' );

                            ?>

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/cart/">View Cart</a>
                                </div>

                                <div class="col-md-3 col-md-offset-6">
                                    <input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Checkout', 'woocommerce' ); ?>" />
                                </div>
                            </div>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>

                            <?php wp_nonce_field( 'woocommerce-cart' ); ?>
                        </div>
                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>

                        <?php do_action( 'woocommerce_after_cart_table' ); ?>

                    </form>
                </div>


            </div>
            <div class="dropdown right-menu-item">
                <?php if (is_user_logged_in()) { ?>
                    <a href="/my-account/">My Account</a>


                <?php } else { ?>
                    <div class="dropdown-toggle" data-toggle="dropdown">
                        sign in
                        <span class="caret"></span>
                    </div>
                    <div class="cart-drop dropdown-menu" style="width: 30em;">
                        <form method="post" class="login">

                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                            </p>
                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                            </p>

                            <?php do_action( 'woocommerce_login_form' ); ?>

                            <p class="form-row">
                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                <input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                                <label for="rememberme" class="inline">
                                    <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
                                </label>
                            </p>
                            <p class="woocommerce-LostPassword lost_password">
                                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
                            </p>

                            <?php do_action( 'woocommerce_login_form_end' ); ?>

                        </form>
                    </div>
                <?php } ?>
            </div>
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