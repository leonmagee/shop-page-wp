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
			'shop-page-wp-section-regen' ); // section handle

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
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-width', array(
			'Shop_Page_WP_Admin_Settings',
			'shop_page_wp_iw_validate'
		) );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-height', array(
			'Shop_Page_WP_Admin_Settings',
			'shop_page_wp_ih_validate'
		) );
		register_setting( 'shop-page-wp-options', 'shop-page-wp-image-crop', array(
			'Shop_Page_WP_Admin_Settings',
			'shop_page_wp_ic_validate'
		) );
	}

	function Shop_Page_WP_regen_warning() { ?>
		<div class="notice notice-warning is-dismissible">
			<p><?php _e( 'You must now', 'shop-page-wp' ); ?> <a
					href="https://wordpress.org/plugins/regenerate-thumbnails/"
					target="_blank"><?php _e( 'regenerate thumbnails', 'shop-page-wp' ); ?></a>.</p>
		</div>
	<?php }

	function Shop_Page_WP_default_text() { ?>
		<h2><?php _e( 'Default Settings', 'shop-page-wp' ); ?></h2>
	<?php }

	function Shop_Page_WP_image_text() { ?>
		<h2><?php _e( 'Custom Image Size Settings (Optional)', 'shop-page-wp' ); ?></h2>
		<div
			class="explanation"><?php _e( 'Set max image width and height in pixels (Default is 300px x 300px with crop)', 'shop-page-wp' ); ?>
			<br/><?php _e( 'After changing image size you must', 'shop-page-wp' ); ?> <a
				href="https://wordpress.org/plugins/regenerate-thumbnails/"
				target="_blank"><?php _e( 'regenerate thumbnails', 'shop-page-wp' ); ?></a>.
		</div>
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
			<option
				value="default" <?php selected( $options['style_options'], 'default' ); ?>><?php _e( 'Default Styles' ); ?>
			</option>
			<option
				value="grid-only" <?php selected( $options['style_options'], 'grid-only' ); ?>><?php _e( 'Grid Spacing Only', 'shop-page-wp' ); ?>
			</option>
			<option
				value="no-styles" <?php selected( $options['style_options'], 'no-styles' ); ?>><?php _e( 'No Styles', 'shop-page-wp' ); ?>
			</option>
			</option>
		</select>
		<?php
	}

	function column_select_form() {
		$options = get_option( 'shop-page-wp-show-default-columns' );
		?>
		<select id='column_options' name='shop-page-wp-show-default-columns[column_options]'>
			<option
				value="1" <?php selected( $options['column_options'], '1' ); ?>><?php _e( '1 Column', 'shop-page-wp' ); ?>
			</option>
			<option
				value="2" <?php selected( $options['column_options'], '2' ); ?>><?php _e( '2 Column', 'shop-page-wp' ); ?>
			</option>
			<option
				value="3" <?php selected( $options['column_options'], '3' ); ?>><?php _e( '3 Column', 'shop-page-wp' ); ?>
			</option>
			<option
				value="4" <?php selected( $options['column_options'], '4' ); ?>><?php _e( '4 Column', 'shop-page-wp' ); ?>
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
			<option
				value="crop" <?php selected( $options['crop_options'], 'crop' ); ?>><?php _e( 'Crop Image', 'shop-page-wp' ); ?>
			</option>
			<option
				value="no-crop" <?php selected( $options['crop_options'], 'no-crop' ); ?>><?php _e( 'Don\'t Crop Image', 'shop-page-wp' ); ?>
			</option>
		</select>
		<?php
	}

	function shop_page_wp_iw_validate( $current_input ) {
		$image_width = get_option( 'shop-page-wp-image-width' );
		update_option( 'shop-page-wp-iw-field-change', 'no-change' );
		if ( $image_width != $current_input ) {
			update_option( 'shop-page-wp-iw-field-change', 'has-changed' );
		}

		return $current_input;
	}

	function shop_page_wp_ih_validate( $current_input ) {
		$image_height = get_option( 'shop-page-wp-image-height' );
		update_option( 'shop-page-wp-ih-field-change', 'no-change' );
		if ( $image_height != $current_input ) {
			update_option( 'shop-page-wp-ih-field-change', 'has-changed' );
		}

		return $current_input;
	}

	function shop_page_wp_ic_validate( $current_input ) {
		$image_crop_array = get_option( 'shop-page-wp-image-crop' );
		$image_crop       = $image_crop_array['crop_options'];
		update_option( 'shop-page-wp-ic-field-change', 'no-change' );
		if ( $image_crop != $current_input['crop_options'] ) {
			update_option( 'shop-page-wp-ic-field-change', 'has-changed' );
		}
		return $current_input;
	}
}