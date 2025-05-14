<?php
function custom_insights_category_links_shortcode() {
    $terms = get_terms([
        'taxonomy' => 'insights_category',
        'hide_empty' => false,
        'number' => 9,
    ]);

    if (empty($terms) || is_wp_error($terms)) {
        return '<p>No categories found.</p>';
    }

    $output = '<ul class="insights-category-list">';
    foreach ($terms as $term) {
        $url = get_permalink(get_page_by_path('insights')) . '?category=' . esc_attr($term->slug);
        $output .= '<li><a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}
add_shortcode('insights_categories', 'custom_insights_category_links_shortcode');

?>