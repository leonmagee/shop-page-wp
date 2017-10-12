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
                    font-size: 24px;
                    margin-bottom: 13px;
				}
				.shortcode-guide .shortcode {
					font-size: 1.6em;
					line-height: 50px;
					color: #222;
				}
				.shortcode-guide .explanation {
					color: #777;
					font-size: 1.1em;
					margin-bottom: 10px;
				}
                .support-links {
                    margin-top: 20px;
                    font-size: 16px;
                }
                .support-links a {
                    font-size: 16px;
                }
			</style>
			<h1><?php esc_html_e( Shop_Page_WP_Name . ' Instructions', 'shop-page-wp' ); ?></h1>

            <div class="support-links">
                <a href="https://shoppagewp.com/documentation/" target="_blank">Documentation</a> | <a href="https://shoppagewp.com/faq/" target="_blank">FAQ</a> | <a href="https://wordpress.org/support/plugin/shop-page-wp" target="_blank">Support</a>
            </div>

			<div class="shortcode-guide">
				<h2><?php esc_html_e('Shortcode Usage', 'shop-page-wp' ); ?></h2>

				<div class="shortcode">[shop-page-wp]</div>

				<div class="explanation"><?php esc_html_e('Default shortcode. This will output a grid with every product you\'ve added.', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp category='Electronics']</div>

				<div class="explanation"><?php esc_html_e('Show only products from one category. You may use either the category slug or the category name.', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp category='Electronics|Games|New Products']</div>

				<div class="explanation"><?php esc_html_e('Show products from multiple categories (separated by \'pipe\' symbol). You may use either the category slug or the category name.', 'shop-page-wp' ); ?></div>

				<div class="shortcode">[shop-page-wp grid='3']</div>

				<div class="explanation"><?php esc_html_e('Specify grid size (will override default settings). Options are 1, 2, 3 or 4.', 'shop-page-wp' ); ?></div>

				<h2><?php esc_html_e( 'Changing Image Sizes', 'shop-page-wp' ); ?></h2>

				<?php $image_settings_string = esc_html__('This plugin sets a custom image size of 300 x 300 pixels. After installing this plugin (or after changing the image size in settings) you must', 'shop-page-wp') .  ' <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">' . esc_html__('regenerate thumbnails', 'shop-page-wp') . '</a> ' . esc_html__('to create appropriately sized thumbnails for each of your product images. This will not be necessary for new images you upload while the plugin is installed and active.','shop-page-wp'); ?>

				<div class="explanation"><?php echo $image_settings_string; ?></div>

				<h2><?php esc_html_e( 'Use in Widgets', 'shop-page-wp' ); ?></h2>

				<?php $widget_settings_string = esc_html__('To add products to a widget area just drag the Shop Page WP widget into a Widget Area. You can then set the number of columns and categories (separated by a pipe | symbol), and optionally add a title for the widget section.','shop-page-wp'); ?>

				<div class="explanation"><?php echo $widget_settings_string; ?></div>

			</div>
		</div>
	<?php }
}