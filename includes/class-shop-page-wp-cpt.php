<?php

/**
 * Class Shop_Page_WP_CPT
 */
class Shop_Page_WP_CPT {

	public static function register_post_types() {

		self::create_post_type();
	}

	/**
	 * Static Function create_post_type
	 */
	public static function create_post_type() {

		register_post_type( 'shop-page-wp',

			array(
				'menu_position'       => 4,
				'exclude_from_search' => false,
				'labels'              => array(
					'name'               => esc_html__( 'Shop Page WP' ),
					'singular_name'      => esc_html__( 'Shop Page WP' ),
					'add_new'            => esc_html__( 'Add New Product' ),
					'add_new_item'       => esc_html__( 'Add New Product' ),
					'edit_item'          => esc_html__( 'Edit Product' ),
					'new_item'           => esc_html__( 'New Product' ),
					'all_items'          => esc_html__( 'All Products' ),
					'view_item'          => esc_html__( 'View Product' ),
					'search_items'       => esc_html__( 'Search Products' ),
					'not_found'          => esc_html__( 'No Products found' ),
					'not_found_in_trash' => esc_html__( 'No Product found in Trash' ),
					'parent_item_colon'  => '',
					'menu_name'          => 'Shop Page WP'
				),
				'public'              => true,
				'publicly_queryable'  => false,
				'menu_icon'           => 'dashicons-cart',
				'_builtin'            => false,
				'rewrite'             => array( 'slug' => 'shop-page' ),
				'has_archive'         => true,
				'supports'            => array( 'title', 'thumbnail' ),
				'taxonomies'          => array( 'category' )
			)
		);
	}
}