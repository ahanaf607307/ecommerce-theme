<?php
/**
 * Single Product Page Template
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Determine product from query var, GET param, or current post ID
$product_id = get_query_var('ecommerce_product');
if (empty($product_id) && isset($_GET['product'])) {
    $product_id = sanitize_text_field($_GET['product']);
}
if (empty($product_id) && get_the_ID()) {
    $product_id = (string) get_the_ID();
}
if (empty($product_id)) {
    $product_id = 'prod-1';
}

$product = ecommerce_get_product_by_id($product_id);
if (!$product) {
    $all = ecommerce_get_catalog_products();
    $product = $all[0] ?? null;
}

$all_products = ecommerce_get_catalog_products();
$related_products = array_values(array_filter($all_products, fn($p) => $p['id'] !== $product['id'] && $p['category'] === $product['category']));
if (empty($related_products)) {
    $related_products = array_slice(array_filter($all_products, fn($p) => $p['id'] !== $product['id']), 0, 4);
}
?>

<div class="page-header-banner single-product-banner">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i> Home</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>">Shop</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <a href="<?php echo esc_url(add_query_arg('cat', $product['category'], ecommerce_get_page_url('shop'))); ?>"><?php echo esc_html($product['category_name']); ?></a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="bc-current"><?php echo esc_html($product['title']); ?></span>
        </div>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <!-- Main Product Presentation Grid -->
        <div class="single-product-grid">
            <!-- Left: Gallery Showcase -->
            <div class="single-product-gallery">
                <div class="single-gallery-main">
                    <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>" id="single-main-img" class="single-main-img">
                    <?php if (!empty($product['badge'])) : ?>
                        <span class="single-badge badge-<?php echo esc_attr($product['badge_type']); ?>">
                            <?php echo esc_html($product['badge']); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="single-gallery-thumbs" id="single-gallery-thumbs">
                    <?php foreach ($product['gallery'] as $idx => $thumb_url) : ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="Product angle" class="single-thumb <?php echo $idx === 0 ? 'active' : ''; ?>" data-src="<?php echo esc_url($thumb_url); ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right: Buy Box & Specifications -->
            <div class="single-product-info">
                <div class="single-meta-top">
                    <span class="single-cat-pill"><?php echo esc_html($product['category_name']); ?></span>
                    <?php if ($product['stock'] <= 5) : ?>
                        <span class="stock-badge stock-urgent"><i class="fa-solid fa-fire"></i> Only <?php echo esc_html($product['stock']); ?> left in stock</span>
                    <?php else : ?>
                        <span class="stock-badge stock-available"><i class="fa-solid fa-circle-check"></i> In Stock &bull; Ready to Ship</span>
                    <?php endif; ?>
                </div>

                <h1 class="single-product-title"><?php echo esc_html($product['title']); ?></h1>

                <div class="single-rating-row">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <span class="rating-val"><?php echo esc_html($product['rating']); ?> / 5.0</span>
                    <a href="#product-reviews-tab" class="reviews-jump-link">(<?php echo esc_html($product['reviews_count']); ?> customer reviews)</a>
                </div>

                <div class="single-price-box">
                    <span class="single-price-current">$<?php echo esc_html($product['price']); ?></span>
                    <?php if ($product['regular_price'] > $product['price']) : ?>
                        <span class="single-price-regular">$<?php echo esc_html($product['regular_price']); ?></span>
                        <span class="single-save-pill">Save $<?php echo esc_html($product['regular_price'] - $product['price']); ?></span>
                    <?php endif; ?>
                </div>

                <p class="single-desc"><?php echo esc_html($product['short_desc']); ?></p>

                <!-- Color Swatches -->
                <?php if (!empty($product['colors'])) : ?>
                    <div class="single-swatch-section">
                        <label class="section-label">Select Color: <span class="selected-color-name" id="single-color-label"><?php echo esc_html($product['color_names'][0] ?? ''); ?></span></label>
                        <div class="single-swatches">
                            <?php foreach ($product['colors'] as $idx => $hex) : ?>
                                <button type="button" 
                                    class="single-swatch-btn <?php echo $idx === 0 ? 'active' : ''; ?>" 
                                    style="background-color: <?php echo esc_attr($hex); ?>" 
                                    data-color="<?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"
                                    title="<?php echo esc_attr($product['color_names'][$idx] ?? ''); ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Quantity & Actions -->
                <div class="single-actions-row">
                    <div class="qty-picker">
                        <button type="button" class="qty-btn" id="single-qty-minus"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" id="single-qty-input" value="1" min="1" max="99" readonly>
                        <button type="button" class="qty-btn" id="single-qty-plus"><i class="fa-solid fa-plus"></i></button>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg btn-glow single-add-btn" id="single-page-add-cart" data-id="<?php echo esc_attr($product['id']); ?>">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Add To Bag &bull; <span id="single-btn-total">$<?php echo esc_html($product['price']); ?></span></span>
                    </button>

                    <button type="button" class="btn-wishlist-toggle single-wishlist-btn" data-id="<?php echo esc_attr($product['id']); ?>" aria-label="Save to wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>

                <!-- Trust Guarantees -->
                <div class="single-guarantee-strip">
                    <div class="sg-perk"><i class="fa-solid fa-truck-fast text-accent"></i> Free DHL Express Delivery on orders over $99</div>
                    <div class="sg-perk"><i class="fa-solid fa-rotate-left text-accent"></i> 30-Day In-Home Trial with Prepaid Return Shipping</div>
                    <div class="sg-perk"><i class="fa-solid fa-shield-check text-accent"></i> 2-Year Complete Hardware Replacement Warranty</div>
                </div>
            </div>
        </div>

        <!-- Deep-dive Specifications Tabs -->
        <div class="product-tabs-section" id="product-reviews-tab">
            <div class="product-tabs-nav" role="tablist">
                <button type="button" class="p-tab-btn active" data-tab="specs">Technical Specifications</button>
                <button type="button" class="p-tab-btn" data-tab="box">What's In The Box</button>
                <button type="button" class="p-tab-btn" data-tab="reviews">Verified Reviews (<?php echo esc_html($product['reviews_count']); ?>)</button>
            </div>

            <!-- Tab 1: Specs -->
            <div class="p-tab-pane active" id="tab-specs">
                <table class="specs-table">
                    <tbody>
                        <tr><td>Transducer Driver</td><td>45mm Custom Beryllium Acoustic Driver</td></tr>
                        <tr><td>Frequency Response</td><td>10 Hz – 40,000 Hz (Hi-Res Audio Certified)</td></tr>
                        <tr><td>Active Noise Cancellation</td><td>Hybrid Triple-Microphone Array (-42dB suppression)</td></tr>
                        <tr><td>Battery Life</td><td>Up to 60 Hours (ANC on: 48 Hours)</td></tr>
                        <tr><td>Fast Charging</td><td>10 minutes charge = 5 hours playback (USB-C Power Delivery)</td></tr>
                        <tr><td>Connectivity</td><td>Bluetooth 5.3 Multipoint + 2.4GHz Dongle + 3.5mm Analog Audio</td></tr>
                        <tr><td>Materials</td><td>Grade 5 Titanium &amp; Memory Foam with Protein Leather</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Tab 2: In the Box -->
            <div class="p-tab-pane" id="tab-box" style="display: none;">
                <ul class="box-contents-list">
                    <li><i class="fa-solid fa-circle-check text-accent"></i> 1x <?php echo esc_html($product['title']); ?></li>
                    <li><i class="fa-solid fa-circle-check text-accent"></i> 1x Magnetic Hard-Shell Travel &amp; Storage Case</li>
                    <li><i class="fa-solid fa-circle-check text-accent"></i> 1x Braided Gold-Plated 3.5mm Auxiliary Cable (1.8m)</li>
                    <li><i class="fa-solid fa-circle-check text-accent"></i> 1x High-Speed Braided USB-C Charging Cable</li>
                    <li><i class="fa-solid fa-circle-check text-accent"></i> 1x Airline Headphone Adapter &amp; User Manual</li>
                </ul>
            </div>

            <!-- Tab 3: Reviews -->
            <div class="p-tab-pane" id="tab-reviews" style="display: none;">
                <div class="tab-reviews-summary">
                    <div class="big-score">
                        <span class="num"><?php echo esc_html($product['rating']); ?></span>
                        <span class="out">/ 5.0</span>
                    </div>
                    <div class="score-stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <span class="recom-text">&bull; 98.4% of customers recommend this hardware</span>
                    </div>
                </div>

                <div class="tab-review-cards">
                    <div class="tab-review-card">
                        <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        <h4>“Remarkable build quality and sound stage.”</h4>
                        <p>I’ve used reference monitors for over a decade. The separation of instruments and acoustic clarity in this unit is astonishing. Easily best in class.</p>
                        <span class="author">— Alexander Hayes, Sound Engineer &bull; Verified Buyer</span>
                    </div>
                    <div class="tab-review-card">
                        <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        <h4>“The battery life actually exceeds the claims.”</h4>
                        <p>I flew across three continents without plugging this in once. ANC canceled out cabin roar effortlessly. Worth every single penny.</p>
                        <span class="author">— Claire Vance, Digital Nomad &bull; Verified Buyer</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Hardware -->
        <?php if (!empty($related_products)) : ?>
            <div class="related-products-section">
                <div class="section-heading-row">
                    <div>
                        <span class="section-badge"><i class="fa-solid fa-layer-group"></i> COMPLEMENTARY GEAR</span>
                        <h2 class="section-title">Complete Your Setup</h2>
                    </div>
                    <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="heading-link">
                        <span>View All Gear</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="product-grid">
                    <?php foreach ($related_products as $rel_prod) : ?>
                        <article class="product-card" 
                            data-id="<?php echo esc_attr($rel_prod['id']); ?>"
                            data-category="<?php echo esc_attr($rel_prod['category']); ?>"
                            data-price="<?php echo esc_attr($rel_prod['price']); ?>"
                            data-title="<?php echo esc_attr($rel_prod['title']); ?>"
                            data-image="<?php echo esc_url($rel_prod['image']); ?>"
                            data-regular-price="<?php echo esc_attr($rel_prod['regular_price']); ?>"
                            data-stock="<?php echo esc_attr($rel_prod['stock']); ?>"
                            data-rating="<?php echo esc_attr($rel_prod['rating']); ?>"
                            data-reviews="<?php echo esc_attr($rel_prod['reviews_count']); ?>"
                            data-desc="<?php echo esc_attr($rel_prod['short_desc']); ?>"
                            data-colors='<?php echo esc_attr(json_encode($rel_prod['colors'])); ?>'
                            data-color-names='<?php echo esc_attr(json_encode($rel_prod['color_names'])); ?>'
                            data-gallery='<?php echo esc_attr(json_encode($rel_prod['gallery'])); ?>'
                            data-features='<?php echo esc_attr(json_encode($rel_prod['features'])); ?>'>
                            
                            <div class="card-media">
                                <a href="<?php echo esc_url(ecommerce_get_product_url($rel_prod)); ?>" class="card-image-holder">
                                    <img src="<?php echo esc_url($rel_prod['image']); ?>" alt="<?php echo esc_attr($rel_prod['title']); ?>" class="card-img" loading="lazy">
                                </a>
                            </div>
                            <div class="card-body">
                                <span class="card-category"><?php echo esc_html($rel_prod['category_name']); ?></span>
                                <h3 class="card-title">
                                    <a href="<?php echo esc_url(ecommerce_get_product_url($rel_prod)); ?>"><?php echo esc_html($rel_prod['title']); ?></a>
                                </h3>
                                <div class="card-price-row">
                                    <span class="price-sale">$<?php echo esc_html($rel_prod['price']); ?></span>
                                </div>
                                <button type="button" class="btn btn-primary btn-add-cart w-100" data-id="<?php echo esc_attr($rel_prod['id']); ?>">
                                    <i class="fa-solid fa-bag-shopping"></i> Add to Cart
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
// Tab Switching and Gallery interactive logic for single-product
document.addEventListener('DOMContentLoaded', () => {
    // Gallery Thumbs
    const mainImg = document.getElementById('single-main-img');
    const thumbs = document.querySelectorAll('.single-thumb');
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            thumbs.forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
            if (mainImg) mainImg.src = thumb.dataset.src;
        });
    });

    // Swatches
    const swatchBtns = document.querySelectorAll('.single-swatch-btn');
    const colorLabel = document.getElementById('single-color-label');
    swatchBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            swatchBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            if (colorLabel) colorLabel.textContent = btn.dataset.color;
        });
    });

    // Qty
    const minusBtn = document.getElementById('single-qty-minus');
    const plusBtn = document.getElementById('single-qty-plus');
    const qtyInput = document.getElementById('single-qty-input');
    const btnTotal = document.getElementById('single-btn-total');
    const basePrice = <?php echo floatval($product['price']); ?>;

    const updateQtyTotal = () => {
        const q = parseInt(qtyInput.value, 10) || 1;
        if (btnTotal) btnTotal.textContent = '$' + (basePrice * q).toFixed(2);
    };

    if (minusBtn && qtyInput) {
        minusBtn.addEventListener('click', () => {
            let v = parseInt(qtyInput.value, 10) || 1;
            if (v > 1) { qtyInput.value = v - 1; updateQtyTotal(); }
        });
    }
    if (plusBtn && qtyInput) {
        plusBtn.addEventListener('click', () => {
            let v = parseInt(qtyInput.value, 10) || 1;
            qtyInput.value = v + 1;
            updateQtyTotal();
        });
    }

    // Add To Bag from Single Page
    const addBtn = document.getElementById('single-page-add-cart');
    if (addBtn) {
        addBtn.addEventListener('click', () => {
            const chosenColor = colorLabel ? colorLabel.textContent : 'Default';
            const qty = parseInt(qtyInput.value, 10) || 1;
            const prodData = {
                id: '<?php echo esc_js($product['id']); ?>',
                title: '<?php echo esc_js($product['title']); ?>',
                price: <?php echo floatval($product['price']); ?>,
                image: '<?php echo esc_js($product['image']); ?>',
                colorNames: ['<?php echo esc_js($product['color_names'][0] ?? 'Default'); ?>']
            };

            // Trigger global addToCart function
            if (typeof window.ecommerceAddToCart === 'function') {
                window.ecommerceAddToCart(prodData, qty, chosenColor);
            } else {
                // Trigger simulated click
                const fakeEvent = new CustomEvent('ecommerce:add-to-cart', {
                    detail: { product: prodData, qty: qty, color: chosenColor }
                });
                document.dispatchEvent(fakeEvent);
            }
        });
    }

    // Tabs
    const tabBtns = document.querySelectorAll('.p-tab-btn');
    const panes = document.querySelectorAll('.p-tab-pane');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;
            tabBtns.forEach(b => b.classList.remove('active'));
            panes.forEach(p => p.style.display = 'none');
            btn.classList.add('active');
            const targetPane = document.getElementById('tab-' + target);
            if (targetPane) targetPane.style.display = 'block';
        });
    });
});
</script>

<?php get_footer(); ?>
