<?php
/**
 * Flagship Product Spotlight Template Part
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="spotlight" class="section-spotlight">
    <div class="container">
        <div class="spotlight-card">
            <!-- Background Glow -->
            <div class="spotlight-glow"></div>

            <div class="spotlight-grid">
                <!-- Left Visual with Interactive Feature Badges -->
                <div class="spotlight-visual-col">
                    <div class="spotlight-image-holder">
                        <img src="https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=1000&q=85" alt="Apex Pro Headphones Spotlight" class="spotlight-img">

                        <!-- Hotspot 1 -->
                        <div class="hotspot-pin pin-1" title="Memory foam acoustic seal">
                            <span class="hotspot-ring"></span>
                            <span class="hotspot-point"></span>
                            <div class="hotspot-tooltip">
                                <strong>Ergonomic Memory Foam</strong>
                                <span>Zero fatigue during 12-hour studio sessions</span>
                            </div>
                        </div>

                        <!-- Hotspot 2 -->
                        <div class="hotspot-pin pin-2" title="Active Noise Cancellation">
                            <span class="hotspot-ring"></span>
                            <span class="hotspot-point"></span>
                            <div class="hotspot-tooltip">
                                <strong>Adaptive Hybrid ANC</strong>
                                <span>Triple microphones cancel up to -42dB background noise</span>
                            </div>
                        </div>

                        <!-- Hotspot 3 -->
                        <div class="hotspot-pin pin-3" title="Machined Aerospace Aluminum Yoke">
                            <span class="hotspot-ring"></span>
                            <span class="hotspot-point"></span>
                            <div class="hotspot-tooltip">
                                <strong>Machined Aluminum</strong>
                                <span>Ultra-lightweight aerospace alloy construction</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Feature Specifications & Buy Box -->
                <div class="spotlight-details-col">
                    <div class="spotlight-header">
                        <span class="section-badge"><i class="fa-solid fa-crown"></i> FLAGSHIP SPOTLIGHT</span>
                        <h2 class="spotlight-title">Apex Pro Studio Edition</h2>
                        <p class="spotlight-subtitle">Engineered for mastering sound and eliminating chaos. Hear every instrument as if you were standing in the control room.</p>
                    </div>

                    <!-- Tech Specs Grid -->
                    <div class="spec-matrix">
                        <div class="spec-matrix-item">
                            <div class="spec-icon"><i class="fa-solid fa-sliders"></i></div>
                            <div class="spec-text">
                                <span class="spec-value">45mm</span>
                                <span class="spec-name">Beryllium Drivers</span>
                            </div>
                        </div>
                        <div class="spec-matrix-item">
                            <div class="spec-icon"><i class="fa-solid fa-battery-full"></i></div>
                            <div class="spec-text">
                                <span class="spec-value">60 Hours</span>
                                <span class="spec-name">Wireless Playtime</span>
                            </div>
                        </div>
                        <div class="spec-matrix-item">
                            <div class="spec-icon"><i class="fa-solid fa-volume-xmark"></i></div>
                            <div class="spec-text">
                                <span class="spec-value">-42 dB</span>
                                <span class="spec-name">Smart Active ANC</span>
                            </div>
                        </div>
                        <div class="spec-matrix-item">
                            <div class="spec-icon"><i class="fa-solid fa-bolt"></i></div>
                            <div class="spec-text">
                                <span class="spec-value">38 ms</span>
                                <span class="spec-name">Ultra-Low Latency</span>
                            </div>
                        </div>
                    </div>

                    <!-- Included In The Box -->
                    <div class="included-box">
                        <span class="included-title">What's In The Box:</span>
                        <ul class="included-list">
                            <li><i class="fa-solid fa-check"></i> Apex Pro Wireless Studio Headphones</li>
                            <li><i class="fa-solid fa-check"></i> Hard-Shell Magnetic Travel Case</li>
                            <li><i class="fa-solid fa-check"></i> 1.8m Braided 3.5mm Gold-Plated Audio Cable</li>
                            <li><i class="fa-solid fa-check"></i> USB-C Fast Braided Charging Cable & Flight Adapter</li>
                        </ul>
                    </div>

                    <!-- Buy Box Card -->
                    <div class="spotlight-buy-box">
                        <div class="buy-box-price">
                            <span class="spotlight-price">$299</span>
                            <span class="spotlight-regular">$380</span>
                            <span class="spotlight-save-badge">Save $81 Today</span>
                        </div>
                        <div class="buy-box-actions">
                            <button type="button" class="btn btn-primary btn-glow btn-lg btn-add-cart" data-id="prod-1">
                                <i class="fa-solid fa-bag-shopping"></i>
                                <span>Get Apex Pro Now</span>
                            </button>
                            <button type="button" class="btn btn-secondary btn-quickview" data-id="prod-1">
                                <i class="fa-regular fa-eye"></i>
                                <span>Quick Specs</span>
                            </button>
                        </div>
                        <div class="buy-box-guarantee">
                            <i class="fa-solid fa-rotate-left"></i>
                            <span>Risk-Free 30-Day In-Home Audition Guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
