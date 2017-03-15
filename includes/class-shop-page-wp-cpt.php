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
					'name'               => __( 'Shop Page WP' ),
					'singular_name'      => __( 'Shop Page WP' ),
					'add_new'            => __( 'Add New Product' ),
					'add_new_item'       => __( 'Add New Product' ),
					'edit_item'          => __( 'Edit Product' ),
					'new_item'           => __( 'New Product' ),
					'all_items'          => __( 'All Products' ),
					'view_item'          => __( 'View Product' ),
					'search_items'       => __( 'Search Products' ),
					'not_found'          => __( 'No Products found' ),
					'not_found_in_trash' => __( 'No Product found in Trash' ),
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