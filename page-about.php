<?php
/**
 * Template Name: About Us
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
            <span class="bc-current">Our Engineering Story</span>
        </div>
        <h1 class="page-banner-title">Engineering Without Compromise</h1>
        <p class="page-banner-desc">Born from audio obsession and industrial precision. Designed for makers, producers, and modern innovators worldwide.</p>
    </div>
</div>

<main class="site-main py-8">
    <div class="container">
        <!-- Story Split Section -->
        <div class="about-story-grid">
            <div class="about-story-content">
                <span class="section-badge"><i class="fa-solid fa-fingerprint"></i> OUR ORIGIN</span>
                <h2 class="about-heading">Why We Built VELOX</h2>
                <p class="about-paragraph">
                    In 2021, our team of acoustic engineers and industrial designers grew frustrated with the consumer tech landscape: planned obsolescence, plastic squeaks, overhyped bass, and fragile components.
                </p>
                <p class="about-paragraph">
                    We set out with a singular, uncompromising goal: create heirloom-quality hardware with reference-grade acoustic fidelity, machined from aerospace-grade Grade 5 Titanium and solid aluminum alloys.
                </p>
                <div class="about-stats-row">
                    <div class="a-stat">
                        <span class="a-num">50K+</span>
                        <span class="a-label">Active Creators Worldwide</span>
                    </div>
                    <div class="a-stat">
                        <span class="a-num">14</span>
                        <span class="a-label">Acoustic Patents</span>
                    </div>
                    <div class="a-stat">
                        <span class="a-num">98.4%</span>
                        <span class="a-label">CSAT Satisfaction Rate</span>
                    </div>
                </div>
            </div>
            <div class="about-story-media">
                <img src="https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=800&q=80" alt="Studio Headphones Engineering" class="about-img">
            </div>
        </div>

        <!-- Pillars Section -->
        <div class="about-pillars-section">
            <div class="section-heading-centered">
                <span class="section-badge"><i class="fa-solid fa-shield-halved"></i> CORE PRINCIPLES</span>
                <h2 class="section-title">The Three Pillars of VELOX</h2>
            </div>

            <div class="pillars-grid">
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-wave-square"></i></div>
                    <h3>Reference Acoustic Purity</h3>
                    <p>Custom beryllium diaphragms deliver transient speeds that capture the natural air of every vocal track and bass harmonic.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-gem"></i></div>
                    <h3>Aerospace Titanium &amp; Alloy</h3>
                    <p>No creaking plastic hinges. Every joint is CNC-milled from Grade 5 titanium and aircraft-grade aluminum for decades of durability.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid fa-leaf"></i></div>
                    <h3>Sustainable Architecture</h3>
                    <p>100% plastic-free packaging, user-replaceable ear cushions, and carbon-neutral express delivery on all orders worldwide.</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="about-cta-card">
            <h2>Experience The Difference Today</h2>
            <p>Test any VELOX hardware in your home or studio for 30 days risk-free.</p>
            <a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="btn btn-primary btn-lg btn-glow">
                <i class="fa-solid fa-bag-shopping"></i>
                <span>Explore The Collection</span>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
