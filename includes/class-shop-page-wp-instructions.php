<?php

/**
 * Class Shop_Page_WP_Instructions
 */
class Shop_Page_WP_Instructions {

	public static function activate_admin() {
		add_action( 'admin_menu', array( 'Shop_Page_WP_Instructions', 'activate_submenu_page' ) );
	}

	public static function activate_submenu_page() {

		add_submenu_page(
			'edit.php?post_type=shop-page-wp', // string $parent_slug
			'Instructions', // string $page_title,
			'Instructions', // string $menu_title,
			'manage_options', // string $capability
			'shop-page-wp-instructions', // string $menu_slug
			array( 'Shop_Page_WP_Instructions', 'output_admin_page' )
		);
	}

	static function output_admin_page() { ?>
		<div class="wrap">
			<style>
				.shortcode-guide h2 {
					margin-top: 30px;
				}
				.shortcode-guide .shortcode {
					font-size: 1.4em;
					line-height: 50px;
					color: #222;
				}
				.shortcode-guide .explanation {
					color: #777;
					font-size: 1.1em;
					margin-bottom: 10px;
				}
			</style>
			<h1><?php _e( Shop_Page_WP_Name . ' Instructions', 'shop-page-wp' ); ?></h1>

			<div class="shortcode-guide">
				<h2><?php _e('Shortcode Usage', 'shop-page-wp' ); ?></h2>

				<div class="shortcode">[shop-page-wp]</div>

				<div class="explanation"><?php _e('Default shortcode. This will output a grid with every product you\'ve added.', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp category='food']</div>

				<div class="explanation"><?php _e('Show only products from one category.', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp category='food|electronics']</div>

				<div class="explanation"><?php _e('Show products from multiple categories (separated by \'pipe\' symbol).', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp grid='3']</div>

				<div class="explanation"><?php _e('Specify grid size (will override default settings). Options are 1, 2, 3 or 4.', 'shop-page-wp' ); ?></div>

				<h2><?php _e( 'Changing Image Sizes', 'shop-page-wp' ); ?></h2>

				<?php $image_settings_string = __('This plugin sets a custom image size of 300 x 300 pixels. After installing this plugin (or after changing the image size in settings) you must', 'shop-page-wp') .  ' <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">' . __('regenerate thumbnails', 'shop-page-wp') . '</a> ' . __('to create appropriately sized thumbnails for each of your product images. This will not be necessary for new images you upload while the plugin is installed and active.','shop-page-wp'); ?>

				<div class="explanation"><?php echo $image_settings_string; ?></div>

				<h2><?php _e( 'Use in Widgets', 'shop-page-wp' ); ?></h2>

				<?php $widget_settings_string = __('This plugin outputs a widget in...', 'shop-page-wp') .  ' <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">' . __('regenerate thumbnails', 'shop-page-wp') . '</a> ' . __('to create appropriately sized thumbnails for each of your product images. This will not be necessary for new images you upload while the plugin is installed and active.','shop-page-wp'); ?>

				<div class="explanation"><?php echo $widget_settings_string; ?></div>

			</div>
		</div>
	<?php }
}