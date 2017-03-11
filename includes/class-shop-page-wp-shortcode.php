<?php

require plugin_dir_path( __FILE__ ) . 'class-shop-page-wp-grid.php';

/**
 * Class Shop_Page_WP_Shortcode
 */
class Shop_Page_WP_Shortcode {

	/**
	 * Link grid to 'add_shortcode' function
	 */
	static function activate_shortcode() {

		add_shortcode( 'shop-page-wp', array( new Self(), 'shortcode_attributes' ) );
	}

	public function shortcode_attributes( $atts ) {

		$attributes = shortcode_atts( array(
			'category' => '',
			'grid'     => ''
		), $atts );

		$grid_content = Shop_Page_WP_Grid::return_grid( $attributes );

		return $grid_content;
	}
}
