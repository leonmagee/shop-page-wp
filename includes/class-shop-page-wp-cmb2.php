<?php

/**
 * Class Shop_Page_WP_CMB2
 */
class Shop_Page_WP_CMB2 {

	public static function activate_cmb2() {

		$path = plugin_dir_path( __FILE__ );

		if ( file_exists( $path . '../vendors/cmb2/init.php' ) ) {

			require_once $path . '../vendors/cmb2/init.php';
		}

		add_action( 'cmb2_admin_init', 'Shop_Page_WP_metaboxes' );
		/**
		 * Define the metabox and field configurations.
		 */
		function Shop_Page_WP_metaboxes() {

			$prefix = '_Shop_Page_WP_';
			/**
			 * URL Meta Box
			 */
			$cmb_url = new_cmb2_box( array(
				'id'           => 'Shop_Page_WP_meta',
				'title'        => esc_html__( 'Product Details', 'cmb2' ),
				'object_types' => array( 'shop-page-wp' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );

			$cmb_url->add_field( array(
				'name' => esc_html__( 'Product Affiliate URL', 'cmb2' ),
				//'desc' => esc_html__( 'The URL for your product', 'cmb2' ),
				'id'   => $prefix . 'url',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				//'repeatable' => true,
			) );

			/**
			 * Description Meta Box
			 */
			$cmb_description = new_cmb2_box( array(
				'id'           => 'Shop_Page_WP_meta',
				'title'        => esc_html__( 'Product Description', 'cmb2' ),
				'object_types' => array( 'shop-page-wp' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );

			$cmb_description->add_field( array(
				'name' => esc_html__( 'Product Description (optional)', 'cmb2' ),
				'id'   => $prefix . 'description',
				'type' => 'textarea',
			) );

			/**
			 * Button Text Meta Box
			 */
			$cmb_button_text = new_cmb2_box( array(
				'id'           => 'Shop_Page_WP_meta',
				'title'        => esc_html__( 'Button Text', 'cmb2' ),
				'object_types' => array( 'shop-page-wp' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );

			// Price text field
			$cmb_button_text->add_field( array(
				'name' => esc_html__( 'Custom Button Text (optional)', 'cmb2' ),
				'id'   => $prefix . 'button-text',
				'type' => 'text',
			) );


		}

	}

}
