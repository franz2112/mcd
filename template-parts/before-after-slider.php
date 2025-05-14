<?php
/**
 * Template part for displaying a single before and after item.
 *
 */

if (!isset($args) || empty($args)) return;

$before_image     = $args['before_image'] ?? null;
$after_image      = $args['after_image'] ?? null;
$title            = $args['title'] ?? '';
$desc             = $args['desc'] ?? '';
$service_title    = $args['service_title'] ?? '';
$is_homepage_call = $args['is_homepage_call'] ?? false;
$service_link     = $args['service_link'] ?? '#';

if (empty($before_image) && empty($after_image) && empty($title) && empty($desc)) {
    return;
}
?>

<div class="slick-slide-item">
    <div class="services-result area-item">
        <div class="area-row">
            <div class="area-col-left">
                <?php if ($before_image) : ?>
                    <img src="<?php echo esc_url($before_image['url']); ?>" alt="Before Image">
                <?php endif; ?>
                <?php if ($after_image) : ?>
                    <img src="<?php echo esc_url($after_image['url']); ?>" alt="After Image">
                <?php endif; ?>
            </div>
            <div class="area-col-right">
                <div class="content-wrapper">
                    <h4><?php echo esc_html($title); ?></h4>
                    <span><?php echo esc_html($service_title); ?></span>
                    <div class="result-item-desc">
                        <?php echo $desc; ?>
                    </div>
                    <?php if ($is_homepage_call): ?>
                        <div class="service-button">
                            <a href="<?php echo esc_url($service_link); ?>" class="elementor-button elementor-button-link elementor-size-small">
                                More Info
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
