<?php

$header_page = get_page_by_path('insights');
if ($header_page) {
    $header_page_id = $header_page->ID;
    $banner_image = get_the_post_thumbnail_url($header_page_id, 'full');
    $banner_page_title = get_the_title($header_page_id);
    $banner_subtitle = get_field('insights_archive_title', $header_page_id);
}

get_header(); 

$taxonomy = 'insights_category';
$terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
]);
$args = array(
    'post_type' => 'insights',
    'posts_per_page' => -1,
    'post_status' => 'publish',
);

$insights_query = new WP_Query($args);
?>
<div class="mcd-banner" style="background-image: url('<?php echo esc_url($banner_image);  ?>');">
    <div class="mcd-container mcd-center">
        <div class="mcd-banner-inner">
            <div class="mcd-banner-content">
                <span><?php echo $banner_page_title ?></span>
                <?php 
                    if ($banner_subtitle) {
                        echo '<h1 class="page-subtitle">' . esc_html($banner_subtitle) . '</h1>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="mcd-container mcd-py">
    <div class="insight-header">
    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
        <div class="tabs-container">
            <div class="tabs-header">
                <div class="tabs-nav-wrapper">
                    <ul class="tabs-nav">
                        <?php foreach ($terms as $index => $term) : ?>
                            <li class="<?= $index === 0 ? 'active' : '' ?>" data-tab="tab-<?= esc_attr($term->slug) ?>">
                                <?= esc_html($term->name) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Search Insights" class="search-input" />
                    <span class="search-reset" aria-hidden="true">&times;</span>
                    <span class="search-button" aria-label="Search">
                        <i class="icon-mcd-search-icon"></i>
                    </span>
                    <span class="search-loading-spinner" style="display: none;">
                        <span class="loader"></span>           
                    </span>
                </div>
            </div>
            <div class="tabs-content">
                <?php foreach ($terms as $index => $term) : ?>
                    <div class="tab-pane <?= $index === 0 ? 'active' : '' ?>" id="tab-<?= esc_attr($term->slug) ?>"
                        data-term="<?= esc_attr($term->slug) ?>" data-paged="1">
                        <div class="insights-wrapper"></div>
                        <div class="load-more-container">
                            <button class="load-more-btn" style="display:none;">Load More</button>
                            <div class="loading-spinner" style="display:none;">Loading...</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="not-found">No insights Content Available.</p>
    <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>



