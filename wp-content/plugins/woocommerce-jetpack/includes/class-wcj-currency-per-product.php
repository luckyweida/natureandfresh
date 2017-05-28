<?php
/**
 * Booster for WooCommerce - Module - Currency per Product
 *
 * @version 2.8.0
 * @since   2.5.2
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WCJ_Currency_Per_Product' ) ) :

class WCJ_Currency_Per_Product extends WCJ_Module {

	/**
	 * Constructor.
	 *
	 * @version 2.8.0
	 * @since   2.5.2
	 */
	function __construct() {

		$this->id         = 'currency_per_product';
		$this->short_desc = __( 'Currency per Product', 'woocommerce-jetpack' );
		$this->desc       = __( 'Display prices for WooCommerce products in different currencies.', 'woocommerce-jetpack' );
		$this->link_slug  = 'woocommerce-currency-per-product';
		parent::__construct();

		if ( $this->is_enabled() ) {

			add_action( 'add_meta_boxes',    array( $this, 'add_meta_box' ) );
			add_action( 'save_post_product', array( $this, 'save_meta_box' ), PHP_INT_MAX, 2 );

			//if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

				// Currency code and symbol
				add_filter( 'woocommerce_currency_symbol',                array( $this, 'change_currency_symbol' ),     PHP_INT_MAX, 2 );
				add_filter( 'woocommerce_currency',                       array( $this, 'change_currency_code' ),       PHP_INT_MAX );

				// Add to cart
				add_filter( 'woocommerce_add_cart_item_data',             array( $this, 'add_cart_item_data' ),         PHP_INT_MAX, 3 );
				add_filter( 'woocommerce_add_cart_item',                  array( $this, 'add_cart_item' ),              PHP_INT_MAX, 2 );
				add_filter( 'woocommerce_get_cart_item_from_session',     array( $this, 'get_cart_item_from_session' ), PHP_INT_MAX, 3 );
				add_filter( 'woocommerce_add_to_cart_validation',         array( $this, 'validate_on_add_to_cart' ),    PHP_INT_MAX, 2 );

				// Price
				add_filter( WCJ_PRODUCT_GET_PRICE_FILTER,                 array( $this, 'change_price' ),               PHP_INT_MAX, 2 );
				add_filter( 'woocommerce_product_variation_get_price',    array( $this, 'change_price' ),               PHP_INT_MAX, 2 );

				// Grouped
				add_filter( 'woocommerce_grouped_price_html',             array( $this, 'grouped_price_html' ),         PHP_INT_MAX, 2 );

				// Shipping
				add_filter( 'woocommerce_package_rates',                  array( $this, 'change_shipping_price' ),      PHP_INT_MAX, 2 );

			//}
		}
	}

	/**
	 * change_shipping_price.
	 *
	 * @version 2.7.0
	 * @since   2.7.0
	 */
	function change_shipping_price( $package_rates, $package ) {
		if ( $this->is_cart_or_checkout_or_ajax() ) {
			if ( WC()->cart->is_empty() ) {
				return $package_rates;
			}
			$cart_checkout_behaviour = get_option( 'wcj_currency_per_product_cart_checkout', 'convert_shop_default' );
			switch ( $cart_checkout_behaviour ) {
				case 'leave_one_product':
				case 'leave_same_currency':
				case 'convert_first_product':
				case 'convert_last_product':
					$shop_currency = get_option( 'woocommerce_currency' );
					if ( false != ( $_currency = $this->get_cart_checkout_currency() ) && $_currency != $shop_currency ) {
						$currency_exchange_rate = $this->get_currency_exchange_rate( $_currency );
						if ( 0 != $currency_exchange_rate && 1 != $currency_exchange_rate ) {
							$currency_exchange_rate = 1 / $currency_exchange_rate;
							$modified_package_rates = array();
							foreach ( $package_rates as $id => $package_rate ) {
								if ( isset( $package_rate->cost ) ) {
									$package_rate->cost = $package_rate->cost * $currency_exchange_rate;
									if ( isset( $package_rate->taxes ) && ! empty( $package_rate->taxes ) ) {
										foreach ( $package_rate->taxes as $tax_id => $tax ) {
											$package_rate->taxes[ $tax_id ] = $package_rate->taxes[ $tax_id ] * $currency_exchange_rate;
										}
									}
								}
								$modified_package_rates[ $id ] = $package_rate;
							}
							return $modified_package_rates;
						} else {
							return $package_rates;
						}
					} else {
						return $package_rates;
					}
				default: // case 'convert_shop_default':
					return $package_rates;
			}
		}
		return $package_rates;
	}

	/**
	 * validate_on_add_to_cart.
	 *
	 * @version 2.7.0
	 * @since   2.7.0
	 */
	function validate_on_add_to_cart( $passed, $product_id ) {
		$cart_checkout_behaviour = get_option( 'wcj_currency_per_product_cart_checkout', 'convert_shop_default' );
		if ( 'leave_one_product' === $cart_checkout_behaviour ) {
			foreach ( WC()->cart->get_cart() as $cart_item ) {
				if ( $cart_item['product_id'] != $product_id ) {
					wc_add_notice( get_option( 'wcj_currency_per_product_cart_checkout_leave_one_product',
						__( 'Only one product can be added to the cart. Clear the cart or finish the order, before adding another product to the cart.', 'woocommerce-jetpack' ) ), 'error' );
					return false;
				}
			}
		} elseif ( 'leave_same_currency' === $cart_checkout_behaviour ) {
			$shop_currency = get_option( 'woocommerce_currency' );
			$product_currency = get_post_meta( $product_id, '_' . 'wcj_currency_per_product_currency', true );
			if ( '' == $product_currency ) {
				$product_currency = $shop_currency;
			}
			foreach ( WC()->cart->get_cart() as $cart_item ) {
				$cart_product_currency = ( isset( $cart_item['wcj_currency_per_product'] ) && '' != $cart_item['wcj_currency_per_product'] ) ?
					$cart_item['wcj_currency_per_product'] : $shop_currency;
				if ( $cart_product_currency != $product_currency ) {
					wc_add_notice( get_option( 'wcj_currency_per_product_cart_checkout_leave_same_currency',
						__( 'Only products with same currency can be added to the cart. Clear the cart or finish the order, before adding products with another currency to the cart.', 'woocommerce-jetpack' ) ), 'error' );
					return false;
				}
			}
		}
		return $passed;
	}

	/**
	 * grouped_price_html.
	 *
	 * @version 2.7.0
	 * @since   2.5.2
	 */
	function grouped_price_html( $price_html, $_product ) {
		$child_prices = array();
		foreach ( $_product->get_children() as $child_id ) {
			$child_prices[ $child_id ] = get_post_meta( $child_id, '_price', true );
		}
//		$child_prices = array_unique( $child_prices );
		if ( ! empty( $child_prices ) ) {
			/*
			$min_price = min( $child_prices );
			$max_price = max( $child_prices );
			$min_price_id = min( array_keys( $child_prices, min( $child_prices ) ) );
			$max_price_id = max( array_keys( $child_prices, max( $child_prices ) ) );
			*/
			asort( $child_prices );
			$min_price = current( $child_prices );
			$min_price_id = key( $child_prices );
			end( $child_prices );
			$max_price = current( $child_prices );
			$max_price_id = key( $child_prices );
			$min_currency_per_product_currency = get_post_meta( $min_price_id, '_' . 'wcj_currency_per_product_currency', true );
			$max_currency_per_product_currency = get_post_meta( $max_price_id, '_' . 'wcj_currency_per_product_currency', true );
		} else {
			$min_price = '';
			$max_price = '';
		}

		if ( $min_price ) {
			if ( $min_price == $max_price && $min_currency_per_product_currency === $max_currency_per_product_currency ) {
				$display_price = wc_price( wcj_get_product_display_price( $_product, $min_price, 1 ), array( 'currency' => $min_currency_per_product_currency ) );
			} else {
				$from          = wc_price( wcj_get_product_display_price( $_product, $min_price, 1 ), array( 'currency' => $min_currency_per_product_currency ) );
				$to            = wc_price( wcj_get_product_display_price( $_product, $max_price, 1 ), array( 'currency' => $max_currency_per_product_currency ) );
				$display_price = sprintf( _x( '%1$s&ndash;%2$s', 'Price range: from-to', 'woocommerce' ), $from, $to );
			}
			$new_price_html = $display_price . $_product->get_price_suffix();
			return $new_price_html;
		}

		return $price_html;
	}

	/**
	 * get_currency_exchange_rate.
	 *
	 * @version 2.5.2
	 * @since   2.5.2
	 */
	function get_currency_exchange_rate( $currency_code ) {
		$currency_exchange_rate = 1;
		$total_number = apply_filters( 'booster_get_option', 1, get_option( 'wcj_currency_per_product_total_number', 1 ) );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			if ( $currency_code === get_option( 'wcj_currency_per_product_currency_' . $i ) ) {
				$currency_exchange_rate = 1 / get_option( 'wcj_currency_per_product_exchange_rate_' . $i );
				break;
			}
		}
		return $currency_exchange_rate;
	}

	/**
	 * change_price.
	 *
	 * @version 2.7.0
	 * @since   2.5.2
	 */
	function change_price( $price, $_product ) {
		if ( isset( $_product->wcj_currency_per_product ) ) {
			$cart_checkout_behaviour = get_option( 'wcj_currency_per_product_cart_checkout', 'convert_shop_default' );
			switch ( $cart_checkout_behaviour ) {
				case 'leave_one_product':
				case 'leave_same_currency':
					return $price;
				case 'convert_first_product':
				case 'convert_last_product':
					$shop_currency = get_option('woocommerce_currency');
					if ( false != ( $_currency = $this->get_cart_checkout_currency() ) && $_currency != $shop_currency ) {
						if ( $_product->wcj_currency_per_product === $_currency ) {
							return $price;
						} else {
							$exchange_rate_product       = $this->get_currency_exchange_rate( $_product->wcj_currency_per_product );
							$exchange_rate_cart_checkout = $this->get_currency_exchange_rate( $_currency );
							$exchange_rate               = $exchange_rate_product / $exchange_rate_cart_checkout;
							return $price * $exchange_rate;
						}
					} elseif ( $_product->wcj_currency_per_product === $shop_currency ) {
						return $price;
					} else {
						$exchange_rate = $this->get_currency_exchange_rate( $_product->wcj_currency_per_product );
						return $price * $exchange_rate;
					}
				default: // case 'convert_shop_default':
					$exchange_rate = $this->get_currency_exchange_rate( $_product->wcj_currency_per_product );
					return $price * $exchange_rate;
			}
		}
		return $price;
	}

	/**
	 * get_cart_item_from_session.
	 *
	 * @version 2.5.2
	 * @since   2.5.2
	 */
	function get_cart_item_from_session( $item, $values, $key ) {
		if ( array_key_exists( 'wcj_currency_per_product', $values ) ) {
			$item['data']->wcj_currency_per_product = $values['wcj_currency_per_product'];
		}
		return $item;
	}

	/**
	 * add_cart_item_data.
	 *
	 * @version 2.5.2
	 * @since   2.5.2
	 */
	function add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		$currency_per_product_currency = get_post_meta( $product_id, '_' . 'wcj_currency_per_product_currency', true );
		if ( '' != $currency_per_product_currency ) {
			$cart_item_data['wcj_currency_per_product'] = $currency_per_product_currency;
		}
		return $cart_item_data;
	}

	/**
	 * add_cart_item.
	 *
	 * @version 2.5.2
	 * @since   2.5.2
	 */
	function add_cart_item( $cart_item_data, $cart_item_key ) {
		if ( isset( $cart_item_data['wcj_currency_per_product'] ) ) {
			$cart_item_data['data']->wcj_currency_per_product = $cart_item_data['wcj_currency_per_product'];
		}
		return $cart_item_data;
	}

	/**
	 * get_current_product_id_and_currency.
	 *
	 * @version 2.7.0
	 * @since   2.7.0
	 */
	function get_current_product_id_and_currency() {
		$the_ID = get_the_ID();
		if ( 0 == $the_ID && isset( $_REQUEST['product_id'] ) ) {
			$the_ID = $_REQUEST['product_id'];
		}
		if ( 0 == $the_ID && isset( $_POST['form'] ) ) { // WooCommerce Bookings plugin
			$posted = array();
			parse_str( $_POST['form'], $posted );
			$the_ID = isset( $posted['add-to-cart'] ) ? $posted['add-to-cart'] : 0;
		}
		if ( 0 != $the_ID && 'product' === get_post_type( $the_ID ) ) {
			$currency_per_product_currency = get_post_meta( $the_ID, '_' . 'wcj_currency_per_product_currency', true );
			return ( '' != $currency_per_product_currency ) ? $currency_per_product_currency : false;
		}
		return false;
	}

	/**
	 * get_cart_checkout_currency.
	 *
	 * @version 2.8.0
	 * @since   2.7.0
	 */
	function get_cart_checkout_currency() {
		if ( ! isset( WC()->cart ) || WC()->cart->is_empty() ) {
			return false;
		}
		$cart_checkout_behaviour = get_option( 'wcj_currency_per_product_cart_checkout', 'convert_shop_default' );
		if ( 'convert_shop_default' === $cart_checkout_behaviour ) {
			return false;
		}
		$cart_items = WC()->cart->get_cart();
		if ( 'convert_last_product' === $cart_checkout_behaviour ) {
			$cart_items = array_reverse( $cart_items );
		}
		foreach ( $cart_items as $cart_item ) {
			return ( isset( $cart_item['wcj_currency_per_product'] ) ) ? $cart_item['wcj_currency_per_product'] : false;
		}
	}

	/**
	 * is_cart_or_checkout_or_ajax.
	 *
	 * @version 2.7.0
	 * @since   2.7.0
	 * @todo    fix AJAX issue (for minicart)
	 */
	function is_cart_or_checkout_or_ajax() {
		return ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) /* || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) */ );
	}

	/**
	 * change_currency_code.
	 *
	 * @version 2.7.0
	 * @since   2.5.2
	 */
	function change_currency_code( $currency ) {
		if ( false != ( $_currency = $this->get_current_product_id_and_currency() ) ) {
			return $_currency;
		} elseif ( $this->is_cart_or_checkout_or_ajax() ) {
			return ( false != ( $_currency = $this->get_cart_checkout_currency() ) ) ? $_currency : $currency;
		}
		return  $currency;
	}

	/**
	 * change_currency_symbol.
	 *
	 * @version 2.7.0
	 * @since   2.5.2
	 */
	function change_currency_symbol( $currency_symbol, $currency ) {
		if ( false != ( $_currency = $this->get_current_product_id_and_currency() ) ) {
			return wcj_get_currency_symbol( $_currency );
		} elseif ( $this->is_cart_or_checkout_or_ajax() ) {
			return ( false != ( $_currency = $this->get_cart_checkout_currency() ) ) ? wcj_get_currency_symbol( $_currency ) : $currency_symbol;
		}
		return $currency_symbol;
	}

}

endif;

return new WCJ_Currency_Per_Product();