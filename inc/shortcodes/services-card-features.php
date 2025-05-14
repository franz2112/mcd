<?php 
/**
 * Renders the Services Features section as a shortcode.
 *
 * Outputs a card-style list of service features if available, or a fallback message otherwise.
 *
 * @return string The HTML output of the Services Features section.
 */
function display_services_card_features() {
    ob_start();
    ?>
    <div class="services-details-wrapper">
        <div class="services-content">
            <?php 
            if (have_rows('services_features')): 
                $has_valid_feature = false;

                while (have_rows('services_features')): the_row();
                    $feature_title = get_sub_field('features_title');
                    if (!empty($feature_title)) {
                        $has_valid_feature = true;
                        break;
                    }
                endwhile;

                if ($has_valid_feature): ?>
                    <ul class="services-items">
                        <?php 
                        reset_rows(); 
                        while (have_rows('services_features')): the_row(); 
                            $feature_title = get_sub_field('features_title'); 
                            if (!empty($feature_title)): ?>
                                <li><?php echo esc_html($feature_title); ?></li>
                            <?php endif; 
                        endwhile; ?>
                    </ul>
                <?php else: ?>
                    <ul class="services">
                        <li>No features Available.</li>
                    </ul>
                <?php endif; 
            else: ?>
                <ul class="services">
                    <li>No features Available.</li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('services_card_features_display', 'display_services_card_features');
