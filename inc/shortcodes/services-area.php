<?php
/**
 * Shortcode to display the "Services Area" section.
 * This function generates a dynamic HTML structure for displaying 
 * specific service areas based on Advanced Custom Fields (ACF) repeater fields.
 *
 * @return string The generated HTML content for the services area.
 */
function display_services_area() {
    ob_start();

    if (have_rows('services_specific_areas')) : ?>
        <div class="services-area">
            <?php while (have_rows('services_specific_areas')) : the_row(); 
                $image      = get_sub_field('specific_areas_image');
                $title      = get_sub_field('specific_areas_title');
                $desc       = get_sub_field('specific_areas_description');
                $details    = get_sub_field('specific_areas_details');
                $extra_des  = get_sub_field('services_extra_description');

                if (empty($image) && empty($title) && empty($desc) && empty($details) && empty($extra_des)) {
                    continue;
                }
                ?>
                <div class="area-item">
                    <div class="area-row">
                        <div class="area-col-left">
                            <?php if( $image ) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="area-col-right">
                            <?php if( $title ) : ?>
                                <h3><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if( $desc ) : ?>
                                <div class="area-item-desc">
                                    <?php echo $desc; ?>
                                </div>
                            <?php endif; ?>
                            <?php if( $details ) : ?>
                                <div class="area-item-details">
                                    <?php echo $details; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if( $extra_des ) : ?>
                        <div class="area-item-extra-desc">
                            <?php echo $extra_des; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('services_area_display', 'display_services_area');
?>
