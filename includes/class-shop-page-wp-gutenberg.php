<?php

/**
 * Class Shop_Page_WP_Gutenberg
 */
class Shop_Page_WP_Gutenberg {

	public static function gutenberg_init() {

		$plugin_dir = plugin_dir_url( __FILE__ );

	    wp_register_script( 'shop-page-wp-gutenberg-script', $plugin_dir . '../assets/blocks/shop-page-wp-block-build.js', array('wp-blocks', 'wp-element', 'wp-editor'));

	    wp_register_style( 'shop-page-wp-gutenberg-styles', $plugin_dir . '../assets/css/shop-page-wp-gutenberg-admin.css',  array('wp-edit-blocks') );

	    register_block_type( 'gutenberg-boilerplate-es5/shop-page-wp', array(
	        'editor_script' => 'shop-page-wp-gutenberg-script',
	        'editor_style'  => 'shop-page-wp-gutenberg-styles',
	        'style' => 'shop-page-wp-gutenberg-styles', // prob don't need a public style?
			'render_callback' => array(__CLASS__, 'hello_gutenberg_block_callback'),
			// 'attributes'	  => array(
			// 	'title'	 => array(
			// 		'type' => 'string',
			// 		'default' => ''
			// 	),
			// 	'columns' => array(
			// 	'type' => 'string',
			// 	),
			// 	'categories'	=> array(
			// 		'type'	=> 'string',
			// 		'default' => ''
			// 	),
			// 	'maxProducts'	 => array(
			// 		'type'	=> 'string',
			// 		'default' => ''
			// 	),
			// ),


	    ) );
	}

	public static function hello_gutenberg_block_callback( $attr ) {
		//die('working');
		extract( $attr );


		$grid_content = Shop_Page_WP_Grid::return_grid( $attr );

		//var_dump($grid_content);

		return $grid_content;

		//var_dump($attr);
		//array(4) { ["title"]=> string(3) "222" ["columns"]=> string(1) "2" ["categories"]=> string(4) "cats" ["maxProducts"]=> string(2) "33" }
		// var_dump($title);
		// var_dump($columns);
		// var_dump($categories);
		// var_dump($maxProducts);





//array(4) { ["title"]=> string(14) "here's a title" ["grid"]=> string(1) "2" ["category"]=> string(9) "cats|dogs" ["max_number"]=> string(2) "33" }


		// var_dump($columns_number);
		// var_dump($max_products_number);

		//$testing = '<div style="color: red">Title: ' . $title . ' Columns: ' . $grid . ' Categories: ' . $category . ' Max Products: ' . $max_number . '</div>';

		//die($testing);

		//return $testing;


		// if ( isset( $tweet ) ) {
	 //        $theme = ( $theme === true ? 'click-to-tweet-alt' : 'click-to-tweet' );
		// 	$shortcode_string = '[clicktotweet tweet="%s" tweetsent="%s" button="%s" theme="%s"]';
	 //        return sprintf( $shortcode_string, $tweet, $tweetsent, $button, $theme );
		// }
	}


}




