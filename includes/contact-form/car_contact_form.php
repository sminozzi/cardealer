<?php /**
 * @author William Sergio Minossi
 * @copyright 2016
 */

$aurl = CARDEALERURL . 'includes/contact-form/processForm.php';
$CarDealer_recipientEmail = trim(get_option('CarDealer_recipientEmail', ''));

if ( ! is_email($CarDealer_recipientEmail)) {
        $CarDealer_recipientEmail = '';
        update_option('CarDealer_recipientEmail', '');
    }

if (empty($CarDealer_recipientEmail))
    $CarDealer_recipientEmail = get_option('admin_email'); ?>


<form id="CarDealer_contactForm" action="<?php echo $aurl; ?>" method="post">

  <input type="hidden" name="CarDealer_recipientEmail" id="CarDealer_recipientEmail" value="<?php echo
$CarDealer_recipientEmail; ?>" />

  <input type="hidden" name="title" id="title" value="<?php echo the_title(); ?>" />

  <h2><?php 
  echo __('Request Information', 'cardealer'); 
  ?>...</h2>

  <ul>

    <li>
      <label for="CarDealer_senderName" class="CarDealer_contact" ><?php echo __('Your Name',
'cardealer'); ?>:&nbsp;</label>
      <input type="text" name="CarDealer_senderName" id="CarDealer_senderName" placeholder="<?php echo
__('Please type your name', 'cardealer'); ?>" required="required" maxlength="40" />
    </li>

    <li>
      <label for="CarDealer_senderEmail" class="CarDealer_contact"><?php echo __('Your Email',
'cardealer'); ?>:&nbsp;</label>
      <input type="email" name="CarDealer_senderEmail" id="CarDealer_senderEmail" placeholder="<?php echo
__('Please type your email', 'cardealer'); ?>" required="required" maxlength="50" />
    </li>

    <li>
      <label for="CarDealer_sendermessage" class="CarDealer_contact" style="padding-top: .5em;"><?php echo
__('Your Message', 'cardealer'); ?>:&nbsp;</label>
      <textarea name="CarDealer_sendermessage" id="CarDealer_sendermessage" placeholder="<?php echo
__('Please type your message', 'cardealer'); ?>" required="required"  maxlength="10000"></textarea>
    </li>

  </ul>

<br />



  <div id="formButtons">
    <input type="submit" id="CarDealer_sendMessage" name="sendMessage" value="<?php echo
__('Send', 'cardealer'); ?>" />
    <input type="button" id="CarDealer_cancel" name="cancel" value="<?php echo __('Cancel',
'cardealer'); ?>" />
  </div>

</form>


<div id="CarDealer_sendingMessage" class="CarDealer_statusMessage"><p>Sending your message. Please wait...</p></div>
<div id="CarDealer_successMessage" class="CarDealer_statusMessage"><p>Thanks for your message! We'll get back to you shortly.</p></div>
<div id="CarDealer_failureMessage" class="CarDealer_statusMessage"><p>There was a problem sending your message. Please try again.</p></div>
<div id="CarDealer_incompleteMessage" class="CarDealer_statusMessage"><p>Please complete all the fields in the form before sending.</p></div>

