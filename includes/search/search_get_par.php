<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
 
if(isset($_GET['meta_order']))
  $order = sanitize_text_field($_GET['meta_order']);
else
  $order = '';
  
if(isset($_GET['meta_year']))
  $year = sanitize_text_field($_GET['meta_year']);
else
  $year = '';

if(isset($_GET['meta_con']))  
  $con = sanitize_text_field($_GET['meta_con']);
else
  $con = '';
  
if(isset($_GET['meta_type']))    
   $typecar = sanitize_text_field($_GET['meta_type']);
else
  $typecar = '';

if(isset($_GET['meta_make']))     
 $make = sanitize_text_field($_GET['meta_make']);
else
 $make = '';
 
if(isset($_GET['meta_price']))  
   $price = sanitize_text_field($_GET['meta_price']);
else
  $price = '';
  
if(isset($_GET['meta_trans']))  
 $trans = sanitize_text_field($_GET['meta_trans']);
else
 $trans = '';
 
if(isset($_GET['meta_fuel']))  
 $fuel = sanitize_text_field($_GET['meta_fuel']);
else
 $fuel = '';
 
$pos = strpos($price, '-');
if($pos !== false)
 {
    $priceMin = trim(substr($price, 0, $pos-1));
    $priceMax = trim(substr($price, $pos+1));
 }
 
if ($price != '') {
    if ($price == '1') {
        $priceMin = '';
        $priceMax = 10000;
    } elseif ($price == '2') {
        $priceMin = 10000;
        $priceMax = 20000;
    } elseif ($price == '3') {
        $priceMin = 20000;
        $priceMax = 30000;
    } elseif ($price == '4') {
        $priceMin = 30000;
        $priceMax = 50000;
    } elseif ($price == '5') {
        $priceMin = 50000;
        $priceMax = 75000;
    } elseif ($price == '6') {
        $priceMin = 75000;
        $priceMax = 100000;
    } elseif ($price == '7') {
        $priceMin = 100000;
        $priceMax = 125000;
    } elseif ($price == '8') {
        $priceMin = 125000;
        $priceMax = 150000;
    } elseif ($price == '9') {
        $priceMin = 150000;
        $priceMax = 200000;
    } elseif ($price == '10') {
        $priceMin = 200000;
        $priceMax = 9999999999;
    }
} elseif ($price == '') {
    $priceMax = 9999999999;
    $priceMin = '';
}
$priceMin = (int)$priceMin;
$priceMax = (int)$priceMax;

if ($con != '') {
    $conKey = 'key';
    $conVal = 'value';
    $conName = 'car-con';
    $con = $con;
}
else{
    
    $conKey = '';
    $conVal = '';
    $conName = '';
    $con = '';
}

if ($typecar != '') {
    $typeKey = 'key';
    $typeVal = 'value';
    $typeName = 'car-type';
    $typecar = $typecar;
}
else
{
    $typeKey = '';
    $typeVal = '';
    $typeName = '';
    $typecar = '';
}
if ($make != '') {
    $makeKey = 'key';
    $makeVal = 'value';
    $makeName = 'car-make';
    $make = $make;
}
else
{
    $makeKey = '';
    $makeVal = '';
    $makeName = '';
    $make = '';    
    
    
}
if ($year != '') {
    $yearKey = 'key';
    $yearVal = 'value';
    $yearName = 'car-year';
    $year = $year;
}
else
{
    $yearKey = '';
    $yearVal = '';
    $yearName = '';
    $year = '';
}

if ($trans != '') {
    $transKey = 'key';
    $transVal = 'value';
    $transName = 'transmission-type';
    $trans = $trans;
}
else
{
    $transKey = '';
    $transVal = '';
    $transName = '';
    $trans = '';
}

if ($fuel != '') {
    $fuelKey = 'key';
    $fuelVal = 'value';
    $fuelName = 'car-fuel';
    $fuel = $fuel;
}
else
{
    $fuelKey = '';
    $fuelVal = '';
    $fuelName = '';
    $fuel = '';
}


