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

$categories = [
    [
        'slug'        => 'audio',
        'title'       => 'Wireless Audio & Hi-Fi',
        'count'       => '14 Models Available',
        'description' => 'Hi-Res certified planar headphones, studio audiophile monitors, and intelligent active noise cancellation earbuds.',
        'image'       => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=800&q=80',
        'badge'       => 'Most Acclaimed',
        'features'    => ['Lossless 24-bit/96kHz Audio', 'Hybrid Active Noise Canceling', '60-Hour Fast-Charge Batteries']
    ],
    [
        'slug'        => 'wearables',
        'title'       => 'Smart Wearables & Tech',
        'count'       => '9 Models Available',
        'description' => 'Aerospace Grade-5 Titanium smartwatches, continuous HRV biosensing rings, and sapphire sports watches.',
        'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80',
        'badge'       => 'Next-Gen Biosensing',
        'features'    => ['Aerospace Titanium Chassis', 'Sapphire Crystal Glass', '14-Day Continuous Battery']
    ],
    [
        'slug'        => 'edc',
        'title'       => 'EDC & Workspace Setup',
        'count'       => '18 Models Available',
        'description' => 'Solid aircraft-grade aluminum 3-in-1 MagSafe charging docks, custom mechanical keyboards, and zero-glare desk lamps.',
        'image'       => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=800&q=80',
        'badge'       => 'Productivity Essentials',
        'features'    => ['15W Fast MagSafe Charging', 'Gasket-Mounted Mechanical Keys', 'CRI > 98 Studio Lighting']
    ],
    [
        'slug'        => 'lifestyle',
        'title'       => 'Travel & Everyday Gear',
        'count'       => '11 Models Available',
        'description' => 'Weatherproof X-Pac slings, magnetic Fidlock travel pouches, and RFID-shielded minimalist organizers.',
        'image'       => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=800&q=80',
        'badge'       => 'Weatherproof Protection',
        'features'    => ['Waterproof Cordura & X-Pac', 'German Fidlock Quick-Release', 'Concealed Passport Security']
    ]
];
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
            <?php foreach ($categories as $cat) : ?>
                <div class="cat-hub-card">
                    <div class="cat-hub-image-col">
                        <img src="<?php echo esc_url($cat['image']); ?>" alt="<?php echo esc_attr($cat['title']); ?>" class="cat-hub-img">
                        <span class="cat-hub-badge"><?php echo esc_html($cat['badge']); ?></span>
                    </div>
                    <div class="cat-hub-info-col">
                        <span class="cat-hub-count"><?php echo esc_html($cat['count']); ?></span>
                        <h2 class="cat-hub-title"><?php echo esc_html($cat['title']); ?></h2>
                        <p class="cat-hub-desc"><?php echo esc_html($cat['description']); ?></p>
                        
                        <ul class="cat-hub-features">
                            <?php foreach ($cat['features'] as $f) : ?>
                                <li><i class="fa-solid fa-circle-check text-accent"></i> <?php echo esc_html($f); ?></li>
                            <?php endforeach; ?>
                        </ul>

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
