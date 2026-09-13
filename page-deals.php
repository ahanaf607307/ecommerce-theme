<?php
/**
 * Template Name: Flash Deals & Bundles
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
            <span class="bc-current">Flash Deals &amp; Hardware Bundles</span>
        </div>
        <h1 class="page-banner-title">Exclusive Hardware Bundles</h1>
        <p class="page-banner-desc">Supercharge your workflow. Combine our flagship hardware and save up to $120 with limited bundle pricing.</p>
    </div>
</div>

<main class="site-main py-8">
    <!-- Embed Flash Deals Section -->
    <?php get_template_part('template-parts/section-flash-deals'); ?>

    <!-- Extra Exclusive Deals Content -->
    <div class="container py-8">
        <div class="deals-perks-grid">
            <div class="deal-perk-card">
                <div class="perk-icon"><i class="fa-solid fa-tags"></i></div>
                <h3>Stackable Discounts</h3>
                <p>Use code <strong>LUXE50</strong> at checkout to take an additional 15% off any hardware bundle.</p>
            </div>
            <div class="deal-perk-card">
                <div class="perk-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <h3>Priority Express Free</h3>
                <p>All bundle orders automatically qualify for complimentary DHL Express Priority shipping.</p>
            </div>
            <div class="deal-perk-card">
                <div class="perk-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <h3>30-Day Risk-Free Trial</h3>
                <p>Test the full bundle in your studio or workspace. If you're not thrilled, return for a 100% refund.</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
