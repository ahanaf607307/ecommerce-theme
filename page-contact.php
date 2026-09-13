<?php
/**
 * Template Name: Contact & Support
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
            <span class="bc-current">Contact &amp; Concierge</span>
        </div>
        <h1 class="page-banner-title">Direct Support &amp; Concierge</h1>
        <p class="page-banner-desc">Have a technical question or need assistance with your order? Our engineering concierge team is here 24/7.</p>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <!-- Contact Cards Row -->
        <div class="contact-channels-grid">
            <div class="channel-card">
                <div class="channel-icon"><i class="fa-solid fa-headset"></i></div>
                <h3>Live Concierge</h3>
                <p>Chat directly with hardware specialists about specs, setup, and acoustics.</p>
                <span class="channel-status"><span class="pulse-dot"></span> Available 24/7</span>
            </div>
            <div class="channel-card">
                <div class="channel-icon"><i class="fa-solid fa-envelope"></i></div>
                <h3>Email Concierge</h3>
                <p>Typical response time under 2 hours for all warranty and customer inquiries.</p>
                <a href="mailto:support@velox.studio" class="channel-link">support@velox.studio</a>
            </div>
            <div class="channel-card">
                <div class="channel-icon"><i class="fa-solid fa-location-dot"></i></div>
                <h3>Design &amp; Acoustic Lab</h3>
                <p>Acoustic R&amp;D Studio, 450 Mission St, Suite 800, San Francisco, CA 94105.</p>
                <span class="channel-sub">Visits by appointment only</span>
            </div>
        </div>

        <!-- Two Column: Inquiry Form + Order Tracking -->
        <div class="contact-split-grid">
            <!-- Left: Contact Form -->
            <div class="contact-form-col">
                <div class="contact-form-card">
                    <span class="section-badge"><i class="fa-solid fa-paper-plane"></i> DIRECT MESSAGE</span>
                    <h2>Send Us An Inquiry</h2>
                    <form id="contact-inquiry-form">
                        <div class="form-row-2">
                            <div class="form-group">
                                <label>Your Full Name</label>
                                <input type="text" placeholder="Alexander Hayes" required>
                            </div>
                            <div class="form-group">
                                <label>Your Email Address</label>
                                <input type="email" placeholder="alexander@example.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Inquiry Topic</label>
                            <select required>
                                <option value="product">Hardware Questions &amp; Audio Specs</option>
                                <option value="shipping">Order Status &amp; Express Shipping</option>
                                <option value="warranty">2-Year Warranty &amp; Replacements</option>
                                <option value="press">Press, Media &amp; Partnerships</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea rows="5" placeholder="How can our engineering team assist you today?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-glow">
                            <span>Send Message</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>
                    <div id="contact-form-success" class="newsletter-success-toast" style="display: none; margin-top: 1.5rem;">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Thank you! Your message has been sent to our concierge desk. We will reply within 2 hours.</span>
                    </div>
                </div>
            </div>

            <!-- Right: Order Tracking Tool -->
            <div class="order-tracking-col">
                <div class="tracking-card">
                    <span class="section-badge"><i class="fa-solid fa-truck-fast"></i> LIVE TRACKING</span>
                    <h2>Track Your Order</h2>
                    <p>Enter your 6-digit order number or DHL/FedEx tracking ID to check dispatch status in real time.</p>
                    <form id="order-tracking-form">
                        <div class="form-group">
                            <label>Order Number / Tracking ID</label>
                            <div class="tracking-input-box">
                                <input type="text" id="tracking-id-input" placeholder="e.g. VLX-89421" required>
                                <button type="submit" class="btn btn-primary btn-sm">Track</button>
                            </div>
                        </div>
                    </form>

                    <div id="tracking-result-box" class="tracking-result-box" style="display: none;">
                        <div class="tracking-status-badge">
                            <i class="fa-solid fa-box-check text-accent"></i>
                            <span>In Transit &bull; Expected Delivery Tomorrow</span>
                        </div>
                        <div class="tracking-timeline">
                            <div class="tl-step done">
                                <span class="tl-dot"></span>
                                <div><strong>Order Placed &amp; QA Checked</strong><small>San Francisco Hub &bull; 08:30 AM</small></div>
                            </div>
                            <div class="tl-step done">
                                <span class="tl-dot"></span>
                                <div><strong>Dispatched via DHL Express Priority</strong><small>In Transit &bull; 02:15 PM</small></div>
                            </div>
                            <div class="tl-step active">
                                <span class="tl-dot"></span>
                                <div><strong>Out for Courier Delivery</strong><small>Local Distribution Facility &bull; 06:40 AM</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-inquiry-form');
    const contactSuccess = document.getElementById('contact-form-success');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            contactForm.style.display = 'none';
            if (contactSuccess) contactSuccess.style.display = 'inline-flex';
        });
    }

    const trackingForm = document.getElementById('order-tracking-form');
    const trackingBox = document.getElementById('tracking-result-box');
    if (trackingForm && trackingBox) {
        trackingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            trackingBox.style.display = 'block';
        });
    }
});
</script>

<?php get_footer(); ?>
