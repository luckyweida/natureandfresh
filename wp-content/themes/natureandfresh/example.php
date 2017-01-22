<?php
/*
Template Name: Shop
*/
?>


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

    var_dump($result);
    exit;
} catch (WC_API_Client_Exception $e) {
}
?>
