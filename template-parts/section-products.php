<?php
/**
 * Featured Products Grid Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$products = ecommerce_get_catalog_products();
?>
<section id="products" class="section-products">
    <div class="container">
        <!-- Section Heading & Filter Tabs -->
        <div class="products-header-wrap">
            <div class="section-heading-centered">
                <span class="section-badge"><i class="fa-solid fa-fire"></i> THE SIGNATURE LINEUP</span>
                <h2 class="section-title">Engineered For High Performers</h2>
                <p class="section-subtitle">Select your gear. Tested by studio sound engineers and design perfectionists.</p>
            </div>

            <!-- Dynamic Filter Bar -->
            <div class="filter-tabs-nav" role="tablist">
                <button type="button" class="filter-tab-btn active" data-filter="all" role="tab" aria-selected="true">
                    <span>All Products</span>
                    <span class="tab-count"><?php echo count($products); ?></span>
                </button>
                <button type="button" class="filter-tab-btn" data-filter="audio" role="tab" aria-selected="false">
                    <i class="fa-solid fa-headphones"></i>
                    <span>Audio</span>
                </button>
                <button type="button" class="filter-tab-btn" data-filter="wearables" role="tab" aria-selected="false">
                    <i class="fa-solid fa-stopwatch"></i>
                    <span>Smart Tech</span>
                </button>
                <button type="button" class="filter-tab-btn" data-filter="edc" role="tab" aria-selected="false">
                    <i class="fa-solid fa-keyboard"></i>
                    <span>Workspace</span>
                </button>
                <button type="button" class="filter-tab-btn" data-filter="lifestyle" role="tab" aria-selected="false">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Lifestyle</span>
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="product-grid" id="main-product-grid">
            <?php foreach ($products as $product) : ?>
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
                    
                    <!-- Media Container -->
                    <div class="card-media">
                        <!-- Badges -->
                        <div class="card-badges">
                            <?php if (!empty($product['badge'])) : ?>
                                <span class="badge badge-<?php echo esc_attr($product['badge_type']); ?>">
                                    <?php echo esc_html($product['badge']); ?>
                                </span>
                            <?php endif; ?>
                            <?php 
                                $discount_pct = round((($product['regular_price'] - $product['price']) / $product['regular_price']) * 100);
                                if ($discount_pct > 0) :
                            ?>
                                <span class="badge badge-discount">-<?php echo esc_html($discount_pct); ?>%</span>
                            <?php endif; ?>
                        </div>

                        <!-- Wishlist Toggle -->
                        <button type="button" class="btn-wishlist-toggle" data-id="<?php echo esc_attr($product['id']); ?>" aria-label="Add to wishlist" title="Add to wishlist">
                            <i class="fa-regular fa-heart"></i>
                        </button>

                        <!-- Product Thumbnail -->
                        <a href="<?php echo esc_url(ecommerce_get_product_url($product)); ?>" class="card-image-holder">
                            <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>" class="card-img" loading="lazy">
                        </a>

                        <!-- Hover Quick Action Overlay -->
                        <div class="card-hover-actions">
                            <button type="button" class="action-pill-btn btn-quickview" data-id="<?php echo esc_attr($product['id']); ?>">
                                <i class="fa-regular fa-eye"></i>
                                <span>Quick View</span>
                            </button>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="card-meta-row">
                            <span class="card-category"><?php echo esc_html($product['category_name']); ?></span>
                            <!-- Rating -->
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
                                        title="<?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"
                                        data-color-name="<?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"
                                        aria-label="Color <?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"></button>
                                <?php endforeach; ?>
                                <span class="swatch-label"><?php echo esc_html($product['color_names'][0] ?? ''); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Pricing & Stock -->
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

                        <!-- Add to Cart CTA -->
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

        <!-- Catalog Notice / Guarantee -->
        <div class="products-bottom-bar">
            <div class="bottom-bar-item">
                <i class="fa-solid fa-shield-check text-accent"></i>
                <span>Every product backed by our 2-Year Replacement Warranty</span>
            </div>
            <div class="bottom-bar-item">
                <i class="fa-solid fa-box-check text-accent"></i>
                <span>Ships same business day when ordered before 2 PM EST</span>
            </div>
        </div>
    </div>
</section>
