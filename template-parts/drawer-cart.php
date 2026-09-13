<?php
/**
 * Slide-over Cart Drawer Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!-- Cart Drawer Backdrop & Sidebar -->
<div id="cart-drawer" class="cart-drawer">
    <div class="cart-backdrop" id="cart-backdrop"></div>
    
    <aside class="cart-panel" aria-label="Shopping Cart Drawer">
        <!-- Header -->
        <div class="cart-panel-header">
            <div class="cart-header-title">
                <i class="fa-solid fa-bag-shopping cart-title-icon"></i>
                <h3>Your Bag</h3>
                <span class="cart-panel-count" id="cart-drawer-count">0 items</span>
            </div>
            <button type="button" class="cart-close-btn" id="cart-drawer-close" aria-label="Close cart">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Free Shipping Progress Tracker -->
        <div class="cart-shipping-bar" id="cart-shipping-bar">
            <div class="shipping-bar-text" id="shipping-bar-message">
                <i class="fa-solid fa-truck-fast"></i>
                <span>Add <strong>$99.00</strong> more to unlock <strong>Free Express Shipping</strong></span>
            </div>
            <div class="shipping-progress-track">
                <div class="shipping-progress-fill" id="shipping-progress-fill" style="width: 0%;"></div>
            </div>
        </div>

        <!-- Cart Items List / Empty State -->
        <div class="cart-panel-body" id="cart-items-container">
            <!-- Rendered dynamically by ecommerce.js -->
            <div class="cart-empty-state" id="cart-empty-state">
                <div class="empty-icon-wrap">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <h4>Your Bag Is Empty</h4>
                <p>Explore our flagship headphones, smart wearables, and EDC gear to get started.</p>
                <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="btn btn-primary btn-sm" id="cart-start-shopping">
                    <span>Explore Products</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Footer / Checkout Area -->
        <div class="cart-panel-footer" id="cart-panel-footer" style="display: none;">
            <!-- Promo Code Accordion/Input -->
            <div class="cart-promo-section">
                <form class="promo-form" id="cart-promo-form">
                    <input type="text" id="cart-promo-input" placeholder="Promo code (try LUXE50)">
                    <button type="submit" class="btn btn-secondary btn-sm" id="cart-promo-apply">Apply</button>
                </form>
                <div class="promo-feedback" id="cart-promo-feedback"></div>
            </div>

            <!-- Pricing Breakdown -->
            <div class="cart-totals">
                <div class="totals-row">
                    <span>Subtotal</span>
                    <span id="cart-subtotal-val">$0.00</span>
                </div>
                <div class="totals-row discount-row" id="cart-discount-row" style="display: none;">
                    <span>Promo Discount (15%)</span>
                    <span class="text-accent" id="cart-discount-val">-$0.00</span>
                </div>
                <div class="totals-row">
                    <span>Express Shipping</span>
                    <span id="cart-shipping-val">Calculated next</span>
                </div>
                <div class="totals-divider"></div>
                <div class="totals-row total-highlight">
                    <span>Estimated Total</span>
                    <span class="total-amount" id="cart-total-val">$0.00</span>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="drawer-action-btns">
                <a href="<?php echo esc_url(ecommerce_get_page_url('cart')); ?>" class="btn btn-secondary w-100 mb-2">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>View Shopping Bag</span>
                </a>
                <a href="<?php echo esc_url(ecommerce_get_page_url('checkout')); ?>" class="btn btn-primary btn-lg btn-glow w-100" id="cart-checkout-btn">
                    <i class="fa-solid fa-lock"></i>
                    <span>Proceed to Checkout &bull; <span id="checkout-btn-amount">$0.00</span></span>
                </a>
            </div>

            <!-- Checkout Trust Micro-copy -->
            <div class="checkout-trust-badges">
                <span><i class="fa-solid fa-shield-check"></i> 256-Bit SSL Encrypted</span>
                <span><i class="fa-solid fa-rotate-left"></i> 30-Day Risk-Free Returns</span>
            </div>
        </div>
    </aside>
</div>
