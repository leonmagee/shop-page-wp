<?php

/**
 * Class Shop_Page_WP_Admin_Settings
 */
class Shop_Page_WP_Admin_Settings {

	public static function output_settings() {

		add_action( 'admin_init', array( 'Shop_Page_WP_Admin_Settings', 'display_options' ) );
	}

	function display_options() {

		add_settings_section(
			'shop-page-wp-options', // settings field handle
			'', // title
			array( 'Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_regen_warning' ), // callback
			'shop-page-wp-section' ); // section handle

		add_settings_section(
			'shop-page-wp-options', // settings field handle
			'', // title
			array( 'Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_default_text' ), // callback
			'shop-page-wp-section' ); // section handle

		add_settings_section(
			'shop-page-wp-options', // settings field handle
			'', // title
			array( 'Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_image_text' ), // callback
			'shop-page-wp-section-image' ); // section handle

		add_settings_field(
			'shop-page-wp-button-text', // field ID
			__( 'Button Text (max 14 characters)', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'shop_button_text_form' ), // callback
			'shop-page-wp-section', // section handle
			'shop-page-wp-options' // settings handle
		);

		add_settings_field(
			'shop-page-wp-show-choose-styles', // field ID
			__( 'Choose Default Styles', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'default_styles_form' ), // callback
			'shop-page-wp-section', // setting section handle
			'shop-page-wp-options' // settings handle
		);

		add_settings_field(
			'shop-page-wp-show-default-columns', // field ID
			__( 'Default Number of Columns', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'column_select_form' ), // callback
			'shop-page-wp-section', // setting section handle
			'shop-page-wp-options' // settings handle
		);

		add_settings_field(
			'shop-page-wp-image-width', // field ID
			__( 'Image Width', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'image_width_form' ), // callback
			'shop-page-wp-section-image', // section handle
			'shop-page-wp-options' // settings handle
		);

		add_settings_field(
			'shop-page-wp-image-height', // field ID
			__( 'Image Height', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'image_height_form' ), // callback
			'shop-page-wp-section-image', // section handle
			'shop-page-wp-options' // settings handle
		);

		add_settings_field(
			'shop-page-wp-image-crop', // field ID
			__( 'Image Crop', 'shop-page-wp' ), // field Title
			array( 'Shop_Page_WP_Admin_Settings', 'image_crop_form' ), // callback
			'shop-page-wp-section-image', // section handle
			'shop-page-wp-options' // settings handle
		);

		register_setting( 'shop-page-wp-options', 'shop-page-wp-button-text' );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-show-choose-styles' );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-show-default-columns' );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-width' );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-height' );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-crop' );
	}

	function Shop_Page_WP_regen_warning() { ?>
		<div class="notice notice-warning is-dismissible">You must now <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">regenerate thumbnails</a>.</div>
	<?php }

	function Shop_Page_WP_default_text() { ?>
		<h2>Default Settings</h2>
	<?php }

	function Shop_Page_WP_image_text() { ?>
		<h2>Custom Image Size Settings (Optional)</h2>
		<div class="explanation">Set max image width and height in pixels (Default is 300px x 300px with crop)<br />After changing image size you must <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">regenerate thumbnails</a>.</div>
	<?php }

	function shop_button_text_form() { ?>
		<input type="text" name="shop-page-wp-button-text" maxlength="14"
		       id="shop-page-wp-button-text"
		       value="<?php echo get_option( 'shop-page-wp-button-text' ); ?>"/>
	<?php }

	function default_styles_form() {
		$options = get_option( 'shop-page-wp-show-choose-styles' );
		?>
		<select id='style_options' name='shop-page-wp-show-choose-styles[style_options]'>
			<option value="default" <?php selected( $options['style_options'], 'default' ); ?>>Default Styles
			</option>
			<option value="grid-only" <?php selected( $options['style_options'], 'grid-only' ); ?>>Grid Spacing Only
			</option>
			<option value="no-styles" <?php selected( $options['style_options'], 'no-styles' ); ?>>No Styles
			</option>
			</option>
		</select>
		<?php
	}

	function column_select_form() {
		$options = get_option( 'shop-page-wp-show-default-columns' );
		?>
		<select id='column_options' name='shop-page-wp-show-default-columns[column_options]'>
			<option value="1" <?php selected( $options['column_options'], '1' ); ?>>1 Column
			</option>
			<option value="2" <?php selected( $options['column_options'], '2' ); ?>>2 Column
			</option>
			<option value="3" <?php selected( $options['column_options'], '3' ); ?>>3 Column
			</option>
			<option value="4" <?php selected( $options['column_options'], '4' ); ?>>4 Column
			</option>
		</select>
		<?php
	}

	function image_width_form() { ?>
		<input type="number" name="shop-page-wp-image-width"
		       id="shop-page-wp-image-width"
		       value="<?php echo get_option( 'shop-page-wp-image-width' ); ?>"/>
	<?php }

	function image_height_form() { ?>
		<input type="number" name="shop-page-wp-image-height"
		       id="shop-page-wp-image-height"
		       value="<?php echo get_option( 'shop-page-wp-image-height' ); ?>"/>
	<?php }

	function image_crop_form() {
		$options = get_option( 'shop-page-wp-image-crop' );
		?>
		<select id='crop_options' name='shop-page-wp-image-crop[crop_options]'>
			<option value="crop" <?php selected( $options['crop_options'], 'crop' ); ?>>Crop Image
			</option>
			<option value="no-crop" <?php selected( $options['crop_options'], 'no-crop' ); ?>>Don't Crop Image
			</option>
		</select>
		<?php
	}


}