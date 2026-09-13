<?php
/**
 * Header Template
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name="description" content="Discover premium audiophile headphones, smart wearables, minimalist desk gear, and modern accessories designed for maximum performance.">
    <?php wp_head(); ?>
</head>
<body <?php body_class('ecommerce-body'); ?>>
<?php wp_body_open(); ?>

<!-- Announcement Bar -->
<div id="announcement-bar" class="announcement-bar">
    <div class="container announcement-content">
        <div class="announcement-badge">
            <span class="pulse-dot"></span>
            <span>FLASH OFFER</span>
        </div>
        <div class="announcement-text">
            <span>Free Express Worldwide Shipping on orders over $99! Use code:</span>
            <button type="button" class="promo-code-btn" id="promo-copy-btn" title="Click to copy coupon">
                <code>LUXE50</code>
                <i class="fa-regular fa-clone"></i>
            </button>
        </div>
        <div class="announcement-timer">
            <i class="fa-regular fa-clock"></i>
            <span id="announcement-countdown">Ends in 08:42:19</span>
        </div>
        <button type="button" class="announcement-close" id="announcement-close" aria-label="Close notification">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<!-- Main Sticky Header -->
<header id="main-header" class="site-header">
    <div class="container header-inner">
        <!-- Logo -->
        <div class="site-brand">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" rel="home">
                    <span class="logo-icon"><i class="fa-solid fa-bolt-lightning"></i></span>
                    <span class="logo-text">VELOX<span class="text-accent">.</span></span>
                    <span class="logo-sub">STUDIO</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Desktop Navigation -->
        <?php
        $current_route = get_query_var('ecommerce_route');
        if (empty($current_route) && isset($_GET['route'])) {
            $current_route = sanitize_key($_GET['route']);
        }
        $is_home = is_front_page() && empty($current_route) && empty(get_query_var('ecommerce_product')) && !isset($_GET['product']);
        ?>
        <nav class="desktop-navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'ecommerce'); ?>">
            <ul class="nav-menu">
                <li class="nav-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo $is_home ? 'active' : ''; ?>">Home</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="nav-link <?php echo $current_route === 'shop' ? 'active' : ''; ?>">Shop Gear</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('categories')); ?>" class="nav-link <?php echo $current_route === 'categories' ? 'active' : ''; ?>">Categories</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('deals')); ?>" class="nav-link <?php echo $current_route === 'deals' ? 'active' : ''; ?>">Deals <span class="nav-pill">HOT</span></a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('reviews')); ?>" class="nav-link <?php echo $current_route === 'reviews' ? 'active' : ''; ?>">Reviews</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('about')); ?>" class="nav-link <?php echo $current_route === 'about' ? 'active' : ''; ?>">Our Story</a></li>
                <li class="nav-item"><a href="<?php echo esc_url(ecommerce_get_page_url('contact')); ?>" class="nav-link <?php echo $current_route === 'contact' ? 'active' : ''; ?>">Contact</a></li>
            </ul>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <!-- Search Trigger -->
            <button type="button" class="action-btn" id="search-trigger-btn" aria-label="Search products">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <!-- Wishlist Trigger -->
            <button type="button" class="action-btn" id="wishlist-trigger-btn" aria-label="View Wishlist">
                <i class="fa-regular fa-heart"></i>
                <span class="badge-count" id="wishlist-badge-count">0</span>
            </button>

            <!-- Shopping Cart Trigger -->
            <button type="button" class="cart-trigger-btn" id="cart-drawer-trigger" aria-label="Open Cart">
                <div class="cart-icon-wrap">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="badge-count" id="cart-badge-count">0</span>
                </div>
                <span class="cart-amount" id="header-cart-total">$0.00</span>
            </button>

            <!-- Mobile Menu Toggle -->
            <button type="button" class="action-btn mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div id="mobile-drawer" class="mobile-drawer">
    <div class="mobile-drawer-overlay" id="mobile-drawer-overlay"></div>
    <div class="mobile-drawer-content">
        <div class="mobile-drawer-header">
            <div class="brand-logo">
                <span class="logo-icon"><i class="fa-solid fa-bolt-lightning"></i></span>
                <span class="logo-text">VELOX<span class="text-accent">.</span></span>
            </div>
            <button type="button" class="drawer-close-btn" id="mobile-drawer-close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <nav class="mobile-nav">
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-nav-link <?php echo $is_home ? 'active' : ''; ?>">Home</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('shop')); ?>" class="mobile-nav-link <?php echo $current_route === 'shop' ? 'active' : ''; ?>">Shop Gear</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('categories')); ?>" class="mobile-nav-link <?php echo $current_route === 'categories' ? 'active' : ''; ?>">Categories</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('deals')); ?>" class="mobile-nav-link <?php echo $current_route === 'deals' ? 'active' : ''; ?>">Limited Deals</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('reviews')); ?>" class="mobile-nav-link <?php echo $current_route === 'reviews' ? 'active' : ''; ?>">Customer Reviews</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('about')); ?>" class="mobile-nav-link <?php echo $current_route === 'about' ? 'active' : ''; ?>">Our Story</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('contact')); ?>" class="mobile-nav-link <?php echo $current_route === 'contact' ? 'active' : ''; ?>">Contact Concierge</a></li>
                <li><a href="<?php echo esc_url(ecommerce_get_page_url('cart')); ?>" class="mobile-nav-link <?php echo $current_route === 'cart' ? 'active' : ''; ?>"><i class="fa-solid fa-bag-shopping"></i> View Cart</a></li>
            </ul>
        </nav>
        <div class="mobile-drawer-footer">
            <div class="shipping-banner">
                <i class="fa-solid fa-truck-fast"></i>
                <span>Free Express Shipping Over $99</span>
            </div>
        </div>
    </div>
</div>

<!-- Search Modal -->
<div id="search-modal" class="search-modal">
    <div class="search-modal-backdrop" id="search-modal-backdrop"></div>
    <div class="search-modal-container">
        <div class="search-modal-header">
            <div class="search-input-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="live-search-input" placeholder="Search headphones, smartwatches, chargers..." autocomplete="off">
                <button type="button" id="clear-search-btn" class="clear-search"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <button type="button" class="close-search-btn" id="close-search-modal">
                <span>Esc</span>
            </button>
        </div>
        <div class="search-quick-tags">
            <span class="tag-title">Popular:</span>
            <button type="button" class="search-tag" data-query="Headphones">Headphones</button>
            <button type="button" class="search-tag" data-query="Watch">Watch</button>
            <button type="button" class="search-tag" data-query="Earbuds">Earbuds</button>
            <button type="button" class="search-tag" data-query="Charger">Desk Charger</button>
            <button type="button" class="search-tag" data-query="Titanium">Titanium</button>
        </div>
        <div class="search-results-list" id="search-results-container">
            <!-- Populated dynamically by JS -->
        </div>
    </div>
</div>
