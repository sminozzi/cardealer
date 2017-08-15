var messageDelay = 3000;  
jQuery( init_CarDealer_form );
   
function init_CarDealer_form() {

   jQuery('#CarDealer_contactForm').hide().submit( submitForm ).addClass( 'CarDealer_positioned' );
   
   jQuery('#CarDealer_sendingMessage').hide(); 
   jQuery('#CarDealer_successMessage').hide(); 
   jQuery('#CarDealer_failureMessage').hide();     
   jQuery('#CarDealer_incompleteMessage').hide();   
  
   jQuery("#CarDealer_cform").click( function() {
    
      //  jQuery('#content2').fadeTo( 'slow', .2 );
       
       jQuery('#CarDealer_contactForm').css('opacity', '1');
                   
       jQuery('#CarDealer_contactForm').fadeIn( 'slow', function() {
          jQuery('#CarDealer_senderName').focus();
    } )
   

    return false;
  } );
  
  // When the "Cancel" button is clicked, close the form
  jQuery('#CarDealer_cancel').click( function() { 
    jQuery('#CarDealer_contactForm').fadeOut();
    jQuery('#content2').fadeTo( 'slow', 1 );
  } );  

  // When the "Escape" key is pressed, close the form
  jQuery('#CarDealer_contactForm').keydown( function( event ) {
    if ( event.which == 27 ) {
      jQuery('#CarDealer_contactForm').fadeOut();
      jQuery('#content2').fadeTo( 'slow', 1 );
    }
  } );

}


// Submit the form via Ajax

function submitForm() {
  var CarDealer_contactForm = jQuery(this);

  // Are all the fields filled in?

  if ( !jQuery('#CarDealer_senderName').val() || !jQuery('#CarDealer_senderEmail').val() || !jQuery('#CarDealer_sendermessage').val() ) {


    // No; display a warning message and return to the form
    jQuery('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
    CarDealer_contactForm.fadeOut().delay(messageDelay).fadeIn();

  } else {

    jQuery('#CarDealer_sendingMessage').fadeIn();
    CarDealer_contactForm.fadeOut();
    
    

    jQuery.ajax( {
        
      url: CarDealer_contactForm.attr( 'action' ) + "?ajax=true",
      type: CarDealer_contactForm.attr( 'method' ),
      data: CarDealer_contactForm.serialize(),
      success: submitFinished
    } );
  }

  // Prevent the default form submission occurring
  return false;
}


// Handle the Ajax response

function submitFinished( response ) {
  response = jQuery.trim( response );

  jQuery('#CarDealer_sendingMessage').fadeOut();

  if ( response == "success" ) {

    // Form submitted successfully:
    // 1. Display the success message
    // 2. Clear the form fields
    // 3. Fade the content back in
    
    jQuery('#CarDealer_successMessage').fadeIn().delay(messageDelay).fadeOut();
    jQuery('#CarDealer_senderName').val( "" );
    jQuery('#CarDealer_senderEmail').val( "" );
    jQuery('#CarDealer_sendermessage').val( "" );

    jQuery('#content2').delay(messageDelay+1000).fadeTo( 'slow', 1 );

  } else {
    
    // Form submission failed: Display the failure message,
    // then redisplay the form
    jQuery('#CarDealer_failureMessage').fadeIn().delay(messageDelay).fadeOut();
    jQuery('#CarDealer_contactForm').delay(messageDelay+1000).fadeIn();
  }
}
