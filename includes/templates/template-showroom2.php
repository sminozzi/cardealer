<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
?>
<style type="text/css">
<!-- 
<?php
if(get_option('sidebar_search_page_result', 'no') == 'yes')
{?>
    #secondary, .sidebar-container
    {
        display: none !important; 
    }
<?php } ?> 
    
#main
{  width: 100%!important;
   background: white;
   position:  absolute;}
-->
</style>
<?php
global $wp;
global $query;
global $wp_query;
$wp_query->is_404 = false;
get_header();
    $output =  '<div style="background: white; margin-top: 20px;">';
 	$output .= '<div id="car_content">';
    if (!isset($_GET['submit'])) {
        $_GET['submit'] = '';
    }
    else
      $submit = sanitize_text_field($_GET['submit']);
    if (isset($_GET['post_type'])) {
        $post_type = sanitize_text_field($_GET['post_type']);
    }
    if (isset($_GET['postNumber'])) {
        $postNumber = sanitize_text_field($_GET['postNumber']);
    }
    if( empty($postNumber))
      {$postNumber = get_option('CarDealer_quantity', 6);}
    $output .= CarDealer_search (2);
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
       global $wp_query;
       wp_reset_query();
       
       
       
        if (isset($submit)) {
            require_once(CARDEALERPATH.'includes/search/search_get_par.php');



            $args = array(
                'post_type' => 'cars',
                
                'showposts' => $postNumber,
                'paged' => $paged,
                
                /*
                'tax_query' => array(
                    array(
                        'taxonomy' => 'makes',
                        'field' => 'name',
                        'terms' => $make,
                    )),
                */
                'meta_query' => array(
                    array($yearKey => $yearName, $yearVal => $year,),
                    array('key' => 'car-price','value' => array($priceMin, $priceMax),'type' => 'numeric','compare' => 'BETWEEN'),
                    array($conKey => $conName,$conVal => $con,),
                    
                    array($fuelKey => $fuelName,$fuelVal => $fuel,),
                    array($transKey => $transName,$transVal => $trans,),
                                                            
                    array($typeKey => $typeName, $typeVal => $typecar,),
                    ),
                );
                
            
            if(!empty($make) and $make <> 'Any')
            {
               $args['tax_query'] = array(
                array(
                        'taxonomy' => 'makes',
                        'field' => 'name',
                        'terms' => $make,
                    ));
            }    
                
           if( !empty($order))
           {
            
               $args['orderby'] =  'meta_value';
               $args['meta_type'] = 'NUMERIC';
               
               if($order == 'price_high')
               {
                   $args['meta_key'] = 'car-price'; 
                   $args['order'] = 'DESC';
               } 
               
               if($order == 'price_low')
               {
                   $args['meta_key'] = 'car-price'; 
                   $args['order'] = 'ASC';
               }
               
               if($order == 'mileage_high')
               {
                   $args['meta_key'] = 'car-miles'; 
                   $args['order'] = 'DESC';
               } 
               
               if($order == 'mileage_low')
               {
                   $args['meta_key'] = 'car-miles'; 
                   $args['order'] = 'ASC';
               }
               
               if($order == 'year_high')
               {
                   $args['meta_key'] = 'car-year'; 
                   $args['order'] = 'DESC';
               } 
               
               if($order == 'year_low')
               {
                   $args['meta_key'] = 'car-year'; 
                   $args['order'] = 'ASC';
               }
           }
                           
                
        } else // submit
         {
            $args = array(
                'post_type' => 'cars',
                'showposts' => $postNumber,
                'paged' => $paged,
                'order' => 'DESC');
        }      
        $wp_query = new WP_Query($args);
 
 /*
 echo '<pre>';
 print_r($args);
 echo '</pre>';
*/
 
        $qposts = $wp_query->post_count;
        $ctd = 0;
        $output .= '<div class="carGallery">';
        $output .= '<div class="CarDealer_container">';  
        while ($wp_query->have_posts()):
            $wp_query->the_post();
            $ctd++;
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $price = get_post_meta(get_the_ID(), 'car-price', true);
            if (!empty($price))
                 {$price =   number_format($price);}
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
            $thumb = CarDealer_theme_thumb($image, 800, 400, 'br'); // Crops from bottom right 
            $hp = get_post_meta(get_the_ID(), 'car-hp', true);
            $year = get_post_meta(get_the_ID(), 'car-year', true);
            $fuel = get_post_meta(get_the_ID(), 'car-fuel', true);
            $transmission = get_post_meta(get_the_ID(), 'transmission-type', true);
            $miles = get_post_meta(get_the_ID(), 'car-miles', true);
            $output .= '<div>';
            $output .=  '<a href="' . get_permalink() . '">';
            $output .= '<div class="CarDealer_gallery_2016">';
            $output .=  '<img class="CarDealer_caption_img" src="' . $thumb .'" alt="'. get_the_title() . '" />';
            $output .= '<div class="CarDealer_caption_text">';
            $output .= ($price <> '' ? cardealer_currency() . $price : __('Call for Price', 'cardealer'));
            $output .= '<br />';
            $output .= ($hp <> '' ? $hp .' '. __('HP', 'cardealer').'<br />' : '');
            $output .= ($year <> '' ? __('Year', 'cardealer') .': '. $year.'<br />' : '');
            
            $output .= ($fuel <> '' ? __('Fuel', 'cardealer') .': '. $fuel.'<br />' : '');
            $output .= ($transmission <> '' ? __('Transmission', 'cardealer') .': '. $transmission.'<br />' : '');

            $miles_label = get_option("CarDealer_measure", "Miles");
            $output .= ($miles <> '' ? __($miles_label,'cardealer') .': '. $miles.'<br />' : '');

            
            
            $output .= '</div>';
            $output .= '<div class="carTitle">' . get_the_title() . '</div>';
            $output .= '</a>'; 
            $output .= '</div>';
            $output .= '</div>';       
            if ($ctd < $qposts) {
                if ($ctd % 3 == 0) {
                    $output .= '</div>';
                    $output .= '<div class="CarDealer_container">';
                }
            }
        endwhile;
        $output .= '</div>'; 
        $output .= '<div class="car_navigation">';
        $output .= '';
        ob_start();
          the_posts_pagination( array(
        	'mid_size' => 2,
        	'prev_text' => __( 'Back', 'textdomain' ),
        	'next_text' => __( 'Onward', 'textdomain' ),
        ) );
        $output .= ob_get_contents();
        ob_end_clean();   
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
       wp_reset_postdata(); 
       wp_reset_query(); 
       if($qposts < 1)
         { $output .=  '<h4>' . __('Not Found !') .'</h4>' ;} 
       echo $output;
$registered_sidebars = wp_get_sidebars_widgets();
if(get_option('sidebar_search_page_result', 'no') == 'yes')
{
    foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
      unregister_sidebar( $sidebar_name );
    }
}
get_footer();
?>