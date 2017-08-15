<?php /**
 * @author William Sergio Minossi
 * @copyright 2016
 */

add_action('wp_enqueue_scripts', 'CarDealerregister_contact_form');

function CarDealerregister_contact_form()
{
    wp_register_script('contact-form', CARDEALERURL.'includes/contact-form/js/car-contact-form.js', array('jquery'), null, true);
    wp_enqueue_script('contact-form');
} ?>