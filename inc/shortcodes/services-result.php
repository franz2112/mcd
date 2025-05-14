<?php 
/**
 * Shortcode to display before and after images with titles and descriptions.
 * This shortcode fetches data from ACF fields and displays them in a slider format.
 *
 * @return string HTML output of the before and after images with titles and descriptions.
 */
function display_services_result() {
    ob_start();
    $acf_title = get_field('before_and_after_title');
    $has_rows = have_rows('before_and_after_items');
    $valid_rows = [];

    if ($has_rows) {
        while (have_rows('before_and_after_items')) : the_row();
            $before_image = get_sub_field('before_image');
            $after_image  = get_sub_field('after_image');
            $title        = get_sub_field('title');
            $desc         = get_sub_field('description');

            if (!empty($before_image) || !empty($after_image) || !empty($title) || !empty($desc)) {
                $valid_rows[] = [
                    'before_image' => $before_image,
                    'after_image'  => $after_image,
                    'title'        => $title,
                    'desc'         => $desc,
                ];
            }
        endwhile;
    }

    if (!empty($acf_title) && !empty($valid_rows)) : ?>
        <div class="services-slider-slick mcd-slider">
            <?php
            foreach ($valid_rows as $row) {
                get_template_part('template-parts/before-after-slider', null, [
                    'before_image'  => $row['before_image'],
                    'after_image'   => $row['after_image'],
                    'title'         => $row['title'],
                    'desc'          => $row['desc'],
                    'service_title' => get_the_title(),
                ]);
            }
            ?>
        </div>
    <?php else : ?>
        <div class="services-result-fallback">
            <p>No data available at the moment.</p>
        </div>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('services_result_display', 'display_services_result');
