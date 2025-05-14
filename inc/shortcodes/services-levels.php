<?php 
/**
 * Shortcode to display levels of Services with Light, Medium and Heavy Levels.
 * This shortcode fetches data from ACF fields and displays them.
 *
 * @return string HTML output of the details in Light, Medium and Heavy Levels.
 */
function render_service_levels_shortcode() {
    $services_levels = get_field('services_levels');
    if (!$services_levels || empty($services_levels['levels_title'])) return '';

    ob_start();
    ?>
    <div class="levels-container">
        <h2><?php echo esc_html($services_levels['levels_title']); ?></h2>
        <p class="subtitle"><?php echo esc_html($services_levels['levels_description']); ?></p>
        <div class="levels-cards">
            <!-- Light Cleaning -->
            <div class="levels-card">
                <div class="levels-card-wrapper">
                    <div><?php echo !empty($services_levels['light_level_title']) ? esc_html($services_levels['light_level_title']) : 'Light'; ?></div>
                    <span class="line"></span>
                    <ul>
                        <?php 
                        $moderate_items = $services_levels['light_cleaning'];
                        $has_valid_item = false;

                        if (!empty($moderate_items)) {
                            foreach ($moderate_items as $item) {
                                if (!empty($item['details'])) {
                                    $has_valid_item = true;
                                    echo '<li><i class="elementor-icons-manager__tab__item__icon icon icon-ok"></i> ' . esc_html($item['details']) . '</li>';
                                }
                            }
                        }

                        if (!$has_valid_item) {
                            echo '<li>No Details Available</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Moderate Cleaning -->
            <div class="levels-card active">
                <div class="label"><?php echo esc_html($services_levels['common_selection_title']); ?></div>
                <div class="levels-card-wrapper">
                    <div><?php echo !empty($services_levels['moderate_level_title']) ? esc_html($services_levels['moderate_level_title']) : 'Moderate'; ?></div>
                    <span class="line"></span>
                    <ul>
                        <?php 
                        $moderate_items = $services_levels['moderate_cleaning'];
                        $has_valid_item = false;

                        if (!empty($moderate_items)) {
                            foreach ($moderate_items as $item) {
                                if (!empty($item['details'])) {
                                    $has_valid_item = true;
                                    echo '<li><i class="elementor-icons-manager__tab__item__icon icon icon-ok"></i> ' . esc_html($item['details']) . '</li>';
                                }
                            }
                        }

                        if (!$has_valid_item) {
                            echo '<li>No Details Available</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>


            <!-- Heavy Cleaning -->
            <div class="levels-card">
                <div class="levels-card-wrapper">
                    <div><?php echo !empty($services_levels['heavy_level_title']) ? esc_html($services_levels['heavy_level_title']) : 'Heavy'; ?></div>
                    <span class="line"></span>
                    <ul>
                        <?php 
                        $moderate_items = $services_levels['heavy_cleaning'];
                        $has_valid_item = false;

                        if (!empty($moderate_items)) {
                            foreach ($moderate_items as $item) {
                                if (!empty($item['details'])) {
                                    $has_valid_item = true;
                                    echo '<li><i class="elementor-icons-manager__tab__item__icon icon icon-ok"></i> ' . esc_html($item['details']) . '</li>';
                                }
                            }
                        }

                        if (!$has_valid_item) {
                            echo '<li>No Details Available</li>';
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('service_levels', 'render_service_levels_shortcode');
?>
