<?php

/**
 * Class Shop_Page_WP_Admin
 */
class Shop_Page_WP_Admin {

	public static function activate_admin() {
		add_action( 'admin_menu', array( 'Shop_Page_WP_Admin', 'activate_submenu_page' ) );
	}

	function activate_submenu_page() {

		add_submenu_page(
			'edit.php?post_type=wp-shop-affiliates', // string $parent_slug
			'Settings', // string $page_title,
			'Settings', // string $menu_title,
			'manage_options', // string $capability
			'wp-affiliate-settings', // string $menu_slug
			array( 'Shop_Page_WP_Admin', 'output_admin_page' )
		);
	}

	static function output_admin_page() { ?>
		<div class="wrap">
			<style>
				.wp-affiliate-settings input, .wp-affiliate-settings select {
					min-width: 210px;
				}
				.wp-affiliate-settings .form-table th {
					min-width: 230px;
				}
				.wp-affiliate-settings h2 {
					margin-top: 25px;
					margin-bottom: 0;
					font-size: 1.7em;
				}
				.wp-affiliate-settings .explanation {
					color: #777;
					font-size: 1.1em;
					margin-top: 15px;
				}
			</style>
			<h1><?php _e( Shop_Page_WP_Name . ' Settings', 'shop-page-wp' ); ?></h1>
			<form class="wp-affiliate-settings" method="post" action="options.php">
				<?php
				settings_fields( 'shop-page-wp-options' );

				do_settings_sections( 'shop-page-wp-section' );

				do_settings_sections( 'shop-page-wp-section-image' );

				submit_button();
				?>
			</form>
		</div>
	<?php }
}