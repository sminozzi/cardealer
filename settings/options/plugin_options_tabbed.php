<?php 
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
namespace cardealer\WP\Settings;

$mypage = new Page('Settings', array('type' => 'submenu2', 'parent_slug' => 'my-menu'));
   
$settings = array();


$msg = '<big>
<p><b>'.
__('Thanks for install car  Dealer Plugin. The easiest way to manage, list and sell your cars online.', 'cardealer')
.'<br /><br />
</b><font size="4">'.
__('Follow this steps', 'cardealer')
.':</p>
<p>&nbsp;</p>
<p>1.'.
__(' Go to car  Settings tab and choose your currency, metric system etc...', 'cardealer')
.' </font></p>
<p>&nbsp;</p>




<p><font size="4">2. '. 
__('Go to Field Features and add some fields. ', 'cardealer')
.'</font></p>'.
__('For example: wifi, gps, alarm and so on...', 'cardealer')
.'<br />'.
__('Click Update to Save', 'cardealer')
.'</p>
<p>&nbsp;</p>
<p><font size="4">




<p><font size="4">3. '. 
__('Go to Makes and add some makers. ', 'cardealer')
.'</font></p>'.
__('For example: Ford, Fiat, Volkswagen...', 'cardealer')
.'</p>
<p>&nbsp;</p>
<p><font size="4">




<p><font size="4">4. '. 
__('Go to Locations and add some, if you have more than one. This is Optional.', 'cardealer')
.'</font></p>
<p>&nbsp;</p>
<p><font size="4">





<p><font size="4">5. '. 
__('Go to your Pages and chose one (or more) page where you want show the cars. ', 'cardealer')
.'</font></p>
<br />'.
__('Paste this shortcode there', 'cardealer') 
.':&nbsp; &nbsp;  <b> [car_dealer] </b>
<p>'.
__('Click Update to Save', 'cardealer')
.'</p>

<p>&nbsp;</p>

<p><font size="4">


6. '.
__('Go to cars for Sale and Choose Add New', 'cardealer')
.'</font></p>
<p>
Dashboard =&gt; cars For Sale =&gt;Add New
</p>
<p>'.
__('Fill Out all info', 'cardealer')
.'</p>
<p>'.
__('Add one Featured Image', 'cardealer')
.'.</p>

<p>

<strong>'.
__('Load images ', 'cardealer')
.':</strong>
<br />'.
__('Just create one wordpress gallery. Our plugin will create automatically one nice slider gallery.
For details how to create a wordpress gallery, check the wordpress site.', 'cardealer')
.'<br />'.
__('Look our demo in our site how to upload and crop images (less than 2 minutes).','cardealer')

.'</p><p>'.

__("Don't forget to fill out the field price. Otherwise, the car does'n show up at search results.",'cardealer')

.'</p><p>'.

__('Click Publish to Save.', 'cardealer')
.'</p>



<p>&nbsp;</p>
<p><font size="4">7. '. 
__('We have 3 dedicated Widgets', 'cardealer')
.':</font></p>
<ul>
  <li>'.
__('  Recent cars', 'cardealer')
.'  </li>
  <li>' .
__('Featured cars', 'cardealer')
.'  </li>
  <li>' .
__('cars Search', 'cardealer')
.'  </li>
</ul>
<p>'.
__('To install, just go to ', 'cardealer')

.'Dashboard=&gt; Appearance=&gt; Widgets '. 

__('and install them', 'cardealer')
.'.</p>


<p>&nbsp;</p>
<p><font size="4">8. '. 
__('Permalinks', 'cardealer')
.':</font></p>
<p>'.
__('Set Permalinks to Post Name ', 'cardealer')

.'<br />(Dashboard=&gt; Settings=&gt; Permalink)' 

.'.</p>

<p>&nbsp;</p>




<p>&nbsp;</p>
<p><font size="4">';






$msg .= '<a href="http://cardealerplugin.com/help/" class="button button-primary">'.__("OnLine Guide","cardealer").'</a>';
$msg .= '&nbsp;&nbsp;';
$msg .= '<a href="http://cardealerplugin.com/faq/" class="button button-primary">'.__("Faq Page","cardealer").'</a>';
$msg .= '&nbsp;&nbsp;';
$msg .= '<a href="http://cardealerplugin.com" class="button button-primary">'.__("Support Page","cardealer").'</a>';




$msg .= '<p>&nbsp;</p>';


$msg .= 
__("That's all. I hope you enjoy it ", 'cardealer') ;

$msg .= '.</p> </big>' ;


$settings['StartUp Guide']['StartUp Guide'] = array('info' => $msg );
$fields = array();
 
       
$settings['StartUp Guide']['StartUp Guide']['fields'] = $fields;



$settings['car  Settings']['car  Settings'] = array('info' => __('Choose your currency, metric system and so on.','cardealer'));
$fields = array();


$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealercurrency',
	'label' => __('Currency', 'cardealer'),
	'select_options' => array(
		array('value'=>'Dollar', 'label' => 'Dollar'),
		array('value'=>'Euro', 'label' => 'Euro'),
		array('value'=>'AUD', 'label' => 'Australian Dollar'),
		array('value'=>'Pound', 'label' => 'Pound'),
		array('value'=>'Real', 'label' => 'Brazil Real'),
		array('value'=>'Yen', 'label' => 'Yen'),
		array('value'=>'Universal', 'label' => 'Universal')     
		)			
	);
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_measure',
	'label' => __('Miles - Km','cardealer'),
	'select_options' => array(
		array('value'=>'Miles', 'label' => __('Miles', 'cardealer')),
		array('value'=>'Kms', 'label' => __('Kms', 'cardealer')),
		array('value'=>'Hours', 'label' => __('Hours', 'cardealer'))
		)			
	);
    
    
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_liter',
	'label' => __('Liters - Gallons','cardealer'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'cardealer')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'cardealer')),
		)			
	);
    
 /*   
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'CarDealer_lenght',
	'label' => __('Feet - Meters','cardealer'),
	'select_options' => array(
		array('value'=>'Feet', 'label' => __('Feet', 'cardealer')),
		array('value'=>'Meters', 'label' => __('Meters', 'cardealer') ),
		)			
	);
 */
    
	$fields[] =	array(
            	'type' 	=> 'select',
				'name' => 'CarDealer_quantity',
				'label' => __('How many cars would you like to display per page?', 'cardealer'),
				'select_options' => array (
                		array('value'=>'3', 'label' => '3'),
	                	array('value'=>'6', 'label' => '6'),
                		array('value'=>'9', 'label' => '9'),
	                	array('value'=>'12', 'label' => '12'),
                		array('value'=>'15', 'label' => '15'),
	                	array('value'=>'18', 'label' => '18'),
	         	)
 	); 
    
/*
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Use dedicated Search Results Page').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),

		)			
	);


*/

$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Remove Sidebar from Search Result Page').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),

		)			
	);
 
 
 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),

		)			
	);   
    

$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'CarDealer_recipientEmail',
	'label' => __('Fill out your contact email to receive email from your Contact Form at bottom of the individual car page.' ,'cardealer')
    );   
 
 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_template_gallery',
	'label' => __('In Show Room Page, use Gallery or List View Template','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Gallery'),
		array('value'=>'no', 'label' => 'List View'),

		)			
	);  
 
 
 
 
 
 
 
$settings['car  Settings']['car  Settings']['fields'] = $fields;



$notificatin_msg = __('Here you can manage the car features/equipments fields to your car form.', 'cardealer');
$notificatin_msg .= '<br /><strong>';
$notificatin_msg .= __('Just add one or more field names - one for each line -', 'cardealer');
$notificatin_msg .= '</strong>';
$notificatin_msg .= '<br />';
$notificatin_msg .= __('For example: GPS, DVD, and so on... ', 'cardealer');
$notificatin_msg .= '<br />';
$notificatin_msg .= __('Don\'t use special characters.', 'cardealer');

 
$settings['Field Features']['Field Features'] = array('info' => $notificatin_msg );

$fields = array();  
$fields[] = array(
	'type' 	=> 'textarea',
	'name' 	=> 'cardealer_fieldfeatures',
 	'label' => __('Add this fields to Car Form. Only one field each line:', "cardealer"),
	);
    

        
$settings['Field Features']['']['fields'] = $fields;


 
 
$settings['Search Settings']['Search Settings'] = array('info' => __('Customize your Search Options. Choose the fields to show on the front end search bar.','cardealer'));
$fields = array();

 
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_make',
	'label' => __('Show the Make control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
    

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_fuel',
	'label' => __('Show the Fuel type control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 


 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_type',
	'label' => __('Show the Type Body control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	); 
    

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_year',
	'label' => __('Show the Year control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
    

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_condition',
	'label' => __('Show the Condition (new/used) control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);    
    

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_transmission',
	'label' => __('Show the Transmission control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);    

 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_price',
	'label' => __('Show the Price slider','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
 
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'CarDealer_show_orderby',
	'label' => __('Show the Order By Control','cardealer').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
             
       
$settings['Search Settings']['Search Settings']['fields'] = $fields;



$msg = '
<span style="font-size: 24pt; color: #CC3300;">Premium Features</span><font color="#CC3300">
</font>
<p><b><font size="4">Car Design Admin Setup Page</font></b><br />  <br />
  Unlimited Colours Setup to match your site theme.
  <br /> 
  Box to include CSS customized stuff</p>

<p>&nbsp;</p>
<p><b><font size="4">Screen to manage Body Type\'s table</font></b><br />  <br />
  Add your own types.<br>
  
   
<p>&nbsp;</p> 
<p><b><font size="4">Extra Shortcodes</font></b><br />  <br />
  Filter Cars for Type (You can manage the body type\'s table) <br>
  Last Cars<br /> 
  Featured Cars<br>
  Number of Cars to show<br>
  Show or Hide Pagination<br>
  Show or Hide Search Box<br>
  Order boats by Price/Year (Ascending/Descending)</p>
  <p>&nbsp;</p>
  <p><b><font size="4">Free Support and Install</font></b><br>
  For any question and problem, you can request a quickly support.</p>
';

$msg .= '
<p>&nbsp;</p>
<FORM>
<INPUT type="button" class= "button button-primary" value="Learn More" onClick="window.location=\'http://www.Cardealerplugin.com/premium/\'">
</FORM>';

$settings['Go Premium']['Go Premium'] = array('info' => $msg );
$fields = array();
        
$settings['Go Premium']['Go Premium']['fields'] = $fields;
    

new OptionPageBuilderTabbed($mypage, $settings);

