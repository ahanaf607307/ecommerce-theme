<?php
/**
 * Template Name: Secure Checkout
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="page-header-banner">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa-solid fa-house"></i> Home</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <a href="<?php echo esc_url(ecommerce_get_page_url('cart')); ?>">Cart</a>
            <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
            <span class="bc-current">Secure 256-Bit Checkout</span>
        </div>
        <h1 class="page-banner-title">Express Checkout</h1>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <div class="checkout-layout" id="checkout-main-view">
            <!-- Left: Checkout Forms -->
            <div class="checkout-forms-col">
                <form id="express-checkout-form">
                    <!-- Step 1: Contact -->
                    <div class="checkout-step-card">
                        <div class="step-header">
                            <span class="step-num">1</span>
                            <h3>Customer Information</h3>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" placeholder="alexander@example.com" required>
                            </div>
                            <div class="form-group">
                                <label>Phone (for delivery SMS)</label>
                                <input type="tel" placeholder="+1 (555) 019-2834" required>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Shipping Address -->
                    <div class="checkout-step-card">
                        <div class="step-header">
                            <span class="step-num">2</span>
                            <h3>Shipping Address</h3>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Alexander" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Hayes" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Street Address</label>
                            <input type="text" placeholder="742 Evergreen Terrace, Suite 4" required>
                        </div>
                        <div class="form-row-3">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" placeholder="San Francisco" required>
                            </div>
                            <div class="form-group">
                                <label>State / Province</label>
                                <input type="text" placeholder="CA" required>
                            </div>
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="text" placeholder="94105" required>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Payment Simulation -->
                    <div class="checkout-step-card">
                        <div class="step-header">
                            <span class="step-num">3</span>
                            <h3>Payment Method</h3>
                        </div>
                        <div class="payment-tabs-select">
                            <label class="pay-option active">
                                <input type="radio" name="payment_method" value="card" checked>
                                <span><i class="fa-solid fa-credit-card"></i> Credit Card</span>
                            </label>
                            <label class="pay-option">
                                <input type="radio" name="payment_method" value="apple">
                                <span><i class="fa-brands fa-apple-pay"></i> Apple Pay</span>
                            </label>
                            <label class="pay-option">
                                <input type="radio" name="payment_method" value="paypal">
                                <span><i class="fa-brands fa-paypal"></i> PayPal</span>
                            </label>
                        </div>

                        <div class="card-inputs-box mt-4">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" placeholder="•••• •••• •••• 4242" value="4242 4242 4242 4242">
                            </div>
                            <div class="form-row-2">
                                <div class="form-group">
                                    <label>Expires (MM/YY)</label>
                                    <input type="text" placeholder="12/28" value="12/28">
                                </div>
                                <div class="form-group">
                                    <label>Security CVC</label>
                                    <input type="text" placeholder="982" value="982">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-glow w-100" id="place-order-submit-btn">
                        <i class="fa-solid fa-lock"></i>
                        <span>Complete Order &bull; <span id="checkout-order-total">$0.00</span></span>
                    </button>
                </form>
            </div>

            <!-- Right: Order Items Summary -->
            <div class="checkout-summary-col">
                <div class="cart-summary-card">
                    <h3 class="summary-title">Order Items</h3>
                    <div id="checkout-items-list" class="checkout-items-box mb-4">
                        <!-- Rendered by JS -->
                    </div>

                    <div class="cart-totals">
                        <div class="totals-row">
                            <span>Subtotal</span>
                            <span id="co-subtotal">$0.00</span>
                        </div>
                        <div class="totals-row" id="co-discount-row" style="display: none;">
                            <span>Promo Discount (15%)</span>
                            <span class="text-accent" id="co-discount">-$0.00</span>
                        </div>
                        <div class="totals-row">
                            <span>Express Delivery</span>
                            <span id="co-shipping">FREE</span>
                        </div>
                        <div class="totals-divider"></div>
                        <div class="totals-row total-highlight">
                            <span>Total Due</span>
                            <span class="total-amount" id="co-total">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Screen -->
        <div id="checkout-success-view" class="checkout-success-box text-center" style="display: none; padding: 4rem 1rem;">
            <div class="success-icon-wrap" style="width: 80px; height: 80px; border-radius: 50%; background: rgba(16,185,129,0.15); border: 2px solid #10b981; color: #10b981; font-size: 2.5rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2 class="section-title">Order Placed Successfully!</h2>
            <p class="text-secondary mb-4" style="max-width: 500px; margin: 0 auto 2rem;">
                Thank you for your order! Your confirmation and DHL Express tracking number have been sent to your email. Order reference: <strong>VLX-<?php echo rand(10000, 99999); ?></strong>.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="btn btn-primary">
                    <span>Continue Shopping</span>
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-secondary">
                    <span>Return to Home</span>
                </a>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const STORAGE_KEY_CART = 'velox_ecommerce_cart_v1';
    const STORAGE_KEY_PROMO = 'velox_ecommerce_promo_v1';
    const itemsList = document.getElementById('checkout-items-list');
    const subtotalEl = document.getElementById('co-subtotal');
    const discountRow = document.getElementById('co-discount-row');
    const discountEl = document.getElementById('co-discount');
    const totalEl = document.getElementById('co-total');
    const btnTotal = document.getElementById('checkout-order-total');
    const form = document.getElementById('express-checkout-form');
    const mainView = document.getElementById('checkout-main-view');
    const successView = document.getElementById('checkout-success-view');

    const cart = JSON.parse(localStorage.getItem(STORAGE_KEY_CART) || '[]');
    const promo = JSON.parse(localStorage.getItem(STORAGE_KEY_PROMO) || 'null');

    if (cart.length === 0) {
        itemsList.innerHTML = '<p class="text-muted">No items in bag.</p>';
    } else {
        let html = '';
        cart.forEach(it => {
            html += `
                <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem; font-size: 0.88rem;">
                    <img src="${it.image}" style="width: 44px; height: 44px; border-radius: 6px; object-fit: cover;">
                    <div style="flex:1;">
                        <div style="font-weight: 700; color: #fff;">${it.title}</div>
                        <small style="color: #94a3b8;">Qty: ${it.qty} &bull; ${it.color}</small>
                    </div>
                    <div style="font-weight: 700;">$${(it.price * it.qty).toFixed(2)}</div>
                </div>
            `;
        });
        itemsList.innerHTML = html;
    }

    const subtotal = cart.reduce((s, x) => s + (x.price * x.qty), 0);
    let discount = 0;
    if (promo) {
        discount = subtotal * (promo.rate || 0.15);
        if (discountRow) discountRow.style.display = 'flex';
        if (discountEl) discountEl.textContent = `-$${discount.toFixed(2)}`;
    }
    const shipping = subtotal >= 99 ? 0 : (subtotal > 0 ? 9.99 : 0);
    const total = Math.max(0, subtotal - discount + shipping);

    if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);
    if (totalEl) totalEl.textContent = '$' + total.toFixed(2);
    if (btnTotal) btnTotal.textContent = '$' + total.toFixed(2);

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // Clear cart
            localStorage.removeItem(STORAGE_KEY_CART);
            if (typeof window.renderCartUI === 'function') window.renderCartUI();
            if (mainView) mainView.style.display = 'none';
            if (successView) {
                successView.style.display = 'block';
                successView.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
});
</script>

<?php get_footer(); ?>
