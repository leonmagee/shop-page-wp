<?php

/**
 * Class Shop_Page_WP_Grid
 *
 * @todo create separate class to query data?
 */
class Shop_Page_WP_Grid {

	/**
	 * Link grid to 'add_shortcode' function
	 *
	 * This will take parameters, and query the products saved to the database
	 */
	static function return_grid( $attributes ) {

		/**
		 * Get Settings
		 */
		if ( ! ( $button_text = get_option( 'shop-page-wp-button-text' ) ) ) {
			$button_text = __( 'Buy Now', 'shop-page-wp' );
		}
		$columns_array = get_option( 'shop-page-wp-show-default-columns' );
		if ( ! ( $number_of_columns = $columns_array['column_options'] ) ) {
			$number_of_columns = 3;
		}

		/**
		 * Get grid size
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
				$grid_width = 48;
			} elseif ( $attributes['grid'] == 4 ) {
				$grid_width = 22;
			} else {
				$grid_width = 31;
			}
		} else {
			$grid_width = 31;
		}

		/**
		 * Query Custom Post Type
		 */
		$products = array();
		if ( $attributes['category'] ) {
			$cat_array   = array();
			$cat_explode = explode( '|', $attributes['category'] );
			foreach ( $cat_explode as $cat ) {
				$cat_id      = get_cat_ID( $cat );
				$cat_array[] = $cat_id;
			}
			$args = array( 'post_type' => 'shop-page-wp', 'category__in' => $cat_array );
		} else {
			$args = array( 'post_type' => 'shop-page-wp' );
		}
		$wp_affiliates_query = new WP_Query( $args );
		while ( $wp_affiliates_query->have_posts() ) {
			$wp_affiliates_query->the_post();
			$title     = get_the_title();
			$prefix    = '_Shop_Page_WP_';
			$url_field = $prefix . 'url';
			if ( ! ( $link = get_post_meta( get_the_ID(), $url_field, true ) ) ) {
				$link = false;
			}
			$image_id = get_post_thumbnail_id();
			/**
			 * @todo create custom image size? or use thumnbail
			 *  - probably need to create a custom image size
			 */

			if ( has_post_thumbnail() ) {
				$image_url  = wp_get_attachment_image_src( $image_id, 'shop-page-wp-product', true );
				$image_url_final = $image_url[0];
			} else {
				$image_url_final = plugins_url('../assets/img/product-image-placeholder.png', __FILE__);
			}
			$products[] = array(
				'title'   => $title,
				'img_url' => $image_url_final,
				'link'    => $link
			);
		}
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