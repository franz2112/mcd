<?php 
function homepage_before_after_slider() {
    ob_start();

    $args = [
        'post_type' => 'services',
        'posts_per_page' => 9,
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <div class="services-slider-slick mcd-slider">
            <?php while ($query->have_posts()) : $query->the_post(); 
                if (have_rows('before_and_after_items')) :
                    the_row();
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
                        'service_link'     => get_permalink(),
                        'is_homepage_call' => true,
                    ]);
                endif;
            endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <div class="services-result-fallback">
            <p>No Before and After Contents Found.</p>
        </div>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('homepage_before_after_slider', 'homepage_before_after_slider');
?>