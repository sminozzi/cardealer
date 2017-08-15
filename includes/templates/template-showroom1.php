<?php /**
 * @author Bill Minozzi
 * @copyright 2016
 */
function cardealer_show_cars($atts)
{
    if (isset($atts['type'])) {
        $car_type = trim($atts['type']);
    } else {
        $car_type = '';
    }
    if (isset($atts['option'])) {
        $car_option = trim($atts['option']);
    } else {
        $car_option = 'DESC';
    }
    if (isset($atts['pagination'])) {
        $car_pagination = trim($atts['pagination']);
    } else {
        $car_pagination = 'yes';
    }
    if (isset($atts['search'])) {
        $car_show_search = trim($atts['search']);
    } else {
        $car_show_search = 'yes';
    }
    if (isset($atts['max'])) {
        $car_howmany_show = trim($atts['max']);
    } else {
        $car_howmany_show = '0';
    }
    if (isset($atts['option'])) {
        $CarDealer_option = trim($atts['option']);
    } else {
        $CarDealer_option = '';
    }
    $output = '<div id="car_content">';
    if (!isset($_GET['submit'])) {
        $_GET['submit'] = '';
    } else
        $submit = sanitize_text_field($_GET['submit']);
    if (isset($_GET['post_type'])) {
        $post_type = sanitize_text_field($_GET['post_type']);
    }
    if (isset($_GET['postNumber'])) {
        $postNumber = sanitize_text_field($_GET['postNumber']);
    }
    if (empty($postNumber)) {
        $postNumber = get_option('CarDealer_quantity', 6);
    }
    if ($car_howmany_show <> '0')
        $postNumber = $car_howmany_show;
    if ($car_show_search == 'yes')
        $output .= CarDealer_search(1);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    global $wp_query;
    wp_reset_query();
    if (isset($_GET['car_search_type'])) {
        require_once (CARDEALERPATH . 'includes/search/search_get_par.php');
        $args = array(
            'post_type' => 'cars',
            'showposts' => $postNumber,
            'paged' => $paged,
            'meta_query' => array(
                array(
                    $yearKey => $yearName,
                    $yearVal => $year,
                    ),
                array(
                    $fuelKey => $fuelName,
                    $fuelVal => $fuel,
                    ),
                array(
                    $transKey => $transName,
                    $transVal => $trans,
                    ),
                array(
                    'key' => 'car-price',
                    'value' => array($priceMin, $priceMax),
                    'type' => 'numeric',
                    'compare' => 'BETWEEN'),
                array(
                    $conKey => $conName,
                    $conVal => $con,
                    ),
                array(
                    $typeKey => $typeName,
                    $typeVal => $typecar,
                    ),
                ),
            );
    } else {
        // Shortcodes
        if ($car_option == 'lasts') {
            $args = array(
                'post_type' => 'cars',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'DESC');
        } elseif ($car_option == 'featureds') {
            $args = array(
                'post_type' => 'cars',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'meta_key' => 'car-featured',
                'meta_compare' => '!=',
                'meta_value' => '',
                'order' => 'DESC');
        } elseif ($car_type <> '') {
            $args = array(
                'post_type' => 'cars',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'meta_query' => array(array('key' => 'car-type', 'value' => $car_type), ),
                'order' => 'DESC');
        } else {
            $args = array(
                'post_type' => 'cars',
                'showposts' => $postNumber,
                'paged' => $paged,
                'orderby' => 'date',
                'order' => 'ASC');
        }
    }
    $wp_query = new WP_Query($args);
    $qposts = $wp_query->post_count;
    $ctd = 0;
    $output .= '<div class="carGallery">';
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $ctd++;
        $price = get_post_meta(get_the_ID(), 'car-price', true);
        if (!empty($price)) {
            $price = number_format_i18n($price, 0);
        }
        $image_id = get_post_thumbnail_id();
        if (empty($image_id)) {
            $image = CARDEALERIMAGES . 'image-no-available-800x400_br.jpg';
            $image = str_replace("-", "", $image);
        } else {
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
        }
        $thumb = CarDealer_theme_thumb($image, 800, 400, 'br'); // Crops from bottom right
        $hp = get_post_meta(get_the_ID(), 'car-hp', true);
        $year = get_post_meta(get_the_ID(), 'car-year', true);
        $fuel = get_post_meta(get_the_ID(), 'car-fuel', true);
        $transmission = get_post_meta(get_the_ID(), 'transmission-type', true);
        $miles = get_post_meta(get_the_ID(), 'car-miles', true);
        $output .= '<br /><div class="CarDealer_container17">';
        $output .= '<a href="' . get_permalink() . '">';
        $output .= '<div class="CarDealer_gallery_17">';
        $output .= '<img class="CarDealer_caption_img17" src="' . $thumb . '" alt="' .
            get_the_title() . '" />';
        $output .= '</div>';
        $output .= '<div class="carInfoRight17">';
        $output .= '<div class="carTitle17">' . get_the_title() . '</div>';
        $output .= '<div class="carInforightText17">';
        $output .= ($price <> '' ? cardealer_currency() . $price : __('Call for Price',
            'cardealer'));
        $output .= ($price <> '' ? '  -  ' : '');
        $output .= ($hp <> '' ? $hp . ' ' . __('HP', 'cardealer') . '   -   ' : '');
        $output .= ($year <> '' ? __('Year', 'cardealer') . ': ' . $year . '   -  ' : '');
        $output .= ($fuel <> '' ? __('Fuel', 'cardealer') . ': ' . $fuel . '   -  ' : '');
        $output .= ($transmission <> '' ? __('Transmission', 'cardealer') . ': ' . $transmission .
            '  -  ' : '');
        $output .= ($miles <> '' ? __('Miles', 'cardealer') . ': ' . $miles : '');
        
        $content_post = get_post(get_the_ID());
        $desc = strip_tags($content_post->post_content);
 
        $desc = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $desc);
        
        $output .= '<br>';
        $output .= substr($desc,0,100);
        if(substr($desc,100) <> '')
          $output .= '...';
          
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</div>';
    endwhile;
    $output .= '</div>';
    if ($car_pagination == 'yes') {
        $output .= '<div class="car_navigation">';
        $output .= '';
        ob_start();
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('Back', 'textdomain'),
            'next_text' => __('Onward', 'textdomain'),
            ));
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    wp_reset_query();
    if ($qposts < 1) {
        $output .= '<h4>' . __('Not Found !') . '</h4>';
    }
    return $output;
}
add_shortcode('car_dealer', 'cardealer_show_cars'); ?>