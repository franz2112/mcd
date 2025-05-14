<?php
/**
 * AJAX handler for loading "Insights" posts.
 * This file contains the functionality to handle AJAX requests for loading
 * "Insights" posts based on taxonomy terms, pagination, and search queries.
 * 
 */
add_action('wp_ajax_ajax_insights_load_posts', 'ajax_insights_load_posts');
add_action('wp_ajax_nopriv_ajax_insights_load_posts', 'ajax_insights_load_posts');

function ajax_insights_load_posts() {
    $term = sanitize_text_field($_POST['term']);
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = [
        'post_type' => 'insights',
        'posts_per_page' => 12,
        'paged' => $paged,
        'post_status' => 'publish',
        's' => $search,
        'tax_query' => [[
            'taxonomy' => 'insights_category',
            'field' => 'slug',
            'terms' => $term,
        ]],
        'custom_title_search' => true
    ];

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="insight-item">
                <?php echo do_shortcode('[elementor-template id="5149"]'); ?>
            </div>
        <?php endwhile;
    else :
        echo '<p class="not-found" >No insights found.</p>';
    endif;

    $html = ob_get_clean();

    wp_send_json([
        'html' => $html,
        'has_more' => $query->max_num_pages > $paged
    ]);
}


add_filter('posts_search', 'custom_search_by_title_only', 10, 2);
function custom_search_by_title_only($search, $wp_query) {
    global $wpdb;

    if (!is_admin() && $wp_query->get('custom_title_search')) {
        $search_term = $wp_query->get('s');

        if (!empty($search_term)) {
            $like = '%' . $wpdb->esc_like($search_term) . '%';
            $search = $wpdb->prepare(" AND ({$wpdb->posts}.post_title LIKE %s)", $like);
        } else {
            $search = " AND 1=0 ";
        }
    }

    return $search;
}
?>
