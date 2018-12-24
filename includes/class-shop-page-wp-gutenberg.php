<?php

/**
 * Class Shop_Page_WP_Gutenberg
 */
class Shop_Page_WP_Gutenberg {

	public static function gutenberg_init() {

		$plugin_dir = plugin_dir_url( __FILE__ );

	    wp_register_script( 'shop-page-wp-gutenberg-script', $plugin_dir . '../assets/blocks/shop-page-wp-block-build.js', array('wp-blocks', 'wp-element', 'wp-editor'));

	    wp_register_style( 'shop-page-wp-gutenberg-styles', $plugin_dir . '../assets/css/shop-page-wp-gutenberg-admin.css',  array('wp-edit-blocks') );

	    register_block_type( 'shop-page-wp/grid', array(
	        'editor_script' => 'shop-page-wp-gutenberg-script',
	        'editor_style'  => 'shop-page-wp-gutenberg-styles',
			'render_callback' => array(__CLASS__, 'shop_page_wp_output_grid'),
	    ) );
	}

	public static function shop_page_wp_output_grid( $attr ) {

		if (! isset($attr['grid'])) {
			$attr['grid'] = 1;
		}

		$grid_content = Shop_Page_WP_Grid::return_grid( $attr );

		return $grid_content;
	}
}
