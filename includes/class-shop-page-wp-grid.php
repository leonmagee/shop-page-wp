<?php

/**
 * Class Shop_Page_WP_Grid
 * query data and create grid
 */
class Shop_Page_WP_Grid {
	/**
	 * @param $attributes
	 * $attributes array can come from shortcode or widget settings
	 *
	 * @return string
	 */
	static function return_grid( $attributes ) {

		/**
		 * Get saved settings data
		 */
		if ( ! ( $button_text = get_option( 'shop-page-wp-button-text' ) ) ) {
			$button_text = esc_html__( 'Buy Now', 'shop-page-wp' );
		}
		$columns_array = get_option( 'shop-page-wp-show-default-columns' );
		if ( ! ( $number_of_columns = $columns_array['column_options'] ) ) {
			$number_of_columns = 3;
		}

		/**
		 * Get grid size from attributes
		 */
		if ( ! $attributes['grid'] ) {
			if ( $number_of_columns ) {
				$attributes['grid'] = $number_of_columns;
			}
		}
		if ( $attributes['grid'] ) {
			if ( $attributes['grid'] == 1 ) {
				$grid_width = 100;
			} elseif ( $attributes['grid'] == 2 ) {
				$grid_width = 50;
			} elseif ( $attributes['grid'] == 4 ) {
				$grid_width = 25;
			} else {
				$grid_width = 33.3;
			}
		} else {
			$grid_width = 33.3;
		}

		/**
		 * Set $args for custom post type query
		 */
		$products = array();
		if ( $attributes['category'] ) {
			$cat_array   = array();
			$cat_explode = explode( '|', $attributes['category'] );
			foreach ( $cat_explode as $cat ) {
				$cat_object = get_category_by_slug( $cat );
				$cat_id     = $cat_object->term_id;
				$cat_array[] = $cat_id;
			}
			$args = array(
				'post_type'      => 'shop-page-wp',
				'category__in'   => $cat_array,
				'posts_per_page' => - 1
			);
		} else {
			$args = array(
				'post_type'      => 'shop-page-wp',
				'posts_per_page' => - 1
			);
		}
		/**
		 * WordPress Query
		 */
		$shop_page_wp_query = new WP_Query( $args );
		if ( $shop_page_wp_query->have_posts() ) {
			while ( $shop_page_wp_query->have_posts() ) {
				$shop_page_wp_query->the_post();
				$title     = get_the_title();
				$prefix    = '_Shop_Page_WP_';
				$url_field = $prefix . 'url';
				if ( ! ( $link = get_post_meta( get_the_ID(), $url_field, true ) ) ) {
					$link = false;
				}
				$image_id = get_post_thumbnail_id();

				if ( has_post_thumbnail() ) {
					$image_url       = wp_get_attachment_image_src( $image_id, 'shop-page-wp-product', true );
					$image_url_final = $image_url[0];
				} else {
					$image_url_final = plugins_url( '../assets/img/product-image-placeholder.png', __FILE__ );
				}
				$products[] = array(
					'title'   => $title,
					'img_url' => $image_url_final,
					'link'    => $link
				);
			}
		}
		wp_reset_postdata();

		ob_start(); ?>

		<product class="shop-page-wp-grid">
			<?php foreach ( $products as $product ) { ?>
				<div class="shop-page-wp-item" style="flex-basis: <?php echo $grid_width; ?>%">
					<div class="shop-page-wp-image">
						<img src="<?php echo $product['img_url']; ?>"/>
					</div>
					<div class="shop-page-wp-title">
						<h3><?php echo $product['title']; ?></h3>
					</div>
					<?php if ( $product['link'] ) { ?>
						<div class="shop-page-wp-link">
							<a class="buy-link" target="_blank" href="<?php echo $product['link']; ?>">
								<?php echo $button_text; ?>
							</a>
						</div>
					<?php } else { ?>
						<div class="shop-page-wp-link">
							<a class="buy-link disabled">
								<?php echo $button_text; ?>
							</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</product>
		<?php
		$content = ob_get_clean();

		return $content;
	}
}