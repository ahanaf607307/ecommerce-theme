<?php
/**
 * Footer Template
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Newsletter & VIP Club Section -->
<section class="section-newsletter">
    <div class="container">
        <div class="newsletter-card">
            <div class="newsletter-glow"></div>
            <div class="newsletter-content">
                <span class="section-badge"><i class="fa-solid fa-gift"></i> VIP CLUB EXCLUSIVE</span>
                <h2 class="newsletter-title">Unlock 15% Off Your First Order</h2>
                <p class="newsletter-desc">Join 45,000+ creators and innovators receiving early access drops, secret seasonal sales, and member-only pricing.</p>
                <form class="newsletter-form" id="newsletter-signup-form">
                    <div class="input-group">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" id="newsletter-email" placeholder="Enter your email address..." required>
                        <button type="submit" class="btn btn-primary" id="newsletter-submit-btn">
                            <span>Claim 15% Off</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="newsletter-terms">
                        <span>No spam. Instant coupon code sent to your inbox. Unsubscribe anytime.</span>
                    </div>
                </form>
                <div class="newsletter-success-toast" id="newsletter-success-msg" style="display: none;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Success! Your 15% discount code is <strong>LUXE50</strong>. Code automatically copied!</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust & Guarantees Strip -->
<section class="section-trust">
    <div class="container trust-grid">
        <div class="trust-item">
            <div class="trust-icon-wrap">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <div class="trust-text">
                <h4 class="trust-title">Free Express Shipping</h4>
                <p class="trust-desc">Complimentary DHL/FedEx on all orders over $99.</p>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon-wrap">
                <i class="fa-solid fa-rotate-left"></i>
            </div>
            <div class="trust-text">
                <h4 class="trust-title">30-Day Free Returns</h4>
                <p class="trust-desc">Test it at home risk-free with prepaid return labels.</p>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon-wrap">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="trust-text">
                <h4 class="trust-title">2-Year Full Warranty</h4>
                <p class="trust-desc">Complete coverage on all hardware and craftsmanship.</p>
            </div>
        </div>
        <div class="trust-item">
            <div class="trust-icon-wrap">
                <i class="fa-solid fa-headset"></i>
            </div>
            <div class="trust-text">
                <h4 class="trust-title">24/7 Priority Support</h4>
                <p class="trust-desc">Dedicated tech support team ready to assist anytime.</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Site Footer -->
<footer class="site-footer">
    <div class="container footer-top">
        <div class="footer-brand-col">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo footer-logo">
                <span class="logo-icon"><i class="fa-solid fa-bolt-lightning"></i></span>
                <span class="logo-text">VELOX<span class="text-accent">.</span></span>
                <span class="logo-sub">STUDIO</span>
            </a>
            <p class="footer-bio">
                Precision-engineered tech, audiophile audio systems, and modern EDC accessories designed for makers, innovators, and modern tastemakers worldwide.
            </p>
            <div class="footer-socials">
                <a href="#" class="social-icon" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="social-icon" aria-label="Discord"><i class="fa-brands fa-discord"></i></a>
                <a href="#" class="social-icon" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            </div>
        </div>

        <div class="footer-nav-col">
            <h5 class="footer-col-title">Shop Gear</h5>
            <ul class="footer-links">
                <li><a href="#products">Studio Headphones</a></li>
                <li><a href="#products">True Wireless Earbuds</a></li>
                <li><a href="#products">Smart Titanium Watches</a></li>
                <li><a href="#products">MagSafe Fast Chargers</a></li>
                <li><a href="#products">Desk Accessories & EDC</a></li>
                <li><a href="#deals">Limited Flash Bundles</a></li>
            </ul>
        </div>

        <div class="footer-nav-col">
            <h5 class="footer-col-title">Customer Care</h5>
            <ul class="footer-links">
                <li><a href="#">Track Your Order</a></li>
                <li><a href="#">Shipping Rates & Policies</a></li>
                <li><a href="#">Warranty & Claims</a></li>
                <li><a href="#">Returns & Exchanges</a></li>
                <li><a href="#">Product Care & Guides</a></li>
                <li><a href="#">Contact Concierge</a></li>
            </ul>
        </div>

        <div class="footer-nav-col">
            <h5 class="footer-col-title">Company & Press</h5>
            <ul class="footer-links">
                <li><a href="#">Our Engineering Story</a></li>
                <li><a href="#">Sustainability & Materials</a></li>
                <li><a href="#">Press Kit & Media</a></li>
                <li><a href="#">Affiliate Program</a></li>
                <li><a href="#">Careers (We're Hiring)</a></li>
                <li><a href="#">Privacy & Terms</a></li>
            </ul>
        </div>
    </div>

    <div class="container footer-bottom">
        <div class="footer-bottom-inner">
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> <strong>VELOX STUDIO</strong>. All rights reserved. Powered by WordPress Ecommerce Theme.
            </p>
            <div class="payment-methods">
                <span class="payment-badge" title="Visa"><i class="fa-brands fa-cc-visa"></i></span>
                <span class="payment-badge" title="Mastercard"><i class="fa-brands fa-cc-mastercard"></i></span>
                <span class="payment-badge" title="American Express"><i class="fa-brands fa-cc-amex"></i></span>
                <span class="payment-badge" title="Apple Pay"><i class="fa-brands fa-apple-pay"></i></span>
                <span class="payment-badge" title="Google Pay"><i class="fa-brands fa-google-pay"></i></span>
                <span class="payment-badge" title="PayPal"><i class="fa-brands fa-paypal"></i></span>
            </div>
        </div>
    </div>
</footer>

<!-- Back to top floating button -->
<button type="button" class="back-to-top" id="back-to-top-btn" aria-label="Back to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<!-- Slide-over Cart Drawer Template Part -->
<?php get_template_part('template-parts/drawer-cart'); ?>

<!-- Quick View Modal Template Part -->
<?php get_template_part('template-parts/modal-quickview'); ?>

<!-- Toast Notification Container -->
<div id="ecommerce-toast-container" class="ecommerce-toast-container" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
