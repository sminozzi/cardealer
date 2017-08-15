jQuery(document).ready(function($) {
  var max =  $("#meta_price_max").val();
  var choice_price_min = $("#choice_price_min").val();
  var choice_price_max = $("#choice_price_max").val();  
  if( typeof choice_price_min === 'undefined' || typeof choice_price_min === 'undefined' )
     {
       choice_price_min = 0;
       choice_price_max = max;      
     }
  $("#cardealer_meta_price").slider({
     range: true,
     step: 100, 
     min: 0, 
     max: max, 
     values: [choice_price_min, choice_price_max], 
     slide: function(event, ui) {
        $("#meta_price").val(ui.values[0] + " - " + ui.values[1]);}
  });
   $("#meta_price").val($("#cardealer_meta_price").slider("values", 0) + 
      " - " + $("#cardealer_meta_price").slider("values", 1));
});