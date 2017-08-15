<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
 function body_get_types()
{
        $atypes = array(
        __("Coupe","cardealer"),
        __("Luxury Car","cardealer"),
        __("Sedan","cardealer"),
        __("Sports Car","cardealer"),
        __("Sport Utility Vehicle","cardealer"),
        __("Van","cardealer"),
        __("Wagon","cardealer"),
        __("Other","cardealer"));
        $parent_term = term_exists( 'body_type', 'cars' ); // array is returned if taxonomy is given
        $parent_term_id = $parent_term['term_id']; // get numeric term id
        for ($i=0; $i < 8; $i++) {
            wp_insert_term(
               $atypes[$i],
              'body_type',
              array(
                'slug' =>  $atypes[$i],
              ));
        }
 return $atypes; 
} 
add_action( 'wp_loaded', 'body_get_types' );


function car_get_types()
{
    global $wpdb;
    $carmake = array();  
    $args = array(
        'taxonomy'               => 'makes',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    foreach($the_query->get_terms() as $term){ 
       $carmake[] = $term->name;
    }
    $qtypes = count($carmake);
    
    if($qtypes < 1)
    {
        $atypes = array("Dodge","Ford","Mercedes","Other");
        $parent_term = term_exists( 'makes', 'cars' ); // array is returned if taxonomy is given
        $parent_term_id = $parent_term['term_id']; // get numeric term id
        for ($i=0; $i < 4; $i++) {
            wp_insert_term(
               $atypes[$i],
              'makes',
              array(
                'slug' =>  $atypes[$i],
              ));
        }
        $carmake = $atypes;
    }
 return $carmake; 
}

function cardealer_get_max()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'cars',
        'meta_key' => 'car-price',
        'orderby' => 'meta_value_num',
        'order' => 'DESC');
        
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'car-price', true);
        if (!empty($x)) {
            $x = (int)$x;
            if (is_int($x)) {
                $x = ($x) * 1.2;
                $x = round($x, 0, PHP_ROUND_HALF_EVEN);
                //return $x;
            }
        }
        if($x < 1)
          return '100000';
        else
          return $x;
    }
}
add_action( 'wp_loaded', 'car_get_types' );

function cardealer_currency()
{
    if (get_option('CarDealercurrency') == 'Dollar') {
        return "$";
    }
    if (get_option('CarDealercurrency') == 'Pound') {
        return "&pound;";
    }
    if (get_option('CarDealercurrency') == 'Yen') {
        return "&yen;";
    }
    if (get_option('CarDealercurrency') == 'Euro') {
        return "&euro;";
    }
    if (get_option('CarDealercurrency') == 'Universal') {
        return "&curren;";
    }
    if (get_option('CarDealercurrency') == 'AUD') {
        return "AUD";
    }
    if (get_option('CarDealercurrency') == 'Real') {
        return "$R";
    }
}
function CarDealer_localization_init_fail()
{
    echo '<div class="error notice">
                     <br />
                     cardealerPlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
}
function CarDealer_plugin_was_activated()
{
                echo '<div class="updated"><p>';
                $bd_msg = '<img src="'.CARDEALERURL.'assets/images/infox350.png" />';
                
                $bd_msg .= '<h2>CarDealer Plugin was activated! </h2>';
                $bd_msg .= '<h3>For details and help, take a look at Cars For Sale (settings) at your left menu <br />';
                
                $bd_url = '  <a class="button button-primary" href="edit.php?post_type=cars&page=settings">or click here</a>';
    
                $bd_msg .=  $bd_url;
                echo $bd_msg;
                echo "</p></h3></div>";
                
     $Cardealerplugin_installed = trim(get_option( 'Cardealerplugin_installed',''));
     if(empty($Cardealerplugin_installed)){
        add_option( 'Cardealerplugin_installed', time() );
        update_option( 'Cardealerplugin_installed', time() );
     }
} 
if(is_admin())
{
  
   if(get_option('CarDealer_activated', '0') == '1')
   {
     add_action( 'admin_notices', 'CarDealer_plugin_was_activated' );
     $r =  update_option('CarDealer_activated', '0'); 
     if ( ! $r )
        add_option('CarDealer_activated', '0');
   }
}    
   
   ?>