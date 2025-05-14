<?php 
/**
 * Renders the Services Features section as a shortcode.
 *
 * This function checks for the existence of 'services_features' rows and
 * generates the corresponding HTML output. If no valid rows are found,
 * it displays a fallback message.
 *
 * @return string The HTML output of the Services Features section or a fallback message.
 */
function display_services_features() {
    ob_start();

    if (have_rows('services_features')) :
        $has_content = false;

        while (have_rows('services_features')) : the_row();
            $title = trim(get_sub_field('features_title'));
            $desc  = trim(get_sub_field('features_description'));

            if ($title || $desc) {
                $has_content = true;
                break;
            }
        endwhile;

        if ($has_content) :
            reset_rows('services_features');
            ?>
            <div class="services-feature">
                <?php while (have_rows('services_features')) : the_row(); 
                    $title = trim(get_sub_field('features_title'));
                    $desc  = trim(get_sub_field('features_description'));

                    if (!$title && !$desc) {
                        continue;
                    }
                    ?>
                    <div class="feature-item">
                        <div class="feature-item-icon">
                            <i class="elementor-icons-manager__tab__item__icon icon icon-ok"></i>
                        </div>
                        <h4><?php echo esc_html($title); ?></h4>
                        <div class="feature-item-desc">
                            <?php echo $desc; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="services-feature-fallback">
                <p>No Services features available at the moment.</p>
            </div>
        <?php endif;
    else : ?>
        <div class="services-feature-fallback">
            <p>No Services features available at the moment.</p>
        </div>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('services_features_display', 'display_services_features');
?>
