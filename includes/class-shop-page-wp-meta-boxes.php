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
            $affiliate_url = get_post_meta($post->ID, '_Shop_Page_WP_url', true);
            $description = get_post_meta($post->ID, '_Shop_Page_WP_description', true);
            $button_text = get_post_meta($post->ID, '_Shop_Page_WP_button-text', true);
            $amazon = get_post_meta($post->ID, '_Shop_Page_WP_amazon-embed', true);
            ?>
            <div class="shop-page-wp-choice-wrap">
            <button class="button button-primary button-large">Custom Product</button>
            <button class="button button-large">Amazon Embed</button>
            </div>
            <div>
              <label for="_Shop_Page_WP_url" style="font-weight: bold; min-width: 275px !important; display: inline-block; margin-top: -4px">Product Affiliate URL</label>
              <input style="margin-top: 20px; width: 500px;" name="_Shop_Page_WP_url" value="<?php echo $affiliate_url; ?>"/>
            </div>
            <div style="border-top: 1px solid #eee; margin-top: 15px;">
              <label for="_Shop_Page_WP_description" style="font-weight: bold; min-width: 275px !important; display: inline-block; margin-top: 23px">Product Description (optional)</label>
              <textarea style="margin-top: 20px; width: 500px; height: 200px; vertical-align: top;" name="_Shop_Page_WP_description"><?php echo $description; ?></textarea>
            </div>
            <div style="border-top: 1px solid #eee; margin-top: 15px;">
              <label for="_Shop_Page_WP_button-text" style="font-weight: bold; min-width: 275px !important; display: inline-block; margin-top: -4px">Custom Button Text (optional)</label>
              <input style="margin-top: 20px; width: 500px;" name="_Shop_Page_WP_button-text" value="<?php echo $button_text; ?>"/>
            </div>
            <div style="border-top: 1px solid #eee; margin-top: 15px;">
              <label for="_Shop_Page_WP_amazon-embed" style="font-weight: bold; min-width: 275px !important; display: inline-block; margin-top: 23px">Amazon Embed (optional)</label>
              <textarea style="margin-top: 20px; width: 500px; height: 200px; vertical-align: top;" name="_Shop_Page_WP_amazon-embed"><?php echo $amazon; ?></textarea>
            </div>
        <?php }
        add_action('add_meta_boxes', 'shop_page_wp_add_custom_box');

        function shop_page_wp_save_meta($post_id)
        {
            if (array_key_exists('_Shop_Page_WP_url', $_POST)) {
                update_post_meta(
                    $post_id,
                    '_Shop_Page_WP_url',
                    $_POST['_Shop_Page_WP_url']
                );
            }
            if (array_key_exists('_Shop_Page_WP_description', $_POST)) {
                update_post_meta(
                    $post_id,
                    '_Shop_Page_WP_description',
                    $_POST['_Shop_Page_WP_description']
                );
            }
            if (array_key_exists('_Shop_Page_WP_button-text', $_POST)) {
                update_post_meta(
                    $post_id,
                    '_Shop_Page_WP_button-text',
                    $_POST['_Shop_Page_WP_button-text']
                );
            }
            if (array_key_exists('_Shop_Page_WP_amazon-embed', $_POST)) {
                update_post_meta(
                    $post_id,
                    '_Shop_Page_WP_amazon-embed',
                    $_POST['_Shop_Page_WP_amazon-embed']
                );
            }

        }
        add_action('save_post', 'shop_page_wp_save_meta');

    }
}
