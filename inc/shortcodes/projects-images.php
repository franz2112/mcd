<?php
/**
 * Displays the Content of the Result Section
 * @return string
 */
function project_images_shortcode($atts) {
    ob_start();

    $post_id = get_the_ID();
    $has_valid_images = false;
    $image_output = '';

    if (have_rows('project_images', $post_id)) {
        while (have_rows('project_images', $post_id)) {
            the_row();
            $image_one = get_sub_field('project_image_one');
            $image_two = get_sub_field('project_image_two');

            // Check if at least one image exists
            if (!empty($image_one) || !empty($image_two)) {
                $has_valid_images = true;
                if (!empty($image_one)) {
                    $image_output .= '<div class="image-wrapper"><img src="' . esc_url($image_one['url']) . '" alt="' . esc_attr($image_one['alt']) . '"></div>';
                }
                if (!empty($image_two)) {
                    $image_output .= '<div class="image-wrapper"><img src="' . esc_url($image_two['url']) . '" alt="' . esc_attr($image_two['alt']) . '"></div>';
                }
            }
        }
    }

    if ($has_valid_images) {
        echo '<div class="project-images">';
        echo $image_output;
        echo '</div>';
    }

    return ob_get_clean();
}
add_shortcode('project_images', 'project_images_shortcode');
?>
