<?php
/**
 * Display specialists with shortcode attributes.
 * 
 * Usage: [specialists_list count="3" show_name="true" show_position="false"  layout="grid or row"] 
 * 
 * @param array $atts Shortcode attributes.
 * @return string
 */
function display_specialists($atts) {
    $atts = shortcode_atts([
        'count' => -1,
        'show_name' => 'true',
        'show_position' => 'true',
        'about_page_id' => 2,
        'layout' => 'grid', 
    ], $atts, 'specialists_list');

    $show_name = filter_var($atts['show_name'], FILTER_VALIDATE_BOOLEAN);
    $show_position = filter_var($atts['show_position'], FILTER_VALIDATE_BOOLEAN);
    $count = intval($atts['count']);
    $about_page_id = intval($atts['about_page_id']);
    $layout = $atts['layout'];

    if ($layout === 'grid') {
        $wrapper_style = 'display: grid; grid-template-columns: repeat(2, 1fr);';
    } else {
        $wrapper_style = 'display: flex; flex-direction: row;';
    }

    if (have_rows('specialist', $about_page_id)) {
        $output = '<div class="specialists-wrapper" style="' . esc_attr($wrapper_style) . '">';
        $i = 0;
        while (have_rows('specialist', $about_page_id)) : the_row();
            if ($count !== -1 && $i >= $count) {
                break;
            }
            $name = get_sub_field('specialist_name');
            $position = get_sub_field('specialist_position');
            $image = get_sub_field('specialist_image');
            $image_url = is_array($image) ? $image['url'] : $image;

            $output .= '<div class="specialists">';
            if ($image_url) {
                $output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($name) . '">';
            }
            if ($show_name && $name) {
                $output .= '<h5>' . esc_html($name) . '</h5>';
            }
            if ($show_position && $position) {
                $output .= '<p>' . esc_html($position) . '</p>';
            }
            $output .= '</div>';
            $i++;
        endwhile;
        $output .= '</div>';
    } else {
        $output = '<p>No specialists found.</p>';
    }
    return $output;
}
add_shortcode('specialists_list', 'display_specialists');


?>