<?php
/**
 * @author Bill Minozzi
 * @copyright 2016
 */
if(is_admin())
{
    if(isset($_GET['post_type'])){
        if ($_GET['post_type'] == 'cars')
          {
              add_filter('contextual_help', 'CarDealer_contextual_help', 10, 3);
          }
    }
}  
function CarDealer_contextual_help($contextual_help, $screen_id, $screen)
{
    $myhelp = '<br> The easiest way to manage, list and sell your cars online.';
    $myhelp .= '<br />';
    $myhelp .= 'Take a look at our Start Up Guide <a href="/wp-admin/edit.php?post_type=cars&page=settings" target="_self">here.</a>';
    $myhelp .= '<br />';
    $myhelp .= 'You can find also our complete OnLine Guide  <a href="http://cardealerplugin.com/guide/" target="_self">here.</a>';
    $screen->add_help_tab(array(
        'id' => 'CarDealer-overview-tab',
        'title' => __('Overview', 'cardealer'),
        'content' => '<p>' . $myhelp . '</p>',
        ));
    return $contextual_help;
} 
?>