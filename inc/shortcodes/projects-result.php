<?php
/**
 * Displays the Content of the Result Section
 * @return string
 */
function project_results_shortcode($atts) {
    ob_start();

    $post_id = get_the_ID();
    $has_valid_rows = false;

    
    if (have_rows('project_result', $post_id)) {
        ?>
        <div class="project-result-wrapper">
        <?php
        while (have_rows('project_result', $post_id)) {
            the_row();
            $title = trim(get_sub_field('project_result_title'));
            $description = trim(get_sub_field('project_result_description'));

            if (!empty($title) && !empty($description)) {
                $has_valid_rows = true;
                ?>
                <div class="project-result">
                    <div class="content">
                        <h4><?php echo esc_html($title); ?></h4>
                        <p><?php echo esc_html($description); ?></p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        </div>
        <?php
    }

    if (!$has_valid_rows) {
        echo '<p>No project results available at the moment.</p>';
    }

    return ob_get_clean();
}
add_shortcode('project_results', 'project_results_shortcode');

?>
