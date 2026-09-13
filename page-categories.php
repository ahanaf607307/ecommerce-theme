<?php
/**
 * Template Name: Categories Hub
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$categories = ecommerce_get_product_categories();
?>

<div class="page-header-banner">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i> Home</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="bc-current">Collections &amp; Categories</span>
        </div>
        <h1 class="page-banner-title">Curated Hardware Disciplines</h1>
        <p class="page-banner-desc">Engineered for creators, developers, and discerning listeners. Explore by equipment category.</p>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <div class="categories-hub-grid">
            <?php foreach ($categories as $cat) : 
                $count_label = is_numeric($cat['count']) ? ($cat['count'] . ' ' . _n('Model Available', 'Models Available', (int)$cat['count'], 'ecommerce')) : $cat['count'];
            ?>
                <div class="cat-hub-card">
                    <div class="cat-hub-image-col">
                        <img src="<?php echo esc_url($cat['image']); ?>" alt="<?php echo esc_attr($cat['title']); ?>" class="cat-hub-img">
                        <?php if (!empty($cat['badge'])) : ?>
                            <span class="cat-hub-badge"><?php echo esc_html($cat['badge']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="cat-hub-info-col">
                        <span class="cat-hub-count"><?php echo esc_html($count_label); ?></span>
                        <h2 class="cat-hub-title"><?php echo esc_html($cat['title']); ?></h2>
                        <p class="cat-hub-desc"><?php echo esc_html($cat['description']); ?></p>
                        
                        <?php if (!empty($cat['features']) && is_array($cat['features'])) : ?>
                            <ul class="cat-hub-features">
                                <?php foreach ($cat['features'] as $f) : ?>
                                    <li><i class="fa-solid fa-circle-check text-accent"></i> <?php echo esc_html($f); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="cat-hub-cta">
                            <a href="<?php echo esc_url(add_query_arg('cat', $cat['slug'], ecommerce_get_page_url('shop'))); ?>" class="btn btn-primary">
                                <span>Browse <?php echo esc_html($cat['title']); ?></span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
