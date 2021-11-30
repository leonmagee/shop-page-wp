<?php

/**
 * Class Shop_Page_WP_CPT
 */
class Shop_Page_WP_CPT
{
    /**
     * Static Function create_post_type
     */
    public static function create_post_type()
    {
        register_post_type('shop-page-wp',

            array(
                'menu_position' => 4,
                'exclude_from_search' => true,
                'labels' => array(
                    'name' => __('Shop Page WP', 'shop-page-wp'),
                    'singular_name' => __('Shop Page WP', 'shop-page-wp'),
                    'add_new' => __('Add New Product', 'shop-page-wp'),
                    'add_new_item' => __('Add New Product', 'shop-page-wp'),
                    'edit_item' => __('Edit Product', 'shop-page-wp'),
                    'new_item' => __('New Product', 'shop-page-wp'),
                    'all_items' => __('All Products', 'shop-page-wp'),
                    'view_item' => __('View Product', 'shop-page-wp'),
                    'search_items' => __('Search Products', 'shop-page-wp'),
                    'not_found' => __('No Products found', 'shop-page-wp'),
                    'not_found_in_trash' => __('No Product found in Trash', 'shop-page-wp'),
                    'parent_item_colon' => '',
                    'menu_name' => 'Shop Page WP',
                ),
                'public' => true,
                'publicly_queryable' => false,
                'menu_icon' => 'dashicons-cart',
                '_builtin' => false,
                'rewrite' => array('slug' => 'shop-page'),
                'has_archive' => true,
                'supports' => array('title', 'thumbnail'),
                'taxonomies' => array('category'),
            )
        );
    }

    public static function add_id_column()
    {
        add_filter('manage_shop-page-wp_posts_columns', 'add_id_column');
        function add_id_column($columns)
        {
            $new_array = array();
            $count = 0;
            foreach ($columns as $key => $item) {
                if ($count == 2) {
                    $new_array['id'] = __('Product ID', 'shop-page-wp');
                    $new_array[$key] = $item;
                } else {
                    $new_array[$key] = $item;
                }
                $count++;
            }
            return $new_array;
        }
    }

    public static function add_id_value()
    {
        add_action('manage_shop-page-wp_posts_custom_column', 'get_product_id', 10, 2);

        function get_product_id($column, $post_id)
        {
            echo esc_attr($post_id);
        }
    }
}
