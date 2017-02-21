<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once( dirname(__FILE__) . '/wp-load.php' );

	// Set up the WordPress query.
	wp();

    require_once(__DIR__ . '/wp-content/themes/natureandfresh/lib/woocommerce-api.php');
    $options = array(
        'debug' => true,
        'return_as_array' => false,
        'validate_url' => false,
        'timeout' => 300,
        'ssl_verify' => false,
    );

    try {
        $client = new WC_API_Client(PRODUCT_FEED_URL, WC_CONSUMER_KEY, WC_CONSUMER_SECRET, $options);
        $myProducts = $client->products->get();
    } catch (WC_API_Client_Exception $e) {
    }

	// Load the theme template.
	require_once( ABSPATH . WPINC . '/template-loader.php' );

}
