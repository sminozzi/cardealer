<?php 
/*
Plugin Name: CarDealer 
Plugin URI: http://cardealerplugin.com
Description: Released 7/17 - Manage, list and sell cars and vehicles online. Slider Price Range, 2 templates (list view, gallery), configurable search box and more...
Version: 2.07
Text Domain: CarDealer
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License:     GPL2
Copyright (c) 2016 Bill Minozzi
cardealer is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
cardealer is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with cardealer. If not, see {License URI}.
Permission is hereby granted, free of charge subject to the following conditions:
The above copyright notice and this FULL permission notice shall be included in
all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
define('CARDEALERVERSION', '2.07');
define('CARDEALERPATH', plugin_dir_path(__file__));
define('CARDEALERURL', plugin_dir_url(__file__));
define('CARDEALERIMAGES', plugin_dir_url(__file__) . 'assets/images/');
function cardealer_plugin_settings_link($links)
{
    $settings_link = '<a href="edit.php?post_type=cars&page=settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__file__);
if (is_admin()) {
    function CarDealer_add_admstylesheet()
    {
        $color = get_user_meta(get_current_user_id(), 'admin_color', true);
        wp_enqueue_style('cardealer-metabox-tabs', CARDEALERURL .
            'includes/post-type/metabox-tabs.css');
        wp_enqueue_style("cardealer-$color", CARDEALERURL .
            'includes/post-type/metabox-$color.css');
        wp_enqueue_script('cardealer-metabox-tabs', CARDEALERURL .
            'includes/post-type/metabox-tabs.js', array('jquery'));
    }
    add_action('admin_print_styles-post.php', 'CarDealer_add_admstylesheet', 1000);
    add_action('admin_print_scripts-post-new.php', 'CarDealer_add_admstylesheet');
            $path = dirname(plugin_basename(__file__)) . '/language/';
            $loaded = load_plugin_textdomain('cardealer', false, $path);
            if (!$loaded and get_locale() <> 'en_US') {
                if (function_exists('CarDealer_localization_init_fail'))
                    add_action('admin_notices', 'CarDealer_localization_init_fail');
            }
} 
else {
    add_action('plugins_loaded', 'CarDealer_localization_init');
}
add_filter("plugin_action_links_$plugin", 'cardealer_plugin_settings_link');
require_once (CARDEALERPATH . "settings/load-plugin.php");
require_once (CARDEALERPATH . "settings/options/plugin_options_tabbed.php");
require_once (CARDEALERPATH . 'includes/help/help.php');
require_once (CARDEALERPATH . 'includes/functions/functions.php');
require_once (CARDEALERPATH . 'includes/post-type/meta-box.php');
require_once (CARDEALERPATH . 'includes/post-type/post-functions.php');
require_once (CARDEALERPATH . 'includes/templates/template-functions.php');
require_once (CARDEALERPATH . 'includes/templates/redirect.php');
require_once (CARDEALERPATH . 'includes/widgets/widgets.php');
require_once (CARDEALERPATH . 'includes/search/search-function.php');
$Cardealer_template_gallery = trim(get_option('CarDealer_template_gallery', 'yes'));
if($Cardealer_template_gallery == 'yes')
  require_once (CARDEALERPATH . 'includes/templates/template-showroom.php');
else
  require_once (CARDEALERPATH . 'includes/templates/template-showroom1.php');
  
require_once (CARDEALERPATH . 'includes/contact-form/contact-form.php');

$cardealerurl = $_SERVER['REQUEST_URI'];
    if (strpos($cardealerurl,'car') !== false) {
               $CarDealer_overwrite_gallery = strtolower(get_option('CarDealer_overwrite_gallery',
    'yes'));
               if($CarDealer_overwrite_gallery == 'yes')
                    require_once (CARDEALERPATH . 'includes/gallery/gallery.php');
     }
     
add_action('wp_enqueue_scripts', 'CarDealer_add_files');
function CarDealer_add_files()
{
    wp_enqueue_style('show-room', CARDEALERURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', CARDEALERURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', CARDEALERURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearch3', CARDEALERURL .
        'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', CARDEALERURL .
        'includes/gallery/css/flexslider.css');
    wp_enqueue_style('pluginStyleGeneral5', CARDEALERURL .
        'includes/contact-form/css/car-contact-form.css');
    wp_enqueue_script('jquery-ui-slider');
}
function CarDealer_activated()
{
    $w = update_option('CarDealer_activated', '1');
    if (!$w)
        add_option('CarDealer_activated', '1');   
    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('CarDealer_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('CarDealer_recipientEmail', $admin_email);
        if (!$w)
            add_option('CarDealer_recipientEmail', $admin_email);
    }
    $a = array('CarDealer_show_make',
    'CarDealer_show_type',
    'CarDealer_show_price',
    'CarDealer_show_year',
    'CarDealer_show_condition', 
    'CarDealer_show_transmission',
    'CarDealer_show_fuel',
    'CarDealer_show_orderby',
    'CarDealer_show_price' );
    $q = count($a);
    for($i = 0; $i < $q; $i++)
    {
        $x = trim(get_option($a[$i], ''));
        if($x != 'yes' and $x != 'no')
        {
            $w = update_option($a[$i], 'yes');
            if (!$w)
                add_option($a[$i], 'yes');
        }
    }    
}
register_activation_hook(__file__, 'CarDealer_activated');
function CarDealer_localization_init()
{
    $path = dirname(plugin_basename(__file__)) . '/language/';
    $loaded = load_plugin_textdomain('cardealer', false, $path);
} 
function cardealerplugin_load_feedback()
{
    if(is_admin())
    {
       // ob_start();
        require_once (CARDEALERPATH . 'includes/feedback/activated-manager.php');
        require_once (CARDEALERPATH . "includes/feedback/feedback.php");
        require_once (CARDEALERPATH . "includes/feedback/feedback-last.php");
    }  // ob_end_clean();
}
add_action( 'wp_loaded', 'cardealerplugin_load_feedback' );
?>