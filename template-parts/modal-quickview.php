<?php
/**
 * Product Quick View Modal Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="quickview-modal" class="quickview-modal" aria-hidden="true" role="dialog">
    <div class="quickview-backdrop" id="quickview-backdrop"></div>
    
    <div class="quickview-dialog">
        <button type="button" class="quickview-close-btn" id="quickview-close" aria-label="Close dialog">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="quickview-content-grid">
            <!-- Left: Gallery Showcase -->
            <div class="quickview-gallery-col">
                <div class="quickview-main-image-wrap">
                    <img src="" alt="Product view" id="quickview-main-img" class="quickview-main-img">
                    <span class="quickview-badge" id="quickview-badge">Best Seller</span>
                </div>
                <div class="quickview-thumbs" id="quickview-thumbs">
                    <!-- Dynamic thumbnails injected by JS -->
                </div>
            </div>

            <!-- Right: Product Specifications & Add to Cart -->
            <div class="quickview-info-col">
                <div class="quickview-meta-row">
                    <span class="quickview-cat-badge" id="quickview-category">Wireless Audio</span>
                    <span class="quickview-stock-badge" id="quickview-stock">In Stock</span>
                </div>

                <h2 class="quickview-title" id="quickview-title">Product Title</h2>

                <!-- Rating -->
                <div class="quickview-rating-wrap">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <span class="rating-val" id="quickview-rating">4.9</span>
                    <span class="reviews-count" id="quickview-reviews">(328 reviews)</span>
                </div>

                <!-- Price Box -->
                <div class="quickview-price-box">
                    <span class="price-current" id="quickview-price">$299</span>
                    <span class="price-regular" id="quickview-regular-price">$380</span>
                    <span class="discount-pill" id="quickview-discount-pill">Save 22%</span>
                </div>

                <!-- Description -->
                <p class="quickview-desc" id="quickview-desc">
                    Audiophile-grade Active Noise Cancellation, custom 45mm beryllium drivers, and 60 hours of wireless playback.
                </p>

                <!-- Color Swatch Picker -->
                <div class="quickview-colors-wrap">
                    <label class="section-label">Select Color: <span class="selected-color-name" id="quickview-selected-color">Midnight Slate</span></label>
                    <div class="quickview-swatches" id="quickview-swatches">
                        <!-- Swatches rendered by JS -->
                    </div>
                </div>

                <!-- Feature Highlights -->
                <div class="quickview-features-wrap">
                    <label class="section-label">Key Specifications:</label>
                    <ul class="quickview-features-list" id="quickview-features-list">
                        <!-- Bullets rendered by JS -->
                    </ul>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="quickview-actions-wrap">
                    <div class="qty-picker">
                        <button type="button" class="qty-btn" id="qv-qty-minus" aria-label="Decrease quantity">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" id="qv-qty-input" value="1" min="1" max="99" readonly>
                        <button type="button" class="qty-btn" id="qv-qty-plus" aria-label="Increase quantity">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <button type="button" class="btn btn-primary btn-glow btn-lg btn-add-qv-cart" id="quickview-add-to-cart-btn">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Add To Bag &bull; <span id="qv-button-price">$299</span></span>
                    </button>
                </div>

                <!-- Guarantees Row -->
                <div class="quickview-guarantees">
                    <span><i class="fa-solid fa-truck-fast"></i> Free express shipping</span>
                    <span><i class="fa-solid fa-rotate-left"></i> 30-day money-back</span>
                    <span><i class="fa-solid fa-shield-check"></i> 2-year warranty</span>
                </div>
            </div>
        </div>
    </div>
</div>
