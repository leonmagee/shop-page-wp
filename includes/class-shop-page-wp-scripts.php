<?php

/**
 * Class Shop_Page_WP_Scripts
 *
 * If no styles are selected by admin choice then these styles do not need to be enqueued.
 * @todo do these show up on all pages when active? since this uses a shortcode it's prob hard to stop
 */
class Shop_Page_WP_Scripts {
	static function hook_grid_styles() {
		
		add_action( 'wp_enqueue_scripts', array( 'Shop_Page_WP_Scripts', 'enqueue_grid_styles' ) );
	}

	static function enqueue_grid_styles() {
		$plugin_dir = plugin_dir_url( __FILE__ );
		wp_register_style(
			'shop-page-wp-grid',
			$plugin_dir . '../assets/css/shop-page-wp-grid.css',
			'',
			''
		);
		wp_enqueue_style( 'shop-page-wp-grid' );
	}

	static function hook_base_styles() {

		add_action( 'wp_enqueue_scripts', array( 'Shop_Page_WP_Scripts', 'enqueue_base_styles' ) );
	}

	static function enqueue_base_styles() {
		$plugin_dir = plugin_dir_url( __FILE__ );
		wp_register_style(
			'shop-page-wp-base-styles',
			$plugin_dir . '../assets/css/shop-page-wp-base-styles.css',
			'',
			''
		);
		wp_enqueue_style( 'shop-page-wp-base-styles' );
	}
}