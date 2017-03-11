<?php

/**
 * @link              https://levon.io
 * @since             1.0.0
 * @package           Shop_Page_WP
 *
 * @wordpress-plugin
 * Plugin Name:       Shop Page WP
 * Plugin URI:        https://levon.io
 * Description:       Create a shop for affiliate products
 * Version:           1.0.0
 * Author:            Leon Magee, Justin McChesney-Wachs
 * Author URI:        https://levon.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shop-page-wp
 * Domain Path:       /languages
 */

/**
 * Abort if file is called directly
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'Shop_Page_WP_Name', 'Shop Page WP' );

/**
 * Plugin Admin Page
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-admin.php';

Shop_Page_WP_Admin::activate_admin();

/**
 * Admin Settings
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-admin-settings.php';

Shop_Page_WP_Admin_Settings::output_settings();

/**
 * Plugin Help / FAQ Page
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-instructions.php';

Shop_Page_WP_Instructions::activate_admin();

/**
 * Register Meta Boxes
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-cmb2.php';

Shop_Page_WP_CMB2::activate_cmb2();

/**
 * Activate Shortcode
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-shortcode.php';

Shop_Page_WP_Shortcode::activate_shortcode();

/**
 * Enqueue Styles
 */
$default_styles_array = get_option( 'shop-page-wp-show-choose-styles' );
$default_styles       = $default_styles_array['style_options'];

require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-scripts.php';

if ( 'default' === $default_styles ) {
	Shop_Page_WP_Scripts::hook_grid_styles();
	Shop_Page_WP_Scripts::hook_base_styles();
} elseif ( 'grid-only' === $default_styles ) {
	Shop_Page_WP_Scripts::hook_grid_styles();
}

/**
 * Register Post Type
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-cpt.php';

function wp_affiliate_register_post_types() {

	Shop_Page_WP_CPT::register_post_types();
}

add_action( 'init', 'wp_affiliate_register_post_types' );


/**
 * Set Image Sizes
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-page-wp-image-sizes.php';

Shop_Page_WP_Image_Sizes::create_image_sizes();