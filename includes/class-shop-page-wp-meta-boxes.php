<?php
/**
 * Class Shop_Page_WP_Meta_Boxes
 */
class Shop_Page_WP_Meta_Boxes
{

    public static function add_meta_boxes()
    {

        function shop_page_wp_add_custom_box()
        {
            add_meta_box(
                'shop-page-wp-meta-boxes',
                'Product Details',
                'shop_page_wp_custom_box_html',
                'shop-page-wp'
            );
        }
        function shop_page_wp_custom_box_html($post)
        {
            /**
             * Get current values
             */
            $data_array = [
                'product_type' => '_Shop_Page_WP_type',
                'affiliate_url' => '_Shop_Page_WP_url',
                'description' => '_Shop_Page_WP_description',
                'button_text' => '_Shop_Page_WP_button-text',
                'amazon' => '_Shop_Page_WP_amazon-embed',
            ];
            foreach ($data_array as $var => $key) {
                $$var = get_post_meta($post->ID, $key, true);
            }

            $img_src = false;
            if ($amazon) {
                $match = [];
                preg_match('/src="([^"]*)"/i', $amazon, $match);
                if (isset($match)) {
                    $img_src = $match[1];
                }
            }

            $tab_links = [
                __('Custom Product'),
                'Amazon ' . __('Embed'),
            ];
            if (!$product_type) {
                $product_type = 1;
            }
            ?>

            <div class="spwp-button-group">
              <?php if (Shop_Page_WP_Advanced_Access) {
                $counter = 1;
                foreach ($tab_links as $link) {?>
                  <a href="#" <?php if ($counter == $product_type) {echo 'class="current"';}?> tab="tab-<?php echo esc_attr($counter); ?>"><?php echo esc_attr($link); ?></a>
                <?php ++$counter;
                }
            }
            ?>
            </div>

            <div class="spwp-tab-container">
              <input id="spwp-type" type="hidden" name="_Shop_Page_WP_type" value="<?php echo esc_attr($product_type); ?>"/>
              <div class="spwp-admin-item tab-item tab-1 <?php if ($product_type == 1 || !Shop_Page_WP_Advanced_Access) {echo 'current';}?>">
                <label for="_Shop_Page_WP_url">Product Affiliate URL</label>
                <input name="_Shop_Page_WP_url" value="<?php echo esc_url($affiliate_url); ?>"/>
              </div>
              <?php if (Shop_Page_WP_Advanced_Access) {?>
              <div class="spwp-admin-item tab-item tab-2 <?php if ($product_type == 2) {echo 'current';}?>">
                <label for="_Shop_Page_WP_amazon-embed">Amazon Embed</label>
                <textarea name="_Shop_Page_WP_amazon-embed"><?php echo esc_html($amazon); ?></textarea>
                <?php if ($img_src) {?>
                  <div class="preview-image">
                    <img src="<?php echo esc_url($img_src); ?>" />
                  </div>
                <?php }?>
              </div>
              <?php }?>
            </div>
            <div class="spwp-tab-container margin-top">
              <div class="spwp-admin-item">
                <label for="_Shop_Page_WP_description">Product Description (optional)</label>
                <textarea name="_Shop_Page_WP_description"><?php echo esc_html($description); ?></textarea>
              </div>
              <div class="spwp-admin-item">
                <label for="_Shop_Page_WP_button-text">Custom Button Text (optional)</label>
                <input name="_Shop_Page_WP_button-text" value="<?php echo esc_attr($button_text); ?>"/>
              </div>
            </div>
         <?php }
        add_action('add_meta_boxes', 'shop_page_wp_add_custom_box');

        function shop_page_wp_save_meta($post_id)
        {
            $key_array = [
                '_Shop_Page_WP_type' => 'text',
                '_Shop_Page_WP_url' => 'url',
                '_Shop_Page_WP_description' => 'html',
                '_Shop_Page_WP_button-text' => 'text',
                '_Shop_Page_WP_amazon-embed' => 'html',
            ];

            foreach ($key_array as $key => $type) {
                if (array_key_exists($key, $_POST)) {
                    if ($type == 'text') {
                        $post_value = sanitize_text_field($_POST[$key]);
                    } elseif ($type == 'html') {
                        $post_value = wp_kses_post($_POST[$key]);
                    } elseif ($type == 'url') {
                        $post_value = sanitize_url($_POST[$key]);
                    }
                    update_post_meta(
                        $post_id,
                        $key,
                        $post_value
                    );
                }
            }
        }
        add_action('save_post', 'shop_page_wp_save_meta');
    }
}
