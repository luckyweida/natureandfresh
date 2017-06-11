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
        $result = $client->products->get();

        $map = array();
        foreach ($result->products as $itm) {
            $map[$itm->id] = $itm;
        }

        if ( !defined('ABSPATH') )
            define('ABSPATH', dirname(__FILE__) . '/');

        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
        $user = DB_USER;
        $password = DB_PASSWORD;
        $pdo = new PDO($dsn, $user, $password);

        $sql = 'SELECT ID FROM wp_posts WHERE post_type = \'product\' AND post_status = \'publish\' ORDER BY menu_order';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        $myProducts = new stdClass();
        $myProducts->products = array();
        foreach ($data as $itm) {
            if (isset($map[$itm['ID']])) {
                $myProducts->products[] = $map[$itm['ID']];
            }
        }

//        echo "<pre>";
//        var_dump($myProducts);
//        echo "</pre>";
//        exit;

    } catch (WC_API_Client_Exception $e) {
    } catch (PDOException $e) {
    }


	// Load the theme template.
	require_once( ABSPATH . WPINC . '/template-loader.php' );

}
