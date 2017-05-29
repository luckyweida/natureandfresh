<?php
$count = 0;

$display_sum = WC()->cart->get_cart_total();

global $woocommerce;
$items = $woocommerce->cart->get_cart();
foreach ($items as $item) {
    $count += $item['quantity'];
}

$classes = get_body_class();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php wp_title(); ?></title>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/develop.css?v=3.6" type="text/css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
</head>
<body <?php body_class(); ?>>

    <div class="preload-loading">
        <div class="loading-widgets">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" />
            <input type="text" value="0" class="dial" autocomplete="off">
        </div>
    </div>
    <div class="preload-content">
    </div>

    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body js-add-cart-info"></div>
                <div class="modal-footer js-cart-dismiss" style="display: none;">
                    <button type="button" class="btn btn-sm btn-option" onclick="location.href='/cart/'">View cart</button>
                    <button type="button" class="btn btn-sm" data-dismiss="modal">keep shopping</button>
                </div>
            </div>
        </div>
    </div>

    <section class="container">
        <header class="row header-nav">
            <nav class="main-nav col-md-4 col-xs-4">
                <a id="nav-icon1" href="javascript:void(0)" class="closebtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>

                <a id="nav-menu" href="#" class="menu">
                    menu
                </a>

                <a class="hidden-xs <?php if (in_array('page-template-shop', $classes) || in_array('single-product', $classes)) { ?>active<?php } ?>" href="<?php echo get_site_url(); ?>/shop" title="shop">shop</a>
            </nav>

            <a id="logo" class="col-md-4 col-xs-4"  href="/" title="Nature & Fresh">
                <img src="http://placehold.it/16x16/FEFBF3/FEFBF3" data-src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="Nature and Fresh">
            </a>

            <div class="right-menu-item col-md-4 col-xs-4">

                <div class="right-menu-item_account">

                    <?php if (is_user_logged_in()) { ?>
                    <a title="my account"  class="dropdown-toggle" data-toggle="dropdown" id="account-manage" >
                        <?php global $current_user;
                              get_currentuserinfo();

                              echo 'welcome, ' . $current_user->user_login . "\n";
                              //echo 'User email: ' . $current_user->user_email . "\n";
                             // echo 'User level: ' . $current_user->user_level . "\n";
                              //echo 'User first name: ' . $current_user->user_firstname . "\n";
                              //echo 'User last name: ' . $current_user->user_lastname . "\n";
                              //echo 'User display name: ' . $current_user->display_name . "\n";
                              //echo 'User ID: ' . $current_user->ID . "\n";
                        ?>

                    </a>
                    <nav id="account-manage-drop" class="account-drop dropdown-menu dropdown-menu-left"  aria-labelledby="account-manage">
                        
                        <ul>
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
                                <a href="<?php echo get_site_url(); ?>/my-account/">Dashboard</a>
                            </li>
                            
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--orders">
                                <a href="<?php echo get_site_url(); ?>/my-account/orders/">Orders</a>
                            </li>
                            <!--
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-address is-active">
                                <a href="<?php echo get_site_url(); ?>/my-account/edit-address/">Addresses</a>
                            </li>
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--edit-account">
                                <a href="<?php echo get_site_url(); ?>/my-account/edit-account/">Account Details</a>
                            </li>
                            -->
                            <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--customer-logout">
                                <a href="<?php echo get_site_url(); ?>/my-account/customer-logout/">Logout</a>
                            </li>
                        </ul>
                    </nav>

                    <?php } else { ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" title="sign in" id="signin">
                        sign in
                        <!-- <span class="caret"></span> -->
                    </a>
                    <div id="account-drop" class="dropdown-menu dropdown-menu-right"  aria-labelledby="signin">

                        <form method="post" class="login">

                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <div class="form-group">
                                <!-- <label for="username"><?php// _e( 'Username/ email address', 'woocommerce' ); ?> <span class="required">*</span></label> -->
                                <input placeholder="Enter username or email address" type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                            </div>
                            <div class="form-group">
                                <!--  <label for="password"><?php //_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> -->
                                <input placeholder="Enter password" class="form-control" type="password" name="password" id="password" />
                            </div>

                            <?php do_action( 'woocommerce_login_form' ); ?>

                            <div class="form-group">
                                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                <input type="submit" class="btn btn-sm w-100" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                                    <!-- <label class="form-check-label">
                                    <input id="rememberme" class="form-check-input" name="rememberme" type="checkbox" value="forever"> <?php //_e( 'Remember me', 'woocommerce' ); ?>
                                </label> -->
                            </div>

                            <footer class="form-group woocommerce-LostPassword lost_password">
                                <a href="/registration/" title="signup">
                                    New here? Sign up
                                </a>
                                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>

                            </footer>

                            <?php do_action( 'woocommerce_login_form_end' ); ?>

                        </form>


                        <!-- Comment out for now, recompiled to boostrap style -->
                            <!-- <form method="post" class="login">

                            <?php //do_action( 'woocommerce_login_form_start' ); ?>

                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                <label for="username"><?php //_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php //if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                            </p>
                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                <label for="password"><?php //_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                            </p>

                            <?php //do_action( 'woocommerce_login_form' ); ?>

                            <p class="form-row">
                                <?php //wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                <input type="submit" class="woocommerce-Button button" name="login" value="<?php //esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                                <label for="rememberme" class="inline">
                                    <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php //_e( 'Remember me', 'woocommerce' ); ?>
                                </label>
                            </p>
                            <p class="woocommerce-LostPassword lost_password">
                                <a href="<?php //echo esc_url( wp_lostpassword_url() ); ?>"><?php //_e( 'Lost your password?', 'woocommerce' ); ?></a>
                            </p>

                            <?php //do_action( 'woocommerce_login_form_end' ); ?>

                        </form> -->
                    </div>
                    <?php } ?>
                </div>
                <div class="right-menu-item_cart">
                    <a class="dropdown" data-toggle="dropdown" title="cart">
                        cart
                        <small>(<?php echo $count; ?>)</small>
                    </a>

                    <?php if (!in_array('woocommerce-cart', $classes)) { ?>
                    <div id="cart-drop" class="dropdown-menu dropdown-menu-right">

                        <?php if (count(WC()->cart->get_cart())) { ?>

                        <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" class="js-dropdown-cart-form">

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
                                    <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="icon-x" title="%s" data-product_id="%s" data-product_sku="%s"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                    __( 'Remove this item', 'woocommerce' ), esc_attr( $product_id ), esc_attr( $_product->get_sku() ) ), $cart_item_key ); ?>
                                </div>
                            </div>
                            <?php }  } do_action( 'woocommerce_cart_contents' ); ?>

                            <footer class="cart-drop_item">
                                <div class="cart-drop__subtotal">
                                    <span>Subtotal</span>
                                    <span class="cartdrop___subtotalPrice"><?php echo $display_sum; ?></span>
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
                        <div class="empty-cart text-center">
                           <p>Opps, your cart is empty.</p>
                           <a class="btn btn-sm" href="<?php echo get_site_url(); ?>/shop/" title="Go to shop page">Let's shop!</a>
                        </div>
                        <?php } ?>

                    </div><!-- End .cart-drop -->
                    <?php } ?>
                </div>
            </div>
        </header>

        <!--overlay-menu-->
        <div id="overlay-menu" class="overlay-menu">
            <div class="container">
                <div class="row">
                    <nav class="col-sm-4">
                        <a class="menu-item <?php if (in_array('page-template-shop', $classes) || in_array('single-product', $classes)) { ?>active<?php } ?>" href="<?php echo get_site_url(); ?>/shop/">shop</a>
                        <a class="menu-item <?php if (in_array('page-template-about', $classes)) { ?>active<?php } ?>" href="/about/">about</a>
                        <a class="menu-item <?php if (in_array('page-template-the-photo', $classes)) { ?>active<?php } ?>" href="/the-photo/">the photo</a>
                        <!--
                        <a class="menu-item <?php if (in_array('page-template-wholesale', $classes)) { ?>active<?php } ?>" href="/wholesale/">wholesale</a>
                        -->
                        <a class="menu-item <?php if (in_array('page-template-get-in-touch', $classes)) { ?>active<?php } ?>" href="/get-in-touch/">get in touch</a>
                    </nav>
                    <div class="col-md-6 hidden-xs" id="instafeed"></div>
                    <div class="col-md-2 overlay-menu_facebook">
                        <div class="row">
                            <div class="col-xs-12">
                                <a class="fb" target="_blank" href="https://www.facebook.com/Nature-Fresh-409725865782785/?fref=ts">
                                    <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/ft_facebook.svg">
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <a class="insta" target="_blank" href="https://www.instagram.com/natureandfresh/">
                                    <img class="svg" src="<?php echo get_template_directory_uri(); ?>/images/icon-instagram.svg">
                                </a>
                            </div>
                        </div>


                        
                    </div>
                </div>
            </div>
        </div><!--Ends overlay-menu-->
    </section>
    <section class="content">