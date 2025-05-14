<?php
/**
 * Displays the Project Services Tags
 * @return string
 */
function project_services_tags_shortcode($atts) {
    ob_start();

    $post_id = get_the_ID();
    $services = get_field('project_services_tags', $post_id); ?>

    <div class="project-services">
    <?php
    if (!empty($services) && is_array($services)) {
        foreach ($services as $service) {
            echo '<span>' . esc_html(get_the_title($service)) . '</span>';
        }
    }
    ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('project_services_tags', 'project_services_tags_shortcode');


?>
