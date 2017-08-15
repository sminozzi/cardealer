<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
$atypes = body_get_types();
$meta_box['cars'] = array( 
		'id' => 'listing-details', 
		'title' => __('Car Details','cardealer'), 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array( 
			array(
				'name' => 'Price',
				'desc' => __('No special characters here ("$" "," "."), the plugin will auto format the number.', 'cardealer'),
				'id' => 'car-price',
				'type' => 'text',
				'default' => ''
			),
            array(
				'name' => 'Model',
				'desc' => __('Model', 'cardealer'),
				'id' => 'car-model',
				'type' => 'text',
				'default' => ''
			),
            
			array(
				'name' => 'Featured',
				'desc' => __('Mark to show up at Featured Widget.', 'cardealer'),
				'id' => 'car-featured',
				'type' => 'checkbox'
				),
			array(
				'name' => 'Year',
				'desc' => __('The year of the model. Only numbers, no point, no comma.', 'cardealer'),
				'id' => 'car-year',
				'type' => 'text',
				'default' => ''
			),
             array(
            'name' => 'HP',
            'desc' => __('Engine HP. Only numbers, no point, no comma.', 'cardealer'),
            'id' => 'car-hp',
            'type' => 'text',
            'default' => ''),
			 array(
				'name' => 'Engine',
				'desc' => __('Engine.', 'cardealer'),
				'id' => 'car-engine',
				'type' => 'text',
				'default' => ''				
				),
			array(
				'name' => 'Condition',
				'desc' => __('The amount of miles on this car . Only numbers, no point, no comma.', 'cardealer'),
				'id' => 'car-con',
				'type' => 'select',
				'options' => array (
				'New' => __('New',  'cardealer'),
				'Used' => __('Used',  'cardealer'),
				'Damaged' => __('Damaged',  'cardealer'), 
				),
				'default' => ''
			),
       			array(        
            'name' => 'Body Type',
			'desc' => __('Car Body Type.', 'cardealer'),
            'id' => 'car-type',
            'type' => 'select',
            'options' => $atypes,              
				),
            	array(
				'name' => get_option("CarDealer_measure", "Miles"),
				'desc' => __('The amount of '.get_option("CarDealer_measure", "Miles").' on the engine. Only numbers, no point, no comma.', 'cardealer'),
				'id' => 'car-miles',
				'type' => 'text',
				'default' => ''
			),
            array(
				'name' => 'Body Color',
				'desc' => __('Body Color'). get_option('CarDealer_color', 'Feet') . '.' . __('Only numbers. No point, no comma.' , 'cardealer'),
				'id' => 'body_color',
				'type' => 'text',
				'default' => ''
			    ),
			array(
				'name' => 'Passenger Capacity',
				'desc' => __('Passenger Capacity. Only numbers.', 'cardealer'),
				'id' => 'car-capacity',
				'type' => 'text',
				'default' => ''				
				),								
			array(
				'name' => 'Transmission',
				'desc' => __('What kind of Transmission is this', 'cardealer'),
				'id' => 'transmission-type',
				'type' => 'select',
				'options' => array (
				'Automatic' => __('Automatic', 'cardealer'),
				'Manual' => __('Manual', 'cardealer'),
				'Tiptronic' => __('Tiptronic' , 'cardealer')
				)),
       			array(        
				'name' => 'Fuel Type',
				'desc' => __('Fuel Type.', 'cardealer'),
				'id' => 'car-fuel',
				'type' => 'select',
				'options' => array (
				'Diesel' => __('Diesel', 'cardealer'),
				'Gasoline' => __('Gasoline', 'cardealer'),
				'Hybrid' => __('Hybrid', 'cardealer'),
				'Eletric' => __('Electric', 'cardealer'),
				'Biodiesel' => __('Biodiesel', 'cardealer'),
    			'CNG' => __('CNG', 'cardealer'),
        		'Ethanol' => __('Ethanol', 'cardealer'),
            	'Other' => __('Other', 'cardealer')
				)),
			array(
				'name' => 'Interior Color',
				'desc' => __('Color of the Interior', 'cardealer'),
				'id' => 'car-int',
				'type' => 'text',				
				'default' => ''
			),
			array(
				'name' => 'Interior Material',
				'desc' => __('Interior Material', 'cardealer'),
				'id' => 'car-mat',
				'type' => 'text',				
				'default' => ''
			) 
		)
	);
add_action('admin_menu', 'cardealer_listing_add_box');
update_option( 'meta_boxes', $meta_box );
function cardealer_listing_add_box() {
	global $meta_box;
	foreach($meta_box as $post_type => $value) {
		add_meta_box($value['id'], $value['title'], 'cardealer_listing_format_box', $post_type, $value['context'], $value['priority']);
	}
}
function cardealer_listing_format_box() {
	global $meta_box, $acardealer_features, $post;
    wp_enqueue_style('meta', CARDEALERURL.'includes/post-type/meta.css'); 
            /*
            Convenience
            Confort
            Entertainement
            */
            	 ?>
    		<div class="metabox-tabs-div">
			<ul class="metabox-tabs" id="metabox-tabs">
				<li class="active Specs"><a class="active" href="javascript:void(null);"><?php echo __('Specs', 'cardealer') ?></a></li>
				<li class="Features"><a href="javascript:void(null);"><?php echo __('Features', 'cardealer') ?></a></li>
			</ul>
			<div class="Specs">
				<h4 class="heading"><?php echo __('Specs', 'cardealer') ?></h4>             
 <?php
	echo '<input type="hidden" name="listing_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	foreach ($meta_box[$post->post_type]['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		$title = $field['name'];
		echo '<div class="boxes">'.
		'<div class="box-label"><label for="'. $field['id'] .'">'. $title = str_replace("_", " ",$title) . '</label></div>'.
		'<div class="box-content"><p>';
		switch ($field['type']) {
			case 'roomArea':
				echo '<div class="roomArea"></div>';
				break;
			case 'newArea':
				echo '<div class="newArea"></div>';
				break;
			case 'saveBTN':
				echo '<a id="geocode" class="button">Save Address</a>';
				break;
			case 'mapPre':
				echo '<div id="addresspreview" style="float: right; width: 200px; height: 140px; border: 1px solid #DFDFDF;"></div>';
				break;
				case 'address':
				echo '<label for ="'. $field['id']. '" </label>';
				echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				break;
			case 'text':
           	    echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" class="'. $field['name'] .'" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
				break;
			case 'select':
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] .  '" class="'. $field['name'] .'">';
				foreach ($field['options'] as $option) {
					echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
				}
				echo '</select>';
                echo '<br />';
                echo $field['desc'];
				break;
			case 'tagging':
				echo '<input type="text" name="'. $field['id']. '" class="'. $field['name'] .'" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
				foreach ($field['options'] as $option) {
					echo '<div class="tag-click-'.$field['id'].'" id="'.$option.'">'.$option .' </div>';
				}
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
				}
				break;
			case 'checkbox':
				echo '<div class = "checkboxSlide">';
				echo '<input type="checkbox" class="'. $field['name'] .'" value="enabled" name="' . $field['id'] . '" id="CheckboxSlide"' . ( $meta ? ' checked="checked"' : '' ) . '<br />'. $field['desc'];
			  	echo '</div>';
				break;
			case 'checkbox-custom':
				echo '<div class = "checkboxSlide2">';
				echo '<input type="checkbox" class="'. $field['name'] .'" value="enabled" name="' . $field['id'] . '" id="CheckboxSlide2"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
				echo '</div>';
				break;
			case 'room':
				echo '<div class="add">ADD </div>';
				echo '<div class="remove">REMOVE</div>';
				echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '" class="'. $field['name'] . '">';
				foreach ($field['options'] as $option) {
					echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option> ' ;
				}
				echo '</select>';
				break;				
		}
		echo       '</div> </div>';
	}
  echo '<div class="clear"> </div></div>';
  
  
  $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
  if( empty($cardealer_features))
    {
       
       echo '<br />';
       echo '<br />';
       echo  __('Add any Feature Field (Settings => Field Features)', 'cardealer');
       echo '<br />';
        echo '<br />';    
   }
    else
    {
        $acardealer_features = explode(PHP_EOL, $cardealer_features);
        $qnew = count($acardealer_features);
        
        echo '<div class="Features">';
        echo '<h4 class="heading">'.__('Features', 'cardealer').'</h4>';
  
    	for($i=0; $i < $qnew; $i++)
        {
    		$title = $acardealer_features[$i];
            $field_name =  trim($acardealer_features[$i]);
            
            $field_name = str_replace(' ','_',$field_name);
            
            if(empty($field_name))
                continue;
            
            $field_id = 'car_'.$field_name;
            $post_id = trim($post->ID);
            $meta = trim(get_post_meta($post_id, $field_id, true));
           
           
    		echo '<div class="boxes">'.
    		'<div class="box-label"><label for="'. $field_name .'">'. $title = str_replace("_", " ",$title) . '</label></div>'.
    		'<div class="box-content"><p>';
            
            echo '<input type="text" name="'. $field_id. '" class="'. $field_name .'" id="'. $field_id .'" value="'. $meta. '" size="30" style="width:97%" />'. '<br />'. '';
            
            echo '</div> </div>';
          
	}
        echo '<div class="clear"> </div>';
        ?>
        			</div>
        		</div>
        <?php
  } // not empty ...
} // end function listing_format_box
add_action('save_post', 'CarDealer_listing_save_data');
function CarDealer_listing_save_data($post_id) {
    global $meta_box,  $post, $acardealer_features;
    if( !is_object($post) ) 
     return;
    if(! isset($meta_box[$post->post_type]['fields']))
    {
        return;
    }
    //Verify nonce
    if( isset($_POST['listing_meta_box_nonce']))
    {
        if (!wp_verify_nonce($_POST['listing_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }
    //Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    //Check permissions
 if( isset($_POST['post_type']) )
  {
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
  }
  else
    return;
    foreach ($meta_box[$post->post_type]['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        if(    isset($_POST[$field['id']])      )
            {$new = sanitize_text_field($_POST[$field['id']]);}
        else
           {$new = '';}
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
    //Save Features
    $cardealer_features = trim(get_option( 'cardealer_fieldfeatures' ));
    if(empty($cardealer_features))
      return;
    $acardealer_features = explode(PHP_EOL, $cardealer_features);
    $qnew = count($acardealer_features);
    for($i=0; $i < $qnew; $i++)
    {
        $field_name =  trim($acardealer_features[$i]);
        $field_name = str_replace(' ','_',$field_name);
        $field_id = 'car_'.$field_name;
        $old = get_post_meta($post_id, $field_id, true); 
        $new = sanitize_text_field($_POST[$field_id]);
        if ($new && $new != $old) {
            update_post_meta($post_id, $field_id, $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field_id, $old);
        }  
    }  // end fornext 
}