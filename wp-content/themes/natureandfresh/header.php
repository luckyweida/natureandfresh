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
    <title><?php //wp_title( '|', true, 'right' ); ?></title>
    <!-- <title>Nature &amp; Fresh</title> -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">


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


                <div class="right-menu-item">


                    <?php if (is_user_logged_in()) { ?>
                    <a href="/my-account/" title="my account">my account</a>
                    <?php } else { ?>

                    <a class="dropdown-toggle" data-toggle="dropdown" title="sign in">
                        sign in
                        <!-- <span class="caret"></span> -->
                    </a>
                    
                    <?php } ?>
                    <div id="cart-drop" class="dropdown-menu dropdown-menu-right">

                        <?php if (count(WC()->cart->get_cart())) { ?>

                        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

                            <?php do_action( 'woocommerce_before_cart_table' ); ?>

                            <?php do_action( 'woocommerce_before_cart_contents' );foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key ); if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) { $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );?>

                            <div class="cart-drop_item">
                                <div class="cart-drop__thumb">
                                    <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $product_permalink ) {
                                        echo $thumbnail;
                                    } else {
                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                    }
                                    ?>
                                </div>

                                <div class="cart-drop__desc">
                                    <div class="cart-drop__title" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
                                        <?php
                                        if ( ! $product_permalink ) {
                                            echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
                                        } else {
                                            echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
                                        }

                                        echo WC()->cart->get_item_data( $cart_item );
                                        ?>
                                    </div>

                                    <div class="cart-drop__desc-details">
                                        <div class="cart-drop__quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
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

                                        <div class="cart-drop__price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
                                            x <?php
                                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="cart-drop__delete">
                                    <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                    __( 'Remove this item', 'woocommerce' ), esc_attr( $product_id ), esc_attr( $_product->get_sku() ) ), $cart_item_key ); ?>
                                </div>
                            </div>
                            <?php }  } do_action( 'woocommerce_cart_contents' ); ?>

                            <footer class="cart-drop_item">
                                <div class="cart-drop__subtotal">
                                    <span>Subtotal</span>
                                    <span class="cartdrop___subtotalPrice">$1234.56</span>
                                </div>
                                <div class="cart-drop__checkout">
                                    <a class="cart-drop__viewCart" href="/cart/" title="view cart">View Cart</a>

                                    <div>
                                        <input class="btn btn-sm btn-option" type="submit" name="update_cart" value="<?php esc_attr_e( 'Update', 'woocommerce' ); ?>" />
                                        <a class="btn btn-sm" href="/checkout/" title="check out">Checkout</a>
                                    </div>
                                </div>
                                
                            </footer>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>

                            <?php wp_nonce_field( 'woocommerce-cart' ); ?>
                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>

                            <?php do_action( 'woocommerce_after_cart_table' ); ?>

                        </form>
                        <?php } else { ?>
                        <div class="empty-cart">Your cart is empty</div>
                        <?php } ?>

                    </div><!-- End .cart-drop -->

                    <a class="dropdown" data-toggle="dropdown" title="cart">
                        cart
                        <small>(<?php echo $count; ?>)</small>
                    </a>
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