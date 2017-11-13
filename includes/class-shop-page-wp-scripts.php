<?php

/**
 * Class Shop_Page_WP_Scripts
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
			Shop_Page_WP_Version
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
			Shop_Page_WP_Version
		);
		wp_enqueue_style( 'shop-page-wp-base-styles' );
	}

	static function hook_admin_styles() {

		add_action( 'admin_enqueue_scripts', array( 'Shop_Page_WP_Scripts', 'enqueue_admin_styles' ) );
	}

	static function enqueue_admin_styles() {
		$plugin_dir = plugin_dir_url( __FILE__ );
		wp_register_style(
			'shop-page-wp-admin-styles',
			$plugin_dir . '../assets/css/shop-page-wp-admin-styles.css',
			'',
			''
		);
		wp_enqueue_style( 'shop-page-wp-admin-styles' );
	}
}
