<?php 
function projects_before_after_slider($atts) {
    ob_start();

    $post_id = get_queried_object_id();
    $selected_services = get_field('project_services_tags', $post_id);
    if (!empty($selected_services)) {
        if (!is_array($selected_services)) {
            $selected_services = [$selected_services];
        }

        if (is_object($selected_services[0])) {
            $selected_services_ids = wp_list_pluck($selected_services, 'ID');
        } else {
            $selected_services_ids = $selected_services;
        }
    }

    $args = [
        'post_type' => 'services',
        'posts_per_page' => 9,
    ];

    if (!empty($selected_services_ids)) {
        $args['post__in'] = $selected_services_ids;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <div class="services-slider-slick mcd-slider">
            <?php while ($query->have_posts()) : $query->the_post(); 
                if (have_rows('before_and_after_items')) :
                    while (have_rows('before_and_after_items')) : the_row();
                        $before_image = get_sub_field('before_image');
                        $after_image  = get_sub_field('after_image');
                        $title        = get_sub_field('title');
                        $desc         = get_sub_field('description');

                        get_template_part('template-parts/before-after-slider', null, [
                            'before_image'  => $before_image,
                            'after_image'   => $after_image,
                            'title'         => $title,
                            'desc'          => $desc,
                            'service_title' => get_the_title(),
                        ]);
                    endwhile;
                endif;
            endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <div class="services-result-fallback">
            <p>No before and after results found.</p>
        </div>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('projects_before_after_slider_display', 'projects_before_after_slider');

?>