<?php

/**
 * Class Shop_Page_WP_Admin_Settings
 */
class Shop_Page_WP_Admin_Settings
{
    public static function output_settings()
    {
        add_action('admin_init', array('Shop_Page_WP_Admin_Settings', 'display_options'));
    }

    public static function display_options()
    {
        add_settings_section(
            'shop-page-wp-options',
            '',
            array('Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_regen_warning'),
            'shop-page-wp-section-regen');

        add_settings_section(
            'shop-page-wp-options',
            '',
            array('Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_default_text'),
            'shop-page-wp-section');

        add_settings_section(
            'shop-page-wp-options',
            '',
            array('Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_image_text'),
            'shop-page-wp-section-image');

        add_settings_field(
            'shop-page-wp-button-text',
            __('Button Text (max 14 characters)', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'shop_button_text_form'),
            'shop-page-wp-section',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-show-choose-styles',
            __('Choose Default Styles', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'default_styles_form'),
            'shop-page-wp-section',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-show-default-columns',
            __('Default Number of Columns', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'column_select_form'),
            'shop-page-wp-section',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-link-target',
            __('Open Link in New Tab?', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'target_radio_form'),
            'shop-page-wp-section',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-legacy-format',
            __('Use Legacy Link Format?', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'legacy_format_form'),
            'shop-page-wp-section',
            'shop-page-wp-options'
        );

        add_settings_section(
            'shop-page-wp-legacy-explain',
            '',
            array('Shop_Page_WP_Admin_Settings', 'Shop_Page_WP_explain_text'),
            'shop-page-wp-section');

        add_settings_field(
            'shop-page-wp-image-width',
            __('Image Width', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'image_width_form'),
            'shop-page-wp-section-image',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-image-height',
            __('Image Height', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'image_height_form'),
            'shop-page-wp-section-image',
            'shop-page-wp-options'
        );

        add_settings_field(
            'shop-page-wp-image-crop',
            __('Image Crop', 'shop-page-wp'),
            array('Shop_Page_WP_Admin_Settings', 'image_crop_form'),
            'shop-page-wp-section-image',
            'shop-page-wp-options'
        );

        register_setting('shop-page-wp-options', 'shop-page-wp-button-text');
        register_setting('shop-page-wp-options', 'shop-page-wp-show-choose-styles');
        register_setting('shop-page-wp-options', 'shop-page-wp-show-default-columns');
        register_setting('shop-page-wp-options', 'shop-page-wp-link-target');
        register_setting('shop-page-wp-options', 'shop-page-wp-legacy-format');

        register_setting('shop-page-wp-options', 'shop-page-wp-image-width', array(
            'Shop_Page_WP_Admin_Settings',
            'shop_page_wp_iw_validate',
        ));
        register_setting('shop-page-wp-options', 'shop-page-wp-image-height', array(
            'Shop_Page_WP_Admin_Settings',
            'shop_page_wp_ih_validate',
        ));
        register_setting('shop-page-wp-options', 'shop-page-wp-image-crop', array(
            'Shop_Page_WP_Admin_Settings',
            'shop_page_wp_ic_validate',
        ));
    }

    public static function Shop_Page_WP_regen_warning()
    {?>
		<div class="notice notice-warning is-dismissible">
			<p><?php _e('You must', 'shop-page-wp');?> <a
					href="https://wordpress.org/plugins/regenerate-thumbnails/"
					target="_blank"><?php _e('regenerate thumbnails', 'shop-page-wp');?></a> <?php esc_html_e('for the updated image size to take effect.', 'shop-page-wp');?>
			</p>
		</div>
	<?php }

    public static function Shop_Page_WP_default_text()
    {?>
		<h2><?php _e('Default Settings', 'shop-page-wp');?></h2>
	<?php }

    public static function Shop_Page_WP_image_text()
    {?>
		<h2><?php _e('Custom Image Size Settings (Optional)', 'shop-page-wp');?></h2>
		<div
			class="explanation"><?php _e('Set max image width and height in pixels (Default is 300px x 300px with crop)', 'shop-page-wp');?>
			<br/><?php _e('After changing image size you must', 'shop-page-wp');?> <a
				href="https://wordpress.org/plugins/regenerate-thumbnails/"
				target="_blank"><?php _e('regenerate thumbnails', 'shop-page-wp');?></a>.
		</div>
	<?php }

    public static function Shop_Page_WP_explain_text()
    {?>
			<div
				class="explanation spwp-minus-top-margin">
				<?php esc_html_e('Previously the plugin used a JavaScript link, while the new version uses an <a> tag.', 'shop-page-wp');?>
				<br />
				<?php _e('Select Yes to continue using the JavaScript link.', 'shop-page-wp');?>
				<br />
				<?php _e('If you are experiencing any styling issues after updating this may help.', 'shop-page-wp');?>
			</div>
		<?php }

    public static function shop_button_text_form()
    {
        $button_text = get_option('shop-page-wp-button-text');
        ?>
		<input type="text" name="shop-page-wp-button-text" maxlength="14"
		       id="shop-page-wp-button-text"
		       value="<?php echo esc_attr($button_text); ?>"/>
	<?php }

    public static function default_styles_form()
    {
        $options = get_option('shop-page-wp-show-choose-styles');
        if ($options) {
            $style_option = $options['style_options'];
        } else {
            $style_option = false;
        }
        ?>
		<select id='style_options' name='shop-page-wp-show-choose-styles[style_options]'>
			<option
				value="default" <?php selected($style_option, 'default');?>><?php _e('Default Styles');?>
			</option>
			<option
				value="grid-only" <?php selected($style_option, 'grid-only');?>><?php _e('Grid Spacing Only', 'shop-page-wp');?>
			</option>
			<option
				value="no-styles" <?php selected($style_option, 'no-styles');?>><?php _e('No Styles', 'shop-page-wp');?>
			</option>
			</option>
		</select>
		<?php
}

    public static function column_select_form()
    {
        $options = get_option('shop-page-wp-show-default-columns');
        if (!$options) {
            $options['column_options'] = 3;
        }
        ?>
		<select id='column_options' name='shop-page-wp-show-default-columns[column_options]'>
			<option
				value="1" <?php selected($options['column_options'], '1');?>><?php _e('1 Column', 'shop-page-wp');?>
			</option>
			<option
				value="2" <?php selected($options['column_options'], '2');?>><?php _e('2 Column', 'shop-page-wp');?>
			</option>
			<option
				value="3" <?php selected($options['column_options'], '3');?>><?php _e('3 Column', 'shop-page-wp');?>
			</option>
			<option
				value="4" <?php selected($options['column_options'], '4');?>><?php _e('4 Column', 'shop-page-wp');?>
			</option>
		</select>
		<?php
}

    public static function target_radio_form()
    {
        $link = get_option('shop-page-wp-link-target');
        if (!$link) {
            update_option('shop-page-wp-link-target', 1);
        }
        ?>
		<input type="radio" value="1" name="shop-page-wp-link-target" <?php checked(1, get_option('shop-page-wp-link-target', true));?> />
		<label class='radio-label'>YES</label>
		<input type="radio" value="2" name="shop-page-wp-link-target" <?php checked(2, get_option('shop-page-wp-link-target', true));?> />
		<label class='radio-label'>NO</label>

	<?php
}

    public static function legacy_format_form()
    {
        $link = get_option('shop-page-wp-legacy-format');
        if (!$link) {
            update_option('shop-page-wp-legacy-format', 2);
        }
        ?>
		<input type="radio" value="1" name="shop-page-wp-legacy-format" <?php checked(1, get_option('shop-page-wp-legacy-format', true));?> />
		<label class='radio-label'>YES</label>
		<input type="radio" value="2" name="shop-page-wp-legacy-format" <?php checked(2, get_option('shop-page-wp-legacy-format', true));?> />
		<label class='radio-label'>NO</label>
	<?php
}

    public static function image_width_form()
    {?>
		<input type="number" name="shop-page-wp-image-width"
		       id="shop-page-wp-image-width"
		       value="<?php echo esc_attr(get_option('shop-page-wp-image-width')); ?>"/>
	<?php }

    public static function image_height_form()
    {?>
		<input type="number" name="shop-page-wp-image-height"
		       id="shop-page-wp-image-height"
		       value="<?php echo esc_attr(get_option('shop-page-wp-image-height')); ?>"/>
	<?php }

    public static function image_crop_form()
    {
        $options = get_option('shop-page-wp-image-crop');
        ?>
		<select id='crop_options' name='shop-page-wp-image-crop[crop_options]'>
			<option
				value="crop" <?php selected($options['crop_options'], 'crop');?>><?php _e('Crop Image', 'shop-page-wp');?>
			</option>
			<option
				value="no-crop" <?php selected($options['crop_options'], 'no-crop');?>><?php _e('Don\'t Crop Image', 'shop-page-wp');?>
			</option>
		</select>
		<?php
}

    public static function shop_page_wp_iw_validate($current_input)
    {
        $image_width = get_option('shop-page-wp-image-width');
        update_option('shop-page-wp-iw-field-change', 'no-change');
        if ($image_width != $current_input) {
            update_option('shop-page-wp-iw-field-change', 'has-changed');
        }

        return $current_input;
    }

    public static function shop_page_wp_ih_validate($current_input)
    {
        $image_height = get_option('shop-page-wp-image-height');
        update_option('shop-page-wp-ih-field-change', 'no-change');
        if ($image_height != $current_input) {
            update_option('shop-page-wp-ih-field-change', 'has-changed');
        }

        return $current_input;
    }

    public static function shop_page_wp_ic_validate($current_input)
    {
        $image_crop_array = get_option('shop-page-wp-image-crop');
        $image_crop = $image_crop_array['crop_options'];
        update_option('shop-page-wp-ic-field-change', 'no-change');
        if ($image_crop != $current_input['crop_options']) {
            update_option('shop-page-wp-ic-field-change', 'has-changed');
        }

        return $current_input;
    }
}
