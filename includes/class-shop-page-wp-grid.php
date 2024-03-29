<?php

/**
 * Class Shop_Page_WP_Grid
 * query data and create grid
 */
class Shop_Page_WP_Grid
{
    /**
     * @param $content
     * @param $length
     * @param string $suffix
     *
     * @return string
     */

    public static function parseAmazonURL($url)
    {
        $matches1 = [];
        $matches2 = [];
        preg_match('/href="([^"]*)"/i', $url, $matches1);
        preg_match('/src="([^"]*)"/i', $url, $matches2);
        if (isset($matches1[1]) && isset($matches2[1])) {
            return [$matches1[1], $matches2[1]];
        }
        return false;
    }

    /**
     * @param $attributes
     * $attributes array can come from shortcode or widget settings
     *
     * @return string
     */
    public static function return_grid($attributes)
    {
        /**
         * Get saved settings data
         */
        if (!($button_text = esc_html(get_option('shop-page-wp-button-text')))) {
            $button_text = __('Buy Now', 'shop-page-wp');
        }
        $columns_array = get_option('shop-page-wp-show-default-columns');
        if ($columns_array) {
            $number_of_columns = $columns_array['column_options'];
        } else {
            $number_of_columns = 3;
        }

        /**
         * Get grid size from attributes
         */
        if (!$attributes['grid']) {
            if ($number_of_columns) {
                $attributes['grid'] = $number_of_columns;
            }
        }

        if ($attributes['grid']) {
            if ($attributes['grid'] == 1) {
                //$grid_width = 100;
                $class_name = 'spwp-full-width';
            } elseif ($attributes['grid'] == 2) {
                //$grid_width = 50;
                $class_name = 'spwp-one-half';
            } elseif ($attributes['grid'] == 4) {
                //$grid_width = 25;
                $class_name = 'spwp-one-fourth';
            } else {
                //$grid_width = 33.3;
                $class_name = 'spwp-one-third';
            }
        } else {
            $class_name = 'spwp-one-third';
            //$grid_width = 33.3;
        }

        /**
         * Max Products to display
         */
        if (isset($attributes['max_number']) && ($attributes['max_number'] != '')) {
            $posts_per_page_max = intval($attributes['max_number']);
        } else {
            $posts_per_page_max = -1;
        }

        /**
         * Set $args for custom post type query
         */
        // default product array
        $args = array(
            'post_type' => 'shop-page-wp',
            'posts_per_page' => $posts_per_page_max,
        );
        // product ID or Category field is set
        if (isset($attributes['id']) && ($attributes['id'] != '')) {
            $id_array = array();
            $input_string = str_replace('|', ',', $attributes['id']);
            $id_explode = explode(',', $input_string);
            foreach ($id_explode as $id) {
                $id_array[] = $id;
            }
            $args = array(
                'post_type' => 'shop-page-wp',
                'post__in' => $id_array,
                'posts_per_page' => $posts_per_page_max,
            );
        } elseif (isset($attributes['category']) && ($attributes['category'] != '')) {
            $cat_array = array();
            $tax_array = array();
            $input_string = str_replace('|', ',', $attributes['category']);
            $cat_explode = explode(',', $input_string);

            foreach ($cat_explode as $cat) {
                // check to see if is custom taxonomy
                if (strpos($cat, '/')) {
                    $exploded = explode('/', $cat);
                    if ($exploded && (count($exploded) == 2)) {
                        $custom_tax = trim($exploded[0]);
                        $custom_tax_item = trim($exploded[1]);
                        $tax_object = get_term_by('slug', $custom_tax_item, $custom_tax);
                        if ($tax_object) {
                            $tax_id = $tax_object->term_id;
                            $tax_array[$custom_tax][] = $tax_id;
                        }
                    }
                } else {
                    $cat_object = get_category_by_slug($cat);
                    if ($cat_object) {
                        $cat_id = $cat_object->term_id;
                        $cat_array[] = $cat_id;
                    }
                }
            }
            $tax_query = array();
            foreach ($tax_array as $tax_name => $tax_items) {
                $tax_query[] = array(
                    'taxonomy' => $tax_name,
                    'field' => 'id',
                    'terms' => $tax_items,
                    'operator' => 'IN',
                );
            }
            $tax_query[] = array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $cat_array,
                'operator' => 'IN',
            );
            $tax_query['relation'] = 'OR';
            $args = array(
                'post_type' => 'shop-page-wp',
                'tax_query' => $tax_query,
                'posts_per_page' => $posts_per_page_max,
            );
        }
        /**
         * WordPress Query
         */
        $products = array();
        $shop_page_wp_query = new WP_Query($args);
        if ($shop_page_wp_query->have_posts()) {
            while ($shop_page_wp_query->have_posts()) {
                $shop_page_wp_query->the_post();
                $title = get_the_title();
                $prefix = '_Shop_Page_WP_';
                /**
                 * Check which type of product
                 */
                $type_field = $prefix . 'type';
                $type = get_post_meta(get_the_ID(), $type_field, true);
                /**
                 * Set alt text default
                 */
                $alt_text = '';
                if ($type == 2) {
                    /**
                     * Get Amazon Affiliate embed code
                     */
                    $amazon_field = $prefix . 'amazon-embed';
                    $amazon = get_post_meta(get_the_ID(), $amazon_field, true);
                    $matches = self::parseAmazonURL($amazon);
                    if ($matches) {
                        $link = $matches[0];
                        $image_url_final = 'https:' . $matches[1];
                    } else {
                        continue;
                    }
                } else {
                    /**
                     * Get URL field (if no embed code)
                     */
                    $url_field = $prefix . 'url';
                    if (!($link = get_post_meta(get_the_ID(), $url_field, true))) {
                        $link = false;
                    }
                    /**
                     * Get Featured Image (if no embed code)
                     */
                    $image_id = get_post_thumbnail_id();
                    if (has_post_thumbnail()) {
                        $image_url = wp_get_attachment_image_src($image_id, 'shop-page-wp-product', true);
                        $image_url_final = $image_url[0];

                        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                    } else {
                        $image_url_final = plugins_url('../assets/img/product-image-placeholder.png', __FILE__);
                    }
                }
                /**
                 * Get Description Field
                 */
                $description_field = $prefix . 'description';
                $description = get_post_meta(get_the_ID(), $description_field, true);
                /**
                 * Get Custom Button Text
                 */
                $button_custom = false;
                $button_text_field = $prefix . 'button-text';
                if ($button_text_new = get_post_meta(get_the_ID(), $button_text_field, true)) {
                    $button_custom = true;
                }
                $products[] = array(
                    'title' => $title,
                    'img_url' => $image_url_final,
                    'img_alt' => $alt_text,
                    'link' => $link,
                    'description' => $description,
                    'button_text' => $button_custom ? $button_text_new : $button_text,
                );
            }
        }
        wp_reset_postdata();

        ob_start();

        if (get_option('shop-page-wp-legacy-format') === "1") {
            ?>
        <script>
            function openUrlInNewTab(url) {
                var win = window.open(url, '_blank');
                win.focus();
            }
            function openUrlInSameTab(url) {
                var win = window.open(url, '_self');
                win.focus();
            }
        </script>
				<?php }?>
        <div class="shop-page-wp-grid">
			<?php foreach ($products as $product) {
            if (get_option('shop-page-wp-link-target') === "2") {
                // new tab no
                $js_func = 'openUrlInSameTab';
                $target = '';
            } else {
                // new tab yes
                $js_func = 'openUrlInNewTab';
                $target = 'target="_blank"';
            }
            if (get_option('shop-page-wp-legacy-format') === "1") {
                // legacy yes
                $opening_tag = '<div onclick="' . $js_func . '(\'' . $product['link'] . '\');" class="shop-page-wp-item spwp-has-link ' . $class_name . '">';
                $opening_tag_no_link = '<div class="shop-page-wp-item ' . $class_name . '">';
                $closing_tag = '</div>';
                $btn_opening_tag = '<a style="pointer-events: none;" class="buy-link" href="' . $product['link'] . '" rel="nofollow">';
                $btn_disabled_opening_tag = '<a class="buy-link disabled">';
                $btn_closing_tag = '</a>';
            } else {
                // legacy no
                $opening_tag = '<a ' . $target . ' href="' . $product['link'] . '" class="shop-page-wp-item spwp-has-link ' . $class_name . '">';
                $opening_tag_no_link = '<a class="shop-page-wp-item ' . $class_name . '">';
                $closing_tag = '</a>';
                $btn_opening_tag = '<span class="buy-link">';
                $btn_disabled_opening_tag = '<span class="buy-link disabled">';
                $btn_closing_tag = '</span>';
            }
            ?>
            <?php if ($product['link']) {
                echo wp_kses_post($opening_tag);
            } else {
                echo wp_kses_post($opening_tag_no_link);
            }?>

            <div class="shop-page-wp-image">
                <img src="<?php echo esc_url($product['img_url']); ?>" alt="<?php echo esc_attr($product['img_alt']); ?>"/>
            </div>
            <div class="shop-page-wp-title">
                <h3><?php echo esc_attr($product['title']); ?></h3>
            </div>
						<?php if ($product['description']) {?>
                <div class="shop-page-wp-description">
								<?php echo wp_kses_post($product['description']); ?>
                </div>
						<?php }?>
						<?php if ($product['link']) {?>
               <div class="shop-page-wp-link">
                <?php echo wp_kses_post($btn_opening_tag);
                echo esc_attr($product['button_text']);
                echo wp_kses_post($btn_closing_tag);
                ?>
               </div>
						<?php } else {?>
               <div class="shop-page-wp-link">
                <?php echo wp_kses_post($btn_disabled_opening_tag);
                echo esc_attr($product['button_text']);
                echo wp_kses_post($btn_closing_tag);
                ?>
               </div>
						<?php }?>
            <?php echo wp_kses_post($closing_tag); ?>
			<?php }?>
        </div>
		<?php
$content = ob_get_clean();
        return $content;
    }
}
