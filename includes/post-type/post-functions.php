<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
add_action('init', 'cardealerPosts');
function cardealerPosts () {
	register_post_type( 'cars', 
		array( 
			'labels' => array(
				'name' => 'Cars',
				'all_items' => 'All Cars',
				'singular_name' => 'Cars',
				'add_new_item' => 'Add Cars',
				'edit_item' => 'Edit Cars',
				'search_items' => 'Search Cars',
				'view_item' => 'View Cars',
				'not_found' => 'No Cars Found',
				'not_found_in_trash' => 'No Cars Found in Trash',
				'menu_name' => 'Cars For Sale'
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'has_archive' => true,
            'menu_icon' => CARDEALERIMAGES . 'car-icon.png',
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array(				'makess',
				'makes',
			),
			'exclude_from_search' => false,
			'_builtin' => false,
			'hierarchical' => false,
			'rewrite' => array("slug" => "car"),
		)
	);
};
add_action('init', 'CarDealer_taxonomies');
function CarDealer_taxonomies() { 
    
register_taxonomy( 'makes', 'cars', array(
			'labels' => array(
				// 'name' => _x('makes', 'taxonomy general name', 'cardealer'),
				'name' => 'makes',
				'singular_name' => 'makes',
				'search_items' => 'Search makes',
				'popular_items' => 'Popular makes',
				'all_items' => 'All makes',
				'parent_item' => __( 'Parent makes', 'cardealer' ),
  				'parent_item_colon' => __( 'Parent makes:' ),
				'edit_item' => __( 'Edit makes', 'cardealer' ), 
				'update_item' => __( 'Update makes', 'cardealer' ),
				'add_new_item' => __( 'Add New makes', 'cardealer' ),
				'new_item_name' => __( 'New makes' , 'cardealer'),
				'separate_items_with_commas' => __( 'Separate makes with commas', 'cardealer' ),
				'add_or_remove_items' => __( 'Add or Remove makes' , 'cardealer'),
				'choose_from_most_used' => __( 'Choose from the most used makers', 'cardealer' ),
				'menu_name' => 'Makes',
			),
			'hierarchical' => true,
			'show_ui' => true, // esconde do menu e do edit
			'query_var' => true,
			'rewrite' => array( 'slug' => 'makes' ),
			'public' => true,
            // 'meta_box_cb' => false // show form edit 
            // 'show_in_nav_menus' => false
		)
	);

   register_taxonomy( 'locations', 'cars', array(
			'labels' => array(
				// 'name' => _x('locations', 'taxonomy general name', 'cardealer'),
				'name' => 'locations',
				'singular_name' => 'locations',
				'search_items' => 'Search locations',
				'popular_items' => 'Popular locations',
				'all_items' => 'All locations',
				'parent_item' => __( 'Parent locations', 'cardealer' ),
  				'parent_item_colon' => __( 'Parent locations:' ),
				'edit_item' => __( 'Edit locations', 'cardealer' ), 
				'update_item' => __( 'Update locations', 'cardealer' ),
				'add_new_item' => __( 'Add New locations', 'cardealer' ),
				'new_item_name' => __( 'New locations' , 'cardealer'),
				'separate_items_with_commas' => __( 'Separate locations with commas', 'cardealer' ),
				'add_or_remove_items' => __( 'Add or Remove locations' , 'cardealer'),
				'choose_from_most_used' => __( 'Choose from the most used locations', 'cardealer' ),
				'menu_name' => 'Locations',
			),
			'hierarchical' => true,
			'show_ui' => true, // esconde do menu e do edit
			'query_var' => true,
			'rewrite' => array( 'slug' => 'makes' ),
			'public' => true,
            // 'meta_box_cb' => false // show form edit 
            // 'show_in_nav_menus' => false
		)
	);
       
    
}
function custom_listing_save_data($post_id) {
    global $meta_box,  $post;
    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ( isset($_POST['post_type']))
     { 
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }
}
add_action('save_post', 'custom_listing_save_data');
add_image_size('featured_preview', 55, 55, true);
 // GET FEATURED IMAGE
function CarDealer_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}
// ADD NEW COLUMN
add_action('admin_head', 'CarDealer_my_admin_custom_styles');
function CarDealer_my_admin_custom_styles() {
    $output_css = '<style type="text/css">
        .featured_image { width:150px !important; overflow:hidden }
    </style>';
    echo $output_css;
}
function CarDealer_columns_head($defaults) {
    $defaults['car-price'] = 'Price';
    $defaults['featured_image'] = __('Featured Image');
    $defaults['car-featured'] = 'Featured';
    $defaults['car-year'] = 'Year';
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}
// SHOW THE FEATURED IMAGE
function CarDealer_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = CarDealer_get_featured_image($post_ID);
 		$image_id = get_post_thumbnail_id($post_ID);
		$image_url = wp_get_attachment_image_src($image_id,'medium', true);	
		$image = str_replace("-".$image_url[1]."x".$image_url[2], "", $image_url[0]);
        $thumb = CarDealer_theme_thumb($image, 150, 75, 'br'); // Crops from bottom right
        if ($post_featured_image) {
            echo '<img src="' . $thumb . '" width="150px" height="75px" />';
        }
        else
          {
            echo '<img src="'.CARDEALERURL.'assets/images/image-no-available.jpg" width="100px" />';}
    }
    elseif ($column_name == 'car-year'){
         echo get_post_meta( $post_ID, 'car-year', true ); 
    }
    elseif ($column_name == 'car-hp'){
         echo get_post_meta( $post_ID, 'car-hp', true ); 
    }
    elseif ($column_name == 'car-price'){
         $price = get_post_meta( $post_ID, 'car-price', true );
         if(! empty($price)) 
            echo  cardealer_currency() . $price ; 
         else
            echo  __('Call For Price', 'cardealer', 'cardealer');
    }
    elseif ($column_name == 'car-featured'){
         $r = get_post_meta( $post_ID, 'car-featured', true ); 
         if($r == 'enabled')
           {echo 'Yes';}
         else
           {echo 'No';}
    }
}
if(isset($_GET['post_type'])){
    if ($_GET['post_type'] == 'cars')
      {
        add_filter('manage_posts_columns', 'CarDealer_columns_head');
        add_action('manage_posts_custom_column', 'CarDealer_columns_content', 10, 2);
      }
  }