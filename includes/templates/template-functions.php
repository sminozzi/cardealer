<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
 function cardealer_content_detail (){?>
    <div class="car-content">
        <div id="sliderWrapper">
                 <?php 
                 $terms = get_the_terms( get_the_id(), 'makes');
                 
                 if(is_array($terms))
                    {
                        $term = $terms[0]; 
                         echo '<div class="featuredTitle">'; 
                         echo __('Make', 'cardealer').': ';  
                         echo esc_attr($term->name); 
                         
                         $model = trim(get_post_meta(get_the_ID(), 'car-model', 'true'));
                         if(! empty($model)) 
                         {
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo __('Model', 'cardealer').': ';  
                           echo $model;
                         } 
                           
                         echo '</div><br />';
                    
                    } 
                   else
                   {
                    
                        $model = trim(get_post_meta(get_the_ID(), 'car-model', 'true'));
                         if(! empty($model)) 
                         {
                           echo '<div class="featuredTitle">'; 
                           echo '&nbsp;&nbsp;&nbsp;';
                           echo __('Model', 'cardealer').': ';  
                          // echo esc_attr($term1->name);
                           echo $model;
                           echo '</div><br />'; 
                         } 
                          
                   }
                   
                   
                   
  
  
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 $term3 = $terms3[0]; 
                 
                 if(is_object($term3))
                    {
                         echo '<div class="featuredTitle">'; 
                         echo __('Location', 'cardealer').': ';  
                         echo esc_attr($term3->name); 
                         
                         echo '</div><br />';
                    
                    } 
                    
                                     
                   
                   
                   
                       
                 ?>
                 
                 
                 
                 
                 
                 
       
             <div class="featuredTitle"> 
             <?php echo __('Options', 'cardealer');?> </div>
             
             
             
  			 <div class="featuredCar">
             
             
             <?php if (get_post_meta(get_the_ID(), 'car-engine', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Engine', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-engine', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'car-body-type', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Body Type', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-body-type', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'body_color', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Body Color', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'body_color', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
              <?php if (get_post_meta(get_the_ID(), 'transmission-type', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Transmission', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'transmission-type', 'true');?> 
             </div><!-- End of featured list --><?php } ?> 
             <?php if (get_post_meta(get_the_ID(), 'car-fuel', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"><?php echo __('Fuel Type', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-fuel', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'car-fuel-capacity', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"><?php echo __('Fuel Capacity', 'cardealer');?> (<?php echo get_option('CarDealer_liter', 'Liters')?>): </span><?php echo get_post_meta(get_the_ID(), 'car-fuel-capacity', 'true');?> 
             </div><!-- End of featured list --><?php } ?>           
             <?php if (get_post_meta(get_the_ID(), 'LOA-mpg', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"><?php echo __('Lenght', 'cardealer');?> (<?php echo get_option('CarDealer_lenght', 'Feet')?>): </span><?php echo get_post_meta(get_the_ID(), 'LOA-mpg', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'car-capacity', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Passenger Capacity', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-capacity', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'car-int', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Interior Color', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-int', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             <?php if (get_post_meta(get_the_ID(), 'car-mat', 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo __('Interior Material', 'cardealer');?>: </span><?php echo get_post_meta(get_the_ID(), 'car-mat', 'true');?> 
             </div><!-- End of featured list --><?php } ?>
             </div><!-- End of featured car -->
             
             
             
             
             
             
       <div class="featuredTitle"> 
       <?php echo __('Features', 'cardealer');?> </div>     
       <div class="featuredCar">
    
         <?php
         
             $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
             $acardealer_features = explode(PHP_EOL, $cardealer_features);
             $qnew = count($acardealer_features);


	for($i=0; $i < $qnew; $i++)
    {
		$title = $acardealer_features[$i];
        $field_name =  trim($acardealer_features[$i]);
        $field_name = str_replace(' ','_',$field_name);
        
        $field_id = 'car_'.$field_name;
        $post_id = trim(get_the_ID()); // trim($post->ID);
        $meta = get_post_meta($post_id, $field_id, true);
        
        $field_name = str_replace('_',' ',$field_name);
        
        /*
		echo '<div class="boxes">'.
		'<div class="box-label"><label for="'. $field_name .'">'. $title = str_replace("_", " ",$title) . '</label></div>'.
		'<div class="box-content"><p>';
          	    echo '<input type="text" name="'. $field_id. '" class="'. $field_name .'" id="'. $field_id .'" value="'. $meta. '" size="30" style="width:97%" />'. '<br />'. '';
        echo '</div> </div>';
        */
        
         
             if (get_post_meta(get_the_ID(), $field_id, 'true') != '') { ?>
             <div class="featuredList">             
             <span class="carBold"> <?php echo $field_name;?>: </span><?php echo get_post_meta(get_the_ID(), $field_id, 'true');?> 
             </div><!-- End of featured list --><?php } 
             
     }    
         ?>    
                  
             
       </div><!-- End of featured bot -->           
             
             
             
      </div> <!-- end of Slider Content --> 
      </div> <!-- end of Slider Wrapper -->  
      
      
              
      <?php }
 function cardealer_content_info () { ?>
 <div class="contentInfo">
         <div class="carPriceSingle">
         	<?php 
            $price = get_post_meta(get_the_ID(), 'car-price', true);
                if (!empty($price))
                     {$price =   number_format_i18n($price,0);}
    		if ( $price <> '') {
    			echo cardealer_currency().$price;
    		}else {
    		 echo __('Call for Price', 'cardealer');	
    		}
    		?> 
         </div>
         <div class="carContent">
         	<?php the_content(); ?>
         </div>   
            <div class="carDetail">
            	<div class="carBasicRow"><span class="singleInfo"><?php echo __('Year', 'cardealer');?>: </span> <?php echo get_post_meta(get_the_ID(), 'car-year', 'true'); ?></div>
                <div class="carBasicRow"><span class="singleInfo"><?php echo __(get_option('CarDealer_measure', 'Miles'), 'cardealer')?>: </span> <?php echo get_post_meta(get_the_ID(), 'car-miles', 'true'); ?></div>
                <div class="carBasicRow"><span class="singleInfo"><?php echo __('Cond', 'cardealer');?>: </span> <?php echo get_post_meta(get_the_ID(), 'car-con', 'true'); ?></div>
                <div class="carBasicRow"><span class="singleInfo"><?php echo __('HP', 'cardealer');?>:&nbsp; </span> <?php echo get_post_meta(get_the_ID(), 'car-hp', 'true'); ?></div>
            </div>
 </div>	 
 <?php }
function cardealer_car_detail() {
  echo '<div class="car-content">';
	while ( have_posts() ) : the_post(); 
     cardealer_title_detail();
      cardealer_content_info (); 
      ?> 
     <div class="carcontentWrap">
	 <?php cardealer_content_detail (); ?>
     </div><?php
     return;
	 endwhile; // end of the loop.
     echo '</div>';
}
function cardealer_title_detail(){ ?>
    <div class="car-detail-title">  <?php the_title(); ?> </div>
<?php }
require_once(CARDEALERPATH . "assets/php/cardealer_mr_image_resize.php");
function CarDealer_theme_thumb($url, $width, $height=0, $align='') {
        if (get_the_post_thumbnail()=='') {
    	  	$url = CARDEALERIMAGES.'image-no-available.jpg';
		}
       return cardealer_mr_image_resize($url, $width, $height, true, $align, false);
}