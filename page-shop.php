<?php
/**
 * Template Name: Shop / All Products
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$all_products = ecommerce_get_catalog_products();
$current_cat = isset($_GET['cat']) ? sanitize_key($_GET['cat']) : 'all';
$current_sort = isset($_GET['sort']) ? sanitize_key($_GET['sort']) : 'featured';

// Filter by category if requested
$filtered_products = $all_products;
if ($current_cat !== 'all') {
    $filtered_products = array_values(array_filter($filtered_products, fn($p) => $p['category'] === $current_cat));
}

// Sort
if ($current_sort === 'price-low') {
    usort($filtered_products, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($current_sort === 'price-high') {
    usort($filtered_products, fn($a, $b) => $b['price'] <=> $a['price']);
} elseif ($current_sort === 'rating') {
    usort($filtered_products, fn($a, $b) => $b['rating'] <=> $a['rating']);
}
?>

<div class="page-header-banner">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i> Home</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="bc-current">Shop All Gear</span>
        </div>
        <h1 class="page-banner-title">Storefront &amp; Studio Hardware</h1>
        <p class="page-banner-desc">Explore our full line of acoustic-engineered headphones, titanium wearables, and minimalist workspace gear.</p>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <div class="shop-layout">
            <!-- Sidebar Filters -->
            <aside class="shop-sidebar">
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fa-solid fa-sliders"></i> Categories</h3>
                    <ul class="filter-list">
                        <li>
                            <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="filter-link <?php echo $current_cat === 'all' ? 'active' : ''; ?>">
                                <span>All Collections</span>
                                <span class="count-pill"><?php echo count($all_products); ?></span>
                            </a>
                        </li>
                        <?php 
                        $shop_categories = ecommerce_get_product_categories();
                        foreach ($shop_categories as $scat) : 
                            $scat_count = count(array_filter($all_products, fn($p) => $p['category'] === $scat['slug']));
                        ?>
                            <li>
                                <a href="<?php echo esc_url(add_query_arg('cat', $scat['slug'], ecommerce_get_page_url('shop'))); ?>" class="filter-link <?php echo $current_cat === $scat['slug'] ? 'active' : ''; ?>">
                                    <span><?php echo esc_html($scat['name']); ?></span>
                                    <span class="count-pill"><?php echo esc_html($scat_count); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fa-solid fa-tag"></i> Special Offers</h3>
                    <div class="promo-callout-card">
                        <span class="callout-pill">VIP CODE</span>
                        <div class="callout-code">LUXE50</div>
                        <p>Enjoy an extra 15% discount on all orders above $99 with free express shipping.</p>
                        <a href="<?php echo esc_url(ecommerce_get_page_url('deals')); ?>" class="btn btn-primary btn-sm w-100">
                            <span>View Flash Bundles</span>
                        </a>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fa-solid fa-shield-halved"></i> Guarantee</h3>
                    <div class="sidebar-guarantees">
                        <div class="sg-item"><i class="fa-solid fa-truck-fast text-accent"></i> <span>Free Worldwide Delivery &gt; $99</span></div>
                        <div class="sg-item"><i class="fa-solid fa-rotate-left text-accent"></i> <span>30-Day Risk-Free Returns</span></div>
                        <div class="sg-item"><i class="fa-solid fa-circle-check text-accent"></i> <span>2-Year Hardware Warranty</span></div>
                    </div>
                </div>
            </aside>

            <!-- Product Feed -->
            <div class="shop-feed">
                <!-- Toolbar -->
                <div class="shop-toolbar">
                    <div class="results-count">
                        Showing <strong><?php echo count($filtered_products); ?></strong> of <strong><?php echo count($all_products); ?></strong> products
                    </div>
                    <div class="toolbar-sort">
                        <label for="shop-sort-select">Sort by:</label>
                        <select id="shop-sort-select" onchange="window.location.href=this.value">
                            <option value="<?php echo esc_url(add_query_arg('sort', 'featured')); ?>" <?php selected($current_sort, 'featured'); ?>>Featured &amp; Best Match</option>
                            <option value="<?php echo esc_url(add_query_arg('sort', 'price-low')); ?>" <?php selected($current_sort, 'price-low'); ?>>Price: Low to High</option>
                            <option value="<?php echo esc_url(add_query_arg('sort', 'price-high')); ?>" <?php selected($current_sort, 'price-high'); ?>>Price: High to Low</option>
                            <option value="<?php echo esc_url(add_query_arg('sort', 'rating')); ?>" <?php selected($current_sort, 'rating'); ?>>Highest Rated</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="product-grid">
                    <?php foreach ($filtered_products as $product) : ?>
                        <article class="product-card" 
                            data-id="<?php echo esc_attr($product['id']); ?>"
                            data-category="<?php echo esc_attr($product['category']); ?>"
                            data-price="<?php echo esc_attr($product['price']); ?>"
                            data-title="<?php echo esc_attr($product['title']); ?>"
                            data-image="<?php echo esc_url($product['image']); ?>"
                            data-regular-price="<?php echo esc_attr($product['regular_price']); ?>"
                            data-stock="<?php echo esc_attr($product['stock']); ?>"
                            data-rating="<?php echo esc_attr($product['rating']); ?>"
                            data-reviews="<?php echo esc_attr($product['reviews_count']); ?>"
                            data-desc="<?php echo esc_attr($product['short_desc']); ?>"
                            data-colors='<?php echo esc_attr(json_encode($product['colors'])); ?>'
                            data-color-names='<?php echo esc_attr(json_encode($product['color_names'])); ?>'
                            data-gallery='<?php echo esc_attr(json_encode($product['gallery'])); ?>'
                            data-features='<?php echo esc_attr(json_encode($product['features'])); ?>'>
                            
                            <div class="card-media">
                                <div class="card-badges">
                                    <?php if (!empty($product['badge'])) : ?>
                                        <span class="badge badge-<?php echo esc_attr($product['badge_type']); ?>">
                                            <?php echo esc_html($product['badge']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <button type="button" class="btn-wishlist-toggle" data-id="<?php echo esc_attr($product['id']); ?>" aria-label="Add to wishlist">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                                <a href="<?php echo esc_url(ecommerce_get_product_url($product)); ?>" class="card-image-holder">
                                    <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>" class="card-img" loading="lazy">
                                </a>

                                <div class="card-hover-actions">
                                    <button type="button" class="action-pill-btn btn-quickview" data-id="<?php echo esc_attr($product['id']); ?>">
                                        <i class="fa-regular fa-eye"></i>
                                        <span>Quick View</span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="card-meta-row">
                                    <span class="card-category"><?php echo esc_html($product['category_name']); ?></span>
                                    <div class="card-rating">
                                        <i class="fa-solid fa-star star-filled"></i>
                                        <span class="rating-num"><?php echo esc_html($product['rating']); ?></span>
                                        <span class="review-count">(<?php echo esc_html($product['reviews_count']); ?>)</span>
                                    </div>
                                </div>

                                <h3 class="card-title">
                                    <a href="<?php echo esc_url(ecommerce_get_product_url($product)); ?>">
                                        <?php echo esc_html($product['title']); ?>
                                    </a>
                                </h3>

                                <!-- Color Swatches -->
                                <?php if (!empty($product['colors'])) : ?>
                                    <div class="card-swatches">
                                        <?php foreach ($product['colors'] as $idx => $hex) : ?>
                                            <button type="button" 
                                                class="swatch-circle <?php echo $idx === 0 ? 'active' : ''; ?>" 
                                                style="background-color: <?php echo esc_attr($hex); ?>" 
                                                data-color-name="<?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"></button>
                                        <?php endforeach; ?>
                                        <span class="swatch-label"><?php echo esc_html($product['color_names'][0] ?? ''); ?></span>
                                    </div>
                                <?php endif; ?>

                                <div class="card-price-row">
                                    <div class="price-box">
                                        <span class="price-sale">$<?php echo esc_html($product['price']); ?></span>
                                        <?php if ($product['regular_price'] > $product['price']) : ?>
                                            <span class="price-regular">$<?php echo esc_html($product['regular_price']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($product['stock'] <= 5) : ?>
                                        <span class="stock-urgency">Only <?php echo esc_html($product['stock']); ?> left!</span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-footer-btn">
                                    <button type="button" class="btn btn-primary btn-add-cart w-100" data-id="<?php echo esc_attr($product['id']); ?>">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
