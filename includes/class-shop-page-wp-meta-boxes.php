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
                'shop-page-wp-meta-boxes', // Unique ID
                'Product Details', // Box title
                'shop_page_wp_custom_box_html', // Content callback, must be of type callable
                'shop-page-wp' // Post type
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

            if ($amazon) {
                $match = [];
                preg_match('/src="([^"]*)"/i', $amazon, $match);
                if (isset($match)) {
                    $img_src = $match[1];
                } else {
                    $img_src = false; // change this to default image?
                }
            }

            $tab_links = [
                'Custom Product',
                'Amazon Embed',
            ];
            if (!$product_type) {
                $product_type = 1;
            }
            ?>

            <div class="spwp-button-group">
              <?php $counter = 1;
            foreach ($tab_links as $link) {?>
                  <a href="#" <?php if ($counter == $product_type) {echo 'class="current"';}?> tab="tab-<?php echo $counter; ?>"><?php echo $link; ?></a>
                <?php ++$counter;
            }?>

            </div>

            <div class="spwp-tab-container">
              <input id="spwp-type" type="hidden" name="_Shop_Page_WP_type" value="<?php echo $product_type; ?>"/>
              <div class="spwp-admin-item tab-item tab-1 <?php if ($product_type == 1) {echo 'current';}?>">
                <label for="_Shop_Page_WP_url">Product Affiliate URL</label>
                <input name="_Shop_Page_WP_url" value="<?php echo $affiliate_url; ?>"/>
              </div>
              <div class="spwp-admin-item tab-item tab-2 <?php if ($product_type == 2) {echo 'current';}?>">
                <label for="_Shop_Page_WP_amazon-embed">Amazon Embed</label>
                <textarea name="_Shop_Page_WP_amazon-embed"><?php echo $amazon; ?></textarea>
                <?php if ($img_src) {?>
                  <div class="preview-image">
                    <img src="<?php echo $img_src; ?>" />
                  </div>
                <?php }?>
              </div>
            </div>
            <div class="spwp-tab-container margin-top">
              <div class="spwp-admin-item">
                <label for="_Shop_Page_WP_description">Product Description (optional)</label>
                <textarea name="_Shop_Page_WP_description"><?php echo $description; ?></textarea>
              </div>
              <div class="spwp-admin-item">
                <label for="_Shop_Page_WP_button-text">Custom Button Text (optional)</label>
                <input name="_Shop_Page_WP_button-text" value="<?php echo $button_text; ?>"/>
              </div>
            </div>
         <?php }
        add_action('add_meta_boxes', 'shop_page_wp_add_custom_box');

        function shop_page_wp_save_meta($post_id)
        {

            $key_array = [
                '_Shop_Page_WP_type',
                '_Shop_Page_WP_url',
                '_Shop_Page_WP_description',
                '_Shop_Page_WP_button-text',
                '_Shop_Page_WP_amazon-embed',
            ];

            foreach ($key_array as $key) {
                if (array_key_exists($key, $_POST)) {
                    update_post_meta(
                        $post_id,
                        $key,
                        $_POST[$key]
                    );
                }
            }

            // if (array_key_exists('_Shop_Page_WP_url', $_POST)) {
            //     update_post_meta(
            //         $post_id,
            //         '_Shop_Page_WP_url',
            //         $_POST['_Shop_Page_WP_url']
            //     );
            // }
            // if (array_key_exists('_Shop_Page_WP_description', $_POST)) {
            //     update_post_meta(
            //         $post_id,
            //         '_Shop_Page_WP_description',
            //         $_POST['_Shop_Page_WP_description']
            //     );
            // }
            // if (array_key_exists('_Shop_Page_WP_button-text', $_POST)) {
            //     update_post_meta(
            //         $post_id,
            //         '_Shop_Page_WP_button-text',
            //         $_POST['_Shop_Page_WP_button-text']
            //     );
            // }
            // if (array_key_exists('_Shop_Page_WP_amazon-embed', $_POST)) {
            //     update_post_meta(
            //         $post_id,
            //         '_Shop_Page_WP_amazon-embed',
            //         $_POST['_Shop_Page_WP_amazon-embed']
            //     );
            // }

        }
        add_action('save_post', 'shop_page_wp_save_meta');

    }
}
