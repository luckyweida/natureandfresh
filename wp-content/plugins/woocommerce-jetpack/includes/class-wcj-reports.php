<?php
/**
 * Booster for WooCommerce - Module - Reports
 *
 * @version 2.8.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCJ_Reports' ) ) :

class WCJ_Reports extends WCJ_Module {

	/** @var string Report ID. */
	public $report_id;

	/** @var int Stock reports - range in days. */
	public $range_days;

	/** @var string: yes/no Customers reports - group countries. */
	public $group_countries;

	/**
	 * Constructor.
	 *
	 * @version 2.8.0
	 */
	function __construct() {

		$this->id         = 'reports';
		$this->short_desc = __( 'Reports', 'woocommerce-jetpack' );
		$this->desc       = __( 'WooCommerce stock, sales, customers etc. reports.', 'woocommerce-jetpack' );
		$this->link_slug  = 'woocommerce-reports';
		parent::__construct();

		if ( $this->is_enabled() ) {
			if ( is_admin() ) {

				add_filter( 'woocommerce_admin_reports', array( $this, 'add_customers_by_country_report' ) );
				add_filter( 'woocommerce_admin_reports', array( $this, 'add_stock_reports' ) );
				add_filter( 'woocommerce_admin_reports', array( $this, 'add_sales_reports' ) );
				add_action( 'init',                      array( $this, 'catch_arguments' ) );

				include_once( 'reports/wcj-class-reports-customers.php' );
				include_once( 'reports/wcj-class-reports-stock.php' );
				include_once( 'reports/wcj-class-reports-sales.php' );
				include_once( 'reports/wcj-class-reports-monthly-sales.php' );

				add_action( 'admin_bar_menu', array( $this, 'add_custom_order_reports_ranges_to_admin_bar' ), PHP_INT_MAX );
				add_action( 'admin_bar_menu', array( $this, 'add_custom_order_reports_ranges_by_month_to_admin_bar' ), PHP_INT_MAX );
			}
		}
	}

	/**
	 * add_custom_order_reports_ranges_by_month_to_admin_bar.
	 *
	 * @version 2.7.0
	 * @since   2.2.4
	 */
	function add_custom_order_reports_ranges_by_month_to_admin_bar( $wp_admin_bar ) {
		$is_reports        = ( isset( $_GET['page'] ) && 'wc-reports' === $_GET['page'] );
		$is_orders_reports = ( isset( $_GET['tab'] )  && 'orders'     === $_GET['tab'] || ! isset( $_GET['tab'] ) );
		if ( $is_reports && $is_orders_reports ) {

			$parent = 'reports_orders_more_ranges_months';
			$args = array(
				'parent' => false,
				'id'     => $parent,
				'title'  => __( 'Booster: More Ranges - Months', 'woocommerce-jetpack' ),
				'href'   => false,
				'meta'   => array( 'title' => __( 'Select Range', 'woocommerce-jetpack' ) ),
			);
			$wp_admin_bar->add_node( $args );

			$custom_range_nonce = wp_create_nonce( 'custom_range' );
			for ( $i = 1; $i <= 12; $i++ ) {
				$month_start_date = date( 'Y-m-01' ) . "-$i months";
				$month_num  = date( 'm',      strtotime( $month_start_date ) );
				$month_name = date( 'Y F',    strtotime( $month_start_date ) );
				$start_date = date( 'Y-m-01', strtotime( $month_start_date ) );
				$end_date   = date( 'Y-m-t',  strtotime( $month_start_date ) );
				$node = array(
					'parent' => $parent,
					'id'     => $parent . '_' . $month_num,
					'title'  => $month_name,
					'href'   => add_query_arg( array(
						'range'            => 'custom',
						'start_date'       => $start_date,
						'end_date'         => $end_date,
						'wc_reports_nonce' => $custom_range_nonce,
					) ),
					'meta'   => array( 'title' => $month_name ),
				);
				$wp_admin_bar->add_node( $node );
			}
		}
	}

	/**
	 * add_custom_order_reports_ranges_to_admin_bar.
	 *
	 * @version 2.8.0
	 */
	function add_custom_order_reports_ranges_to_admin_bar( $wp_admin_bar ) {
		$is_reports        = ( isset( $_GET['page'] ) && 'wc-reports' === $_GET['page'] );
		$is_orders_reports = ( isset( $_GET['tab'] )  && 'orders'     === $_GET['tab'] || ! isset( $_GET['tab'] ) );
		if ( $is_reports && $is_orders_reports ) {

			$parent = 'reports_orders_more_ranges';
			$args = array(
				'parent' => false,
				'id'     => $parent,
				'title'  => __( 'Booster: More Ranges', 'woocommerce-jetpack' ),
				'href'   => false,
				'meta'   => array( 'title' => __( 'Select Range', 'woocommerce-jetpack' ) ),
			);
			$wp_admin_bar->add_node( $args );

			$custom_ranges = array(
				'last_14_days' => array(
					'title'      => __( 'Last 14 Days', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-14 days' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_30_days' => array(
					'title'      => __( 'Last 30 Days', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-30 days' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_3_months' => array(
					'title'      => __( 'Last 3 Months', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-3 months' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_6_months' => array(
					'title'      => __( 'Last 6 Months', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-6 months' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_12_months' => array(
					'title'      => __( 'Last 12 Months', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-12 months' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_24_months' => array(
					'title'      => __( 'Last 24 Months', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-24 months' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'last_36_months' => array(
					'title'      => __( 'Last 36 Months', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( '-36 months' ) ),
					'end_date'   => date( 'Y-m-d' ),
				),
				'same_days_last_month' => array(
					'title'      => __( 'Same Days Last Month', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-01', strtotime( '-1 month' ) ),
					'end_date'   => date( 'Y-m-d', strtotime( '-1 month' ) ),
				),
				'same_days_last_year' => array(
					'title'      => __( 'Same Days Last Year', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-01', strtotime( '-1 year' ) ),
					'end_date'   => date( 'Y-m-d', strtotime( '-1 year' ) ),
				),
				'last_year' => array(
					'title'      => __( 'Last Year', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-01-01', strtotime( '-1 year' ) ),
					'end_date'   => date( 'Y-12-31', strtotime( '-1 year' ) ),
				),
				/* 'last_week' => array(
					'title'      => __( 'Last Week', 'woocommerce-jetpack' ),
					'start_date' => date( 'Y-m-d', strtotime( 'last monday' ) ),
					'end_date'   => date( 'Y-m-d', strtotime( 'last sunday' ) ),
				), */
			);
			$custom_range_nonce = wp_create_nonce( 'custom_range' );
			foreach ( $custom_ranges as $custom_range_id => $custom_range ) {
				$node = array(
					'parent' => $parent,
					'id'     => $parent . '_' . $custom_range_id,
					'title'  => $custom_range['title'],
					'href'   => add_query_arg( array(
						'range'            => 'custom',
						'start_date'       => $custom_range['start_date'],
						'end_date'         => $custom_range['end_date'],
						'wc_reports_nonce' => $custom_range_nonce,
					) ),
					'meta'   => array( 'title' => $custom_range['title'] ),
				);
				$wp_admin_bar->add_node( $node );
			}
		}
	}

	/**
	 * catch_arguments.
	 */
	function catch_arguments() {
		$this->report_id       = isset( $_GET['report'] )                             ? $_GET['report'] : 'on_stock';
		$this->range_days      = isset( $_GET['period'] )                             ? $_GET['period'] : 30;
		$this->group_countries = ( 'customers_by_country_sets' === $this->report_id ) ? 'yes'           : 'no';
	}

	/**
	 * get_report_sales.
	 */
	function get_report_sales() {
		$report = new WCJ_Reports_Sales();
		echo $report->get_report();
	}

	/**
	 * get_report_monthly_sales.
	 * @version 2.4.7
	 * @since   2.4.7
	 */
	function get_report_monthly_sales() {
		$report = new WCJ_Reports_Monthly_Sales();
		echo $report->get_report();
	}

	/**
	 * get_report_stock.
	 */
	function get_report_stock() {
		$report = new WCJ_Reports_Stock( array (
			'report_id'  => $this->report_id,
			'range_days' => $this->range_days,
		) );
		echo $report->get_report_html();
	}

	/**
	 * get_report_customers.
	 */
	function get_report_customers() {
		$report = new WCJ_Reports_Customers( array ( 'group_countries' => $this->group_countries ) );
		echo $report->get_report();
	}

	/**
	 * Add reports to WooCommerce > Reports > Sales
	 *
	 * @version 2.5.3
	 * @since   2.3.0
	 */
	function add_sales_reports( $reports ) {

		$reports['orders']['reports']['booster_products_sales'] = array(
			'title'       => __( 'Booster: Product Sales', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => false,
			'callback'    => array( $this, 'get_report_sales' ),
		);

		$reports['orders']['reports']['booster_monthly_sales'] = array(
			'title'       => __( 'Booster: Monthly Sales', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => false,
			'callback'    => array( $this, 'get_report_monthly_sales' ),
		);

		return $reports;
	}

	/**
	 * Add reports to WooCommerce > Reports > Stock
	 */
	function add_stock_reports( $reports ) {

		$reports['stock']['reports']['on_stock'] = array(
			'title'       => __( 'Booster: All in stock', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_report_stock' ),
		);

		$reports['stock']['reports']['understocked'] = array(
			'title'       => __( 'Booster: Understocked', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_report_stock' ),
		);

		$reports['stock']['reports']['overstocked'] = array(
			'title'       => __( 'Booster: Overstocked', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_report_stock' ),
		);

		return $reports;
	}

	/**
	 * Add reports to WooCommerce > Reports > Customers
	 */
	function add_customers_by_country_report( $reports ) {

		$reports['customers']['reports']['customers_by_country'] = array(
			'title'       => __( 'Booster: Customers by Country', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_report_customers' ),
		);

		$reports['customers']['reports']['customers_by_country_sets'] = array(
			'title'       => __( 'Booster: Customers by Country Sets', 'woocommerce-jetpack' ),
			'description' => '',
			'hide_title'  => true,
			'callback'    => array( $this, 'get_report_customers' ),
		);

		return $reports;
	}

}

endif;

return new WCJ_Reports();
