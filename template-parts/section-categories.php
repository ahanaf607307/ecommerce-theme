<?php
/**
 * Category Showcase Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$categories = [
    [
        'slug'        => 'audio',
        'title'       => 'Wireless Audio & Sound',
        'count'       => '14 Models',
        'description' => 'Hi-Res certified headphones, audiophile planar drivers & ANC earbuds.',
        'image'       => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=700&q=80',
        'badge'       => 'Most Popular',
        'featured'    => true
    ],
    [
        'slug'        => 'wearables',
        'title'       => 'Smart Wearables & Tech',
        'count'       => '9 Models',
        'description' => 'Aerospace titanium smartwatches, bio-sensing rings & health trackers.',
        'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=700&q=80',
        'badge'       => 'Next-Gen',
        'featured'    => false
    ],
    [
        'slug'        => 'edc',
        'title'       => 'Workspace & EDC Gear',
        'count'       => '18 Models',
        'description' => 'Solid aluminum 3-in-1 MagSafe docks, mechanical keyboards & desk lamps.',
        'image'       => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=700&q=80',
        'badge'       => 'Staff Pick',
        'featured'    => false
    ],
    [
        'slug'        => 'lifestyle',
        'title'       => 'Travel & Everyday Bags',
        'count'       => '11 Models',
        'description' => 'Weatherproof X-Pac slings, tech pouches & RFID-shielded organizers.',
        'image'       => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=700&q=80',
        'badge'       => 'Trending',
        'featured'    => false
    ]
];
?>
<section id="categories" class="section-categories">
    <div class="container">
        <!-- Section Header -->
        <div class="section-heading-row">
            <div>
                <span class="section-badge"><i class="fa-solid fa-layer-group"></i> CURATED COLLECTIONS</span>
                <h2 class="section-title">Explore By Category</h2>
                <p class="section-subtitle">Crafted with precision engineering for peak creative focus and daily style.</p>
            </div>
            <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="heading-link">
                <span>View All Products</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <!-- Category Grid -->
        <div class="category-grid">
            <?php foreach ($categories as $cat) : ?>
                <div class="category-card" onclick="window.location.href='<?php echo esc_url(add_query_arg('cat', $cat['slug'], ecommerce_get_page_url('shop'))); ?>'">
                    <div class="cat-image-wrapper">
                        <img src="<?php echo esc_url($cat['image']); ?>" alt="<?php echo esc_attr($cat['title']); ?>" class="cat-img" loading="lazy">
                        <div class="cat-overlay"></div>
                    </div>
                    <div class="cat-content">
                        <div class="cat-badge-wrap">
                            <span class="cat-pill"><?php echo esc_html($cat['badge']); ?></span>
                            <span class="cat-count"><?php echo esc_html($cat['count']); ?></span>
                        </div>
                        <h3 class="cat-title"><?php echo esc_html($cat['title']); ?></h3>
                        <p class="cat-desc"><?php echo esc_html($cat['description']); ?></p>
                        <a href="<?php echo esc_url(add_query_arg('cat', $cat['slug'], ecommerce_get_page_url('shop'))); ?>" class="cat-action-btn">
                            <span>Shop <?php echo esc_html($cat['title']); ?></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
