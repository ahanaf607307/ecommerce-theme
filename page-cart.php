<?php
/**
 * Template Name: Shopping Cart
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
            <span class="bc-current">Shopping Bag</span>
        </div>
        <h1 class="page-banner-title">Review Your Hardware Selection</h1>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <!-- Full Cart Container -->
        <div class="full-cart-layout" id="full-cart-view">
            <!-- Left: Items Table / Empty State -->
            <div class="full-cart-items-col">
                <div class="cart-shipping-bar mb-4" style="border-radius: var(--radius-md);">
                    <div class="shipping-bar-text" id="full-shipping-msg">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span>Add <strong>$99.00</strong> more to unlock <strong>Free Express Shipping</strong></span>
                    </div>
                    <div class="shipping-progress-track">
                        <div class="shipping-progress-fill" id="full-shipping-fill" style="width: 0%;"></div>
                    </div>
                </div>

                <div class="full-cart-table-card">
                    <div id="full-cart-list">
                        <!-- Populated by JavaScript from localStorage cartState -->
                    </div>
                </div>

                <div class="cart-bottom-nav mt-4">
                    <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="full-cart-summary-col">
                <div class="cart-summary-card">
                    <h3 class="summary-title">Order Summary</h3>

                    <!-- Promo Code Box -->
                    <div class="cart-promo-section mb-4">
                        <form class="promo-form" id="page-promo-form">
                            <input type="text" id="page-promo-input" placeholder="Promo code (try LUXE50)">
                            <button type="submit" class="btn btn-secondary btn-sm">Apply</button>
                        </form>
                        <div id="page-promo-feedback" class="promo-feedback"></div>
                    </div>

                    <div class="cart-totals">
                        <div class="totals-row">
                            <span>Subtotal</span>
                            <span id="full-subtotal-val">$0.00</span>
                        </div>
                        <div class="totals-row discount-row" id="full-discount-row" style="display: none;">
                            <span>Promo Discount (15%)</span>
                            <span class="text-accent" id="full-discount-val">-$0.00</span>
                        </div>
                        <div class="totals-row">
                            <span>Express Shipping</span>
                            <span id="full-shipping-val">Calculated at checkout</span>
                        </div>
                        <div class="totals-divider"></div>
                        <div class="totals-row total-highlight">
                            <span>Estimated Total</span>
                            <span class="total-amount" id="full-total-val">$0.00</span>
                        </div>
                    </div>

                    <a href="<?php echo esc_url(ecommerce_get_page_url('checkout')); ?>" class="btn btn-primary btn-lg btn-glow w-100" id="full-checkout-btn">
                        <i class="fa-solid fa-lock"></i>
                        <span>Proceed To Checkout</span>
                    </a>

                    <div class="checkout-trust-badges mt-4">
                        <span><i class="fa-solid fa-shield-check"></i> 256-Bit SSL Encrypted</span>
                        <span><i class="fa-solid fa-rotate-left"></i> 30-Day Guarantee</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const listContainer = document.getElementById('full-cart-list');
    const subtotalEl = document.getElementById('full-subtotal-val');
    const totalEl = document.getElementById('full-total-val');
    const discountRow = document.getElementById('full-discount-row');
    const discountEl = document.getElementById('full-discount-val');
    const shippingEl = document.getElementById('full-shipping-val');
    const shippingMsg = document.getElementById('full-shipping-msg');
    const shippingFill = document.getElementById('full-shipping-fill');
    const promoForm = document.getElementById('page-promo-form');
    const promoInput = document.getElementById('page-promo-input');
    const promoFeedback = document.getElementById('page-promo-feedback');

    const STORAGE_KEY_CART = 'velox_ecommerce_cart_v1';
    const STORAGE_KEY_PROMO = 'velox_ecommerce_promo_v1';

    function getCart() {
        return JSON.parse(localStorage.getItem(STORAGE_KEY_CART) || '[]');
    }
    function getPromo() {
        return JSON.parse(localStorage.getItem(STORAGE_KEY_PROMO) || 'null');
    }

    function renderPageCart() {
        const cart = getCart();
        const promo = getPromo();

        if (cart.length === 0) {
            listContainer.innerHTML = `
                <div class="cart-empty-state py-8 text-center">
                    <div class="empty-icon-wrap" style="margin: 0 auto 1rem;"><i class="fa-solid fa-bag-shopping"></i></div>
                    <h3>Your bag is completely empty</h3>
                    <p class="text-secondary mb-4">Discover our studio headphones, titanium watches, and EDC accessories.</p>
                    <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="btn btn-primary"><span>Explore Shop</span></a>
                </div>
            `;
            if (subtotalEl) subtotalEl.textContent = '$0.00';
            if (totalEl) totalEl.textContent = '$0.00';
            if (shippingFill) shippingFill.style.width = '0%';
            return;
        }

        let html = '<div class="page-cart-items-table">';
        cart.forEach(item => {
            html += `
                <div class="page-cart-item-row" data-id="${item.cartItemId}">
                    <img src="${item.image}" alt="${item.title}" class="page-cart-thumb">
                    <div class="page-cart-details">
                        <h4>${item.title}</h4>
                        <span class="text-muted">Color: ${item.color}</span>
                    </div>
                    <div class="page-cart-qty-picker">
                        <button type="button" class="btn-p-minus" data-id="${item.cartItemId}"><i class="fa-solid fa-minus"></i></button>
                        <span>${item.qty}</span>
                        <button type="button" class="btn-p-plus" data-id="${item.cartItemId}"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="page-cart-item-price">$${(item.price * item.qty).toFixed(2)}</div>
                    <button type="button" class="btn-p-delete" data-id="${item.cartItemId}"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            `;
        });
        html += '</div>';
        listContainer.innerHTML = html;

        // Add listeners
        listContainer.querySelectorAll('.btn-p-minus').forEach(btn => {
            btn.addEventListener('click', () => {
                let c = getCart();
                let it = c.find(x => x.cartItemId === btn.dataset.id);
                if (it) {
                    it.qty -= 1;
                    if (it.qty <= 0) c = c.filter(x => x.cartItemId !== btn.dataset.id);
                    localStorage.setItem(STORAGE_KEY_CART, JSON.stringify(c));
                    renderPageCart();
                    if (typeof window.renderCartUI === 'function') window.renderCartUI();
                }
            });
        });

        listContainer.querySelectorAll('.btn-p-plus').forEach(btn => {
            btn.addEventListener('click', () => {
                let c = getCart();
                let it = c.find(x => x.cartItemId === btn.dataset.id);
                if (it) {
                    it.qty += 1;
                    localStorage.setItem(STORAGE_KEY_CART, JSON.stringify(c));
                    renderPageCart();
                    if (typeof window.renderCartUI === 'function') window.renderCartUI();
                }
            });
        });

        listContainer.querySelectorAll('.btn-p-delete').forEach(btn => {
            btn.addEventListener('click', () => {
                let c = getCart().filter(x => x.cartItemId !== btn.dataset.id);
                localStorage.setItem(STORAGE_KEY_CART, JSON.stringify(c));
                renderPageCart();
                if (typeof window.renderCartUI === 'function') window.renderCartUI();
            });
        });

        // Totals
        const subtotal = cart.reduce((s, x) => s + (x.price * x.qty), 0);
        let discount = 0;
        if (promo) {
            discount = subtotal * (promo.rate || 0.15);
            if (discountRow) discountRow.style.display = 'flex';
            if (discountEl) discountEl.textContent = `-$${discount.toFixed(2)}`;
        } else {
            if (discountRow) discountRow.style.display = 'none';
        }

        const isFree = subtotal >= 99;
        const shipping = isFree ? 0 : 9.99;
        const total = Math.max(0, subtotal - discount + shipping);

        if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);
        if (totalEl) totalEl.textContent = '$' + total.toFixed(2);
        if (shippingEl) shippingEl.textContent = isFree ? 'FREE' : '$9.99';

        if (shippingFill) {
            const pct = Math.min(100, Math.round((subtotal / 99) * 100));
            shippingFill.style.width = pct + '%';
            if (isFree) {
                shippingMsg.innerHTML = '<i class="fa-solid fa-circle-check text-accent"></i> <span><strong>Free Express Shipping Unlocked!</strong></span>';
            } else {
                shippingMsg.innerHTML = `<i class="fa-solid fa-truck-fast"></i> <span>Add <strong>$${(99 - subtotal).toFixed(2)}</strong> more for <strong>Free Express Shipping</strong></span>`;
            }
        }
    }

    if (promoForm) {
        promoForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const val = promoInput.value.trim().toUpperCase();
            if (val === 'LUXE50') {
                localStorage.setItem(STORAGE_KEY_PROMO, JSON.stringify({ code: 'LUXE50', rate: 0.15 }));
                promoFeedback.className = 'promo-feedback success';
                promoFeedback.textContent = 'Coupon applied: 15% discount!';
                renderPageCart();
            } else {
                promoFeedback.className = 'promo-feedback error';
                promoFeedback.textContent = 'Invalid promo code. Try LUXE50';
            }
        });
    }

    renderPageCart();
});
</script>

<?php get_footer(); ?>
