<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
add_action('wp_enqueue_scripts', 'CarDealerregister_slider');
function CarDealerregister_slider()
{
    wp_register_script('search-slider', CARDEALERURL .
        'includes/search/search_slider.js', array('jquery'), null, true);
    wp_enqueue_script('search-slider');
    wp_register_style('jqueryuiSkin', CARDEALERURL . 'assets/jquery/jqueryui.css',
        array(), '1.12.1');
    wp_enqueue_style('jqueryuiSkin');
}
function CarDealer_search($is_show_room)
{
    global $postNumber, $wp, $post, $page_id;
    $my_title = __("Search", 'cardealer');
    if (!isset($_GET['meta_year'])) {
        $_GET['meta_year'] = '';
    }
    if (!isset($_GET['meta_price'])) {
        $_GET['meta_price'] = '';
    }
    if (!isset($_GET['meta_make'])) {
        $_GET['meta_make'] = '';
    }
    if (!isset($cardealer_meta_con)) {
        $cardealer_meta_con = '';
    }
    if (!isset($_GET['postNumber'])) {
        $_GET['postNumber'] = '';
    }
    //echo $is_show_room;
    if ($is_show_room == '0') {
        $searchlabel = 'search-label-widget';
        $selectboxmeta = 'select-box-meta-widget';
        $selectbox = 'select-box-widget';
        $inputbox = 'input-box-widget';
        $searchItem = 'searchItem-widget';
        $searchItem2 = 'searchItem2-widget';
        $CarDealersubmitwrap = 'CarDealer-submitBtn-widget';
        $CarDealer_search_box = 'CarDealer-search-box-widget';
        $current_page_url = esc_url(home_url() . '/CarDealer_show_room_2/');
        $CarDealer_search_type = 'search-widget';
    } elseif ($is_show_room == '1') {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem2';
        $CarDealersubmitwrap = 'CarDealer-submitBtn';
        $CarDealer_search_box = 'CarDealer-search-box';
        $current_page_url = home_url(esc_url(add_query_arg(null, null)));
        $CarDealer_search_type = 'page';
    } elseif ($is_show_room == '2') {
        $searchlabel = 'search-label';
        $selectboxmeta = 'select-box-meta';
        $selectbox = 'select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem2';
        $CarDealersubmitwrap = 'CarDealer-submitBtn';
        $CarDealer_search_box = 'CarDealer-search-box';
        $current_page_url = esc_url(home_url() . '/CarDealer_show_room_2/');
        $CarDealer_search_type = 'search-widget';
    }
    $output = '<div class="' . $CarDealer_search_box . '">';
    $output .= '<div class="CarDealer-search-cuore"><div class="CarDealer-search-cuore-fields">
		<form method="get" id="searchform3" action="' . $current_page_url . '">';
    if (isset($page_id)) {
        if ($page_id <> '0') {
            $output .= '        <input type="hidden" name="page_id" value="' . $page_id .
                '" />';
        }
    }
    $showsubmit = false;
    // Make
    if( trim(get_option('CarDealer_show_make', 'yes')) == 'yes')
    {
        $showsubmit = true;
        $meta_make =   sanitize_text_field($_GET['meta_make']);
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Make', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= ' 
                            <select class="' . $selectboxmeta . '" name="meta_make">
    							<option ' . (($meta_make == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>';
        $atypes = car_get_types();
        // die(var_dump($atypes));
        $qtype = count($atypes);
        for ($i = 0; $i < $qtype; $i++) {
            $output .= '<option ' . (($meta_make == $atypes[$i]) ?
                'selected="selected"' : '') . '  value ="' . $atypes[$i] . '"> ' . $atypes[$i] .
                '</option>';
        }
        $output .= '</select></div>';
    }
    // Body Type
    if( trim(get_option('CarDealer_show_type', 'yes')) == 'yes')
    {
        $showsubmit = true;
        
        
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Car Type', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        if (isset($_GET['meta_type']))
            $meta_type = $_GET['meta_type'];
        else
            $meta_type = '';
            
        $output .= ' 
                            <select class="' . $selectboxmeta . '" name="meta_type">    						
                            	<option ' . (($meta_type == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>';
    
         
            
        $atypes = body_get_types();
        $qtype = count($atypes);
        for($i=0; $i < $qtype; $i++)
        {
            $output .= '<option ' . (($meta_type == $atypes[$i]) ? 'selected="selected"' : '') .
               '  value ="'.$atypes[$i].'"> ' .$atypes[$i] . '</option>';
        }      
    	$output .= '</select></div>';
        
        
        
        
    }
    
    
    
    
    // Price select
    if( trim(get_option('CarDealer_show_price', 'yes')) == 'yes' or $is_show_room == 0)
    {    
        $showsubmit = true;
        if ($is_show_room == '0') {
            $cardealer_meta_price = sanitize_text_field($_GET['meta_price']);
            $output .= '			<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Price', 'cardealer') .
                ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '                        <select class="' . $selectbox .
                '" name="meta_price">
    							<option ' . (($cardealer_meta_price == '') ? 'selected="selected"' : '') .
                ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_price == '1') ? 'selected="selected"' : '') .
                '  value ="1"> 0-10,000 </option>
    							<option ' . (($cardealer_meta_price == '2') ? 'selected="selected"' : '') .
                '  value ="2"> 10,000-20,000</option>
    							<option ' . (($cardealer_meta_price == '3') ? 'selected="selected"' : '') .
                '  value ="3"> 20,000-30,000 </option>
    							<option ' . (($cardealer_meta_price == '4') ? 'selected="selected"' : '') .
                '  value ="4"> 30,000-50,000</option>
    							<option ' . (($cardealer_meta_price == '5') ? 'selected="selected"' : '') .
                '  value ="5"> 50,000-75,000 </option>
    							<option ' . (($cardealer_meta_price == '6') ? 'selected="selected"' : '') .
                '  value ="6"> 75,000-100,000 </option>
    							<option ' . (($cardealer_meta_price == '7') ? 'selected="selected"' : '') .
                '  value ="7"> 100,000-125,000 </option>
    							<option ' . (($cardealer_meta_price == '8') ? 'selected="selected"' : '') .
                '  value ="8"> 125,000-150,000 </option>
    							<option ' . (($cardealer_meta_price == '9') ? 'selected="selected"' : '') .
                '  value ="9"> 150,000-200,000 </option>
    							<option ' . (($cardealer_meta_price == '10') ? 'selected="selected"' : '') .
                '  value ="10"> 200,000+ </option>
    						</select> 
    					</div>';
        }
    }    
    // year
    if( trim(get_option('CarDealer_show_year', 'yes')) == 'yes')
        {
        $showsubmit = true;
        $output .= ' 
    					<div class="' . $searchItem2 . '">
    						<span class="' . $searchlabel . '">' . __('Year', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '           <select class="' . $selectboxmeta . '" name="meta_year">
    							<option ' . (($_GET['meta_year'] == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>';
        $_year = date("Y");
        $w = 50;
        for ($i = 0; $i <= $w; $i++) {
            $year = $_year - $i;
            $output .= '<option ';
            $output .= ((sanitize_text_field($_GET['meta_year']) == $year) ?
                'selected="selected"' : '');
            $output .= 'value ="';
            $output .= $year;
            $output .= '">';
            $output .= $year;
            $output .= '</option>';
        }
        $output .= '</select>
    					</div><!--end of item -->';
     }                   
    // Cond
    if( trim(get_option('CarDealer_show_condition', 'yes')) == 'yes')
        { 
        $showsubmit = true;    
        if (isset($_GET['meta_con']))
            $cardealer_meta_con = sanitize_text_field($_GET['meta_con']);
        else
            $cardealer_meta_con = '';
        $cardealer_meta_con = sanitize_text_field($cardealer_meta_con);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('New/Used', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_con">
    							<option ' . (($cardealer_meta_con == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_con == 'New') ? 'selected="selected"' : '') .
            '  value ="New"> ' . __('New', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_con == 'Used') ? 'selected="selected"' : '') .
            '  value ="Used"> ' . __('Used', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_con == 'Damaged') ? 'selected="selected"' :
            '') . '  value ="Damaged"> ' . __('Damaged', 'cardealer') . '</option>
    						</select>  
    					</div>';
    }                
     // Transmission
     if( trim(get_option('CarDealer_show_transmission', 'yes')) == 'yes')
        { 
        $showsubmit = true;    
        if (isset($_GET['meta_trans']))
            $cardealer_meta_trans = sanitize_text_field($_GET['meta_trans']);
        else
            $cardealer_meta_trans = '';
        $cardealer_meta_trans = sanitize_text_field($cardealer_meta_trans);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Transmission', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_trans">
    							<option ' . (($cardealer_meta_trans == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_trans == 'Automatic') ? 'selected="selected"' : '') .
            '  value ="Automatic"> ' . __('Automatic', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_trans == 'Manual') ? 'selected="selected"' : '') .
            '  value ="Manual"> ' . __('Manual', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_trans == 'Tiptronic') ? 'selected="selected"' :
            '') . '  value ="Tiptronic"> ' . __('Tiptronic', 'cardealer') . '</option>
    						</select>  
    					</div>';                   
      }              
     // Fuel
     if( trim(get_option('CarDealer_show_fuel', 'yes')) == 'yes')
        {
        $showsubmit = true;    
        if (isset($_GET['meta_fuel']))
            $cardealer_meta_fuel = sanitize_text_field($_GET['meta_fuel']);
        else
            $cardealer_meta_fuel = '';
        $cardealer_meta_fuel = sanitize_text_field($cardealer_meta_fuel);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Fuel', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_fuel">
    							<option ' . (($cardealer_meta_fuel == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('Any', 'cardealer') . ' </option>
    							<option ' . (($cardealer_meta_fuel == 'Diesel') ? 'selected="selected"' : '') .
            '  value ="Diesel"> ' . __('Diesel', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_fuel == 'Gasoline') ? 'selected="selected"' : '') .
            '  value ="Gasoline"> ' . __('Gasoline', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_fuel == 'Hybrid') ? 'selected="selected"' : '') .
            '  value ="Hybrid"> ' . __('Hybrid', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_fuel == 'Electric') ? 'selected="selected"' : '') .
            '  value ="Electric"> ' . __('Electric', 'cardealer') . '</option>
     							<option ' . (($cardealer_meta_fuel == 'Biodiesel') ? 'selected="selected"' : '') .
            '  value ="Biodiesel"> ' . __('Biodiesel', 'cardealer') . '</option>       
      							<option ' . (($cardealer_meta_fuel == 'CNG') ? 'selected="selected"' : '') .
            '  value ="CNG"> ' . __('CNG', 'cardealer') . '</option>        
      							<option ' . (($cardealer_meta_fuel == 'Ethanol') ? 'selected="selected"' : '') .
            '  value ="Ethanol"> ' . __('Ethanol', 'cardealer') . '</option>        
    							<option ' . (($cardealer_meta_fuel == 'Other') ? 'selected="selected"' :
            '') . '  value ="Other"> ' . __('Other', 'cardealer') . '</option>
    						</select>  
    					</div>';  
    }
    
           // Order by
     
     if( trim(get_option('CarDealer_show_orderby', 'yes')) == 'yes')
        { 
        $showsubmit = true;    
        if (isset($_GET['meta_order']))
            $cardealer_meta_order = sanitize_text_field($_GET['meta_order']);
        else
            $cardealer_meta_order = '';
        $cardealer_meta_order = sanitize_text_field($cardealer_meta_order);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Order By', 'cardealer') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta . '" name="meta_order" style="min-width: 120px;">
    							<option ' . (($cardealer_meta_order == '') ? 'selected="selected"' : '') .
                                
                                
            ' value =""> ' . __('Any', 'cardealer') . ' </option>
            
            
    							<option ' . (($cardealer_meta_order == 'year_high') ? 'selected="selected"' : '') .
            '  value ="year_high"> ' . __('Year newest first', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'year_low') ? 'selected="selected"' : '') .
            '  value ="year_low"> ' . __('Year oldest first', 'cardealer') . '</option>
 

    							<option ' . (($cardealer_meta_order == 'price_high') ? 'selected="selected"' : '') .
            '  value ="price_high"> ' . __('Price higher first', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'price_low') ? 'selected="selected"' : '') .
            '  value ="price_low"> ' . __('Price lower first', 'cardealer') . '</option>


    							<option ' . (($cardealer_meta_order == 'mileage_high') ? 'selected="selected"' : '') .
            '  value ="mileage_high"> ' . __('Mileage higher first', 'cardealer') . '</option>
    							<option ' . (($cardealer_meta_order == 'mileage_low') ? 'selected="selected"' : '') .
            '  value ="mileage_low"> ' . __('Mileage lower first', 'cardealer') . '</option>
 
 
 
    						</select>  
    					</div>';                   
      } 
      
      
    /////  slider Price /////
      if( trim(get_option('CarDealer_show_price', 'yes')) == 'yes')
        { 
         $showsubmit = true;   
         $max_car_value = cardealer_get_max();
        if ($is_show_room <> '0') {
            $output .= '<div class="cardealer-price-slider">';
            $output .= '<span class="cardealerlabelprice">' . __('Price Range', 'cardealer') .
                ':</span>';
            $output .= '<input type="text" name="meta_price" id="meta_price" readonly>';
            // slider
            if ($is_show_room == '1')
                $output .= '<div id="cardealer_meta_price" class="cardealerslider" style="margin-top: -20px;"></div>';
            else
                $output .= '<div id="cardealer_meta_price" class="cardealerslider" style="margin-top: 0px;"></div>';
            $output .= '<input type="hidden" name="meta_price_max" id="meta_price_max" value="'.$max_car_value.'">';
            $price = sanitize_text_field($_GET['meta_price']);
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min" id="choice_price_min" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max" id="choice_price_max" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
        }
   }
    // Submit
    if($showsubmit)
    {
        $output .= '<div class="CarDealer-submitBtnWrap"> 
    						<input type="hidden" name="CarDealer_post_type" value="cars" />
    						<input type="submit" name="submit" id="' . $CarDealersubmitwrap .
            '" value=" ' . __('Search', 'cardealer') . '" />
    					</div> 
                        <!--end of item -->';
        $output .= '<input type="hidden" name="postNumber" value="' . $postNumber .
            '" />';
        $output .= '<input type="hidden" name="CarDealer_search_type" value="' . $CarDealer_search_type . '" />';
    }
    $output .= '</form></div></div></div>  <!-- end of Basic -->';
    return $output;
} ?>