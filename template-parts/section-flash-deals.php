<?php
/**
 * Limited Time Flash Deals & Bundles
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section id="deals" class="section-flash-deals">
    <div class="container">
        <!-- Section Header with Countdown -->
        <div class="deals-header-card">
            <div class="deals-header-info">
                <span class="section-badge"><i class="fa-solid fa-bolt"></i> LIMITED FLASH SALE</span>
                <h2 class="section-title">Curated Hardware Bundles</h2>
                <p class="section-subtitle">Supercharge your setup. Combine our flagship gear and save an extra 25% with bundled pricing.</p>
            </div>

            <!-- Countdown Timer Box -->
            <div class="countdown-widget">
                <span class="countdown-label">DEALS EXPIRE IN:</span>
                <div class="countdown-digits" id="flash-countdown">
                    <div class="countdown-segment">
                        <span class="digit-number" id="timer-days">02</span>
                        <span class="digit-title">Days</span>
                    </div>
                    <span class="digit-separator">:</span>
                    <div class="countdown-segment">
                        <span class="digit-number" id="timer-hours">14</span>
                        <span class="digit-title">Hours</span>
                    </div>
                    <span class="digit-separator">:</span>
                    <div class="countdown-segment">
                        <span class="digit-number" id="timer-mins">38</span>
                        <span class="digit-title">Mins</span>
                    </div>
                    <span class="digit-separator">:</span>
                    <div class="countdown-segment">
                        <span class="digit-number" id="timer-secs">42</span>
                        <span class="digit-title">Secs</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deals Grid -->
        <div class="deals-grid">
            <!-- Bundle 1 -->
            <div class="bundle-card">
                <div class="bundle-badge">SAVE $120</div>
                <div class="bundle-images">
                    <div class="bundle-thumb">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=400&q=80" alt="Apex Pro Headphones">
                    </div>
                    <div class="bundle-plus"><i class="fa-solid fa-plus"></i></div>
                    <div class="bundle-thumb">
                        <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=400&q=80" alt="SonicAir Earbuds">
                    </div>
                </div>
                <div class="bundle-details">
                    <h3 class="bundle-title">The Master Acoustic Studio Pack</h3>
                    <p class="bundle-desc">Apex Pro Headphones for studio mastering + SonicAir ANC Earbuds for your gym & travel.</p>
                    
                    <div class="bundle-progress">
                        <div class="progress-labels">
                            <span>Hurry, almost sold out!</span>
                            <span class="progress-pct">84% Claimed</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-fill" style="width: 84%;"></div>
                        </div>
                    </div>

                    <div class="bundle-pricing-row">
                        <div class="bundle-prices">
                            <span class="bundle-sale-price">$399</span>
                            <span class="bundle-orig-price">$519</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-add-bundle" data-items="prod-1,prod-3" data-bundle-price="399" data-bundle-title="Master Acoustic Pack">
                            <i class="fa-solid fa-bolt"></i>
                            <span>Claim Bundle</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bundle 2 -->
            <div class="bundle-card">
                <div class="bundle-badge">SAVE $99</div>
                <div class="bundle-images">
                    <div class="bundle-thumb">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=400&q=80" alt="Titanium Watch">
                    </div>
                    <div class="bundle-plus"><i class="fa-solid fa-plus"></i></div>
                    <div class="bundle-thumb">
                        <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=400&q=80" alt="Magnetic Desk Charger">
                    </div>
                </div>
                <div class="bundle-details">
                    <h3 class="bundle-title">Titanium Executive EDC Kit</h3>
                    <p class="bundle-desc">Chronos Ultra Smartwatch Gen 4 + Orbit 3-in-1 Solid Aluminum MagSafe Charger.</p>
                    
                    <div class="bundle-progress">
                        <div class="progress-labels">
                            <span>Limited stock available</span>
                            <span class="progress-pct">72% Claimed</span>
                        </div>
                        <div class="progress-bar-wrap">
                            <div class="progress-fill" style="width: 72%;"></div>
                        </div>
                    </div>

                    <div class="bundle-pricing-row">
                        <div class="bundle-prices">
                            <span class="bundle-sale-price">$379</span>
                            <span class="bundle-orig-price">$478</span>
                        </div>
                        <button type="button" class="btn btn-primary btn-add-bundle" data-items="prod-2,prod-4" data-bundle-price="379" data-bundle-title="Executive EDC Kit">
                            <i class="fa-solid fa-bolt"></i>
                            <span>Claim Bundle</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
