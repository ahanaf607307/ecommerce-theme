<?php
/**
 * Ecommerce Theme Functions and Definitions
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('ECOMMERCE_THEME_VERSION', '1.0.2');
define('ECOMMERCE_THEME_DIR', get_template_directory());
define('ECOMMERCE_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function ecommerce_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add support for core custom logo.
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Switch default core markup for search form, comment form, etc. to output valid HTML5.
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add WooCommerce support if plugin is present
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'ecommerce'),
        'footer'  => esc_html__('Footer Menu', 'ecommerce'),
    ]);
}
add_action('after_setup_theme', 'ecommerce_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function ecommerce_theme_scripts() {
    // Google Fonts: Plus Jakarta Sans & Outfit
    wp_enqueue_style(
        'ecommerce-google-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
        [],
        null
    );

    // FontAwesome Icons (Free CDN for crisp icons)
    wp_enqueue_style(
        'ecommerce-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );

    // Main Theme Stylesheet
    wp_enqueue_style(
        'ecommerce-main-style',
        ECOMMERCE_THEME_URI . '/assets/css/ecommerce.css',
        ['ecommerce-google-fonts', 'ecommerce-fontawesome'],
        ECOMMERCE_THEME_VERSION
    );

    // Main Theme JavaScript
    wp_enqueue_script(
        'ecommerce-main-js',
        ECOMMERCE_THEME_URI . '/assets/js/ecommerce.js',
        [],
        ECOMMERCE_THEME_VERSION,
        true
    );

    // Pass configuration to JS
    wp_localize_script('ecommerce-main-js', 'ecommerceConfig', [
        'ajaxUrl'               => admin_url('admin-ajax.php'),
        'currencySymbol'        => '$',
        'freeShippingThreshold' => 99,
        'discountCode'          => 'LUXE50',
        'discountRate'          => 0.15, // 15% discount
        'themeUri'              => ECOMMERCE_THEME_URI,
        'homeUrl'               => home_url('/'),
        'shopUrl'               => home_url('/shop/'),
        'categoriesUrl'         => home_url('/categories/'),
        'dealsUrl'              => home_url('/deals/'),
        'aboutUrl'              => home_url('/about/'),
        'reviewsUrl'            => home_url('/reviews/'),
        'contactUrl'            => home_url('/contact/'),
        'cartUrl'               => home_url('/cart/'),
        'checkoutUrl'           => home_url('/checkout/'),
    ]);
}
add_action('wp_enqueue_scripts', 'ecommerce_theme_scripts');

/**
 * Fallback & Seed Products Data for Standalone Landing Page
 *
 * Provides a curated list of high-converting, premium tech & lifestyle products
 * when WooCommerce has no seeded products, ensuring the landing page is instantly
 * gorgeous and testable out of the box.
 */
function ecommerce_get_catalog_products() {
    $default_products = [
        [
            'id'             => 'prod-1',
            'title'          => 'Apex Pro Wireless Studio Headphones',
            'category'       => 'audio',
            'category_name'  => 'Wireless Audio',
            'price'          => 299,
            'regular_price'  => 380,
            'rating'         => 4.9,
            'reviews_count'  => 328,
            'badge'          => 'Best Seller',
            'badge_type'     => 'hot',
            'is_trending'    => true,
            'is_bestseller'  => true,
            'is_new'         => false,
            'stock'          => 7,
            'image'          => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80',
                'https://images.unsplash.com/photo-1484704849700-f032a568e944?auto=format&fit=crop&w=900&q=80',
                'https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#0F172A', '#E2E8F0', '#475569'],
            'color_names'    => ['Midnight Slate', 'Polar Silver', 'Space Gray'],
            'short_desc'     => 'Audiophile-grade Active Noise Cancellation, custom 45mm beryllium drivers, and 60 hours of wireless playback.',
            'features'       => ['Hybrid Active Noise Canceling', '60-Hour Fast-Charge Battery', 'Lossless Hi-Res Spatial Audio', 'Ergonomic Memory Foam Cushions']
        ],
        [
            'id'             => 'prod-2',
            'title'          => 'Chronos Ultra Smartwatch Gen 4',
            'category'       => 'wearables',
            'category_name'  => 'Smart Tech',
            'price'          => 349,
            'regular_price'  => 449,
            'rating'         => 4.8,
            'reviews_count'  => 194,
            'badge'          => 'Save $100',
            'badge_type'     => 'sale',
            'is_trending'    => true,
            'is_bestseller'  => false,
            'is_new'         => true,
            'stock'          => 4,
            'image'          => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80',
                'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#18181B', '#D97706', '#0284C7'],
            'color_names'    => ['Titanium Black', 'Sunset Amber', 'Deep Marine'],
            'short_desc'     => 'Grade 5 Aerospace Titanium chassis with Sapphire crystal, ECG monitoring, and offline GPS topo maps.',
            'features'       => ['Grade 5 Titanium Case', 'Dual-Frequency Precision GPS', '100m Water Resistance (10 ATM)', '14-Day Battery Life']
        ],
        [
            'id'             => 'prod-3',
            'title'          => 'SonicAir True Wireless ANC Earbuds',
            'category'       => 'audio',
            'category_name'  => 'Wireless Audio',
            'price'          => 159,
            'regular_price'  => 199,
            'rating'         => 4.9,
            'reviews_count'  => 512,
            'badge'          => 'Top Rated',
            'badge_type'     => 'hot',
            'is_trending'    => true,
            'is_bestseller'  => true,
            'is_new'         => false,
            'stock'          => 12,
            'image'          => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=900&q=80',
                'https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#F8FAFC', '#0F172A'],
            'color_names'    => ['Ceramic White', 'Obsidian Black'],
            'short_desc'     => 'Pocket-sized sonic powerhouse with intelligent transparency mode and wireless Qi charging case.',
            'features'       => ['Smart Adaptive ANC', '36h Playtime with Qi Case', 'IPX7 Sweat & Water Proof', 'Triple Beamforming Mics']
        ],
        [
            'id'             => 'prod-4',
            'title'          => 'Orbit Magnetic Wireless Desk Charger',
            'category'       => 'edc',
            'category_name'  => 'EDC & Workspace',
            'price'          => 79,
            'regular_price'  => 99,
            'rating'         => 4.7,
            'reviews_count'  => 118,
            'badge'          => 'New Drop',
            'badge_type'     => 'new',
            'is_trending'    => false,
            'is_bestseller'  => false,
            'is_new'         => true,
            'stock'          => 9,
            'image'          => 'https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#334155', '#E2E8F0', '#0F172A'],
            'color_names'    => ['Anodized Gray', 'Silver Frost', 'Matte Carbon'],
            'short_desc'     => '3-in-1 MagSafe fast charger for Phone, Watch, and Earbuds carved from solid aerospace aluminum.',
            'features'       => ['15W MagSafe Fast Charge', 'Solid Aircraft Aluminum', 'Foldable Travel Architecture', 'LED Ambient Glow Ring']
        ],
        [
            'id'             => 'prod-5',
            'title'          => 'Veloce Minimalist Mechanical Keyboard',
            'category'       => 'edc',
            'category_name'  => 'EDC & Workspace',
            'price'          => 189,
            'regular_price'  => 229,
            'rating'         => 4.9,
            'reviews_count'  => 276,
            'badge'          => 'Staff Pick',
            'badge_type'     => 'hot',
            'is_trending'    => true,
            'is_bestseller'  => true,
            'is_new'         => false,
            'stock'          => 3,
            'image'          => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#1E293B', '#F1F5F9'],
            'color_names'    => ['Carbon Retro', 'Chalk White'],
            'short_desc'     => 'Gasket-mounted acoustic dampening, hot-swappable tactile switches, and wireless Bluetooth 5.3 + 2.4GHz.',
            'features'       => ['Gasket Mount Structure', 'Factory Lubed Linear Switches', 'PBT Dye-Sub Keycaps', 'South-Facing Per-Key RGB']
        ],
        [
            'id'             => 'prod-6',
            'title'          => 'Nomad Weatherproof Tech Sling Bag',
            'category'       => 'lifestyle',
            'category_name'  => 'Lifestyle Gear',
            'price'          => 119,
            'regular_price'  => 149,
            'rating'         => 4.8,
            'reviews_count'  => 142,
            'badge'          => 'Popular',
            'badge_type'     => 'sale',
            'is_trending'    => false,
            'is_bestseller'  => true,
            'is_new'         => false,
            'stock'          => 8,
            'image'          => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#0F172A', '#3F3F46', '#1E3A5F'],
            'color_names'    => ['Stealth Black', 'Concrete Stone', 'Navy Blue'],
            'short_desc'     => 'Waterproof X-Pac fabric with magnetic Fidlock buckle and padded protection for 11" tablets.',
            'features'       => ['Weatherproof Cordura & X-Pac', 'German Fidlock Quick-Release', 'Concealed RFID Passport Pocket', 'Self-Locking YKK Zippers']
        ],
        [
            'id'             => 'prod-7',
            'title'          => 'Aura Smart Ring Health Tracker',
            'category'       => 'wearables',
            'category_name'  => 'Smart Tech',
            'price'          => 279,
            'regular_price'  => 329,
            'rating'         => 4.7,
            'reviews_count'  => 96,
            'badge'          => 'Trending',
            'badge_type'     => 'hot',
            'is_trending'    => true,
            'is_bestseller'  => false,
            'is_new'         => true,
            'stock'          => 5,
            'image'          => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#0A0A0A', '#E2E8F0', '#CA8A04'],
            'color_names'    => ['Matte Stealth', 'Polished Silver', 'Royal Gold'],
            'short_desc'     => 'Titanium bio-sensing ring tracking sleep architecture, recovery scores, and heart rate variability with zero subscription.',
            'features'       => ['Featherlight 4 Grams Titanium', 'Medical-Grade HRV Sensors', '7 Days On A Single Charge', 'No Subscription Required']
        ],
        [
            'id'             => 'prod-8',
            'title'          => 'Lumbar Lumos Ergonomic Desk Lamp',
            'category'       => 'edc',
            'category_name'  => 'EDC & Workspace',
            'price'          => 129,
            'regular_price'  => 169,
            'rating'         => 4.9,
            'reviews_count'  => 210,
            'badge'          => 'Sale -24%',
            'badge_type'     => 'sale',
            'is_trending'    => false,
            'is_bestseller'  => true,
            'is_new'         => false,
            'stock'          => 6,
            'image'          => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=900&q=80',
            'gallery'        => [
                'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?auto=format&fit=crop&w=900&q=80'
            ],
            'colors'         => ['#1E293B', '#E2E8F0'],
            'color_names'    => ['Space Graphite', 'Silver Metallic'],
            'short_desc'     => 'Asymmetric optical design prevents screen glare, with gesture touch control and CRI > 97 color reproduction.',
            'features'       => ['Zero-Glare Asymmetric Beam', 'Touch & Proximity Dimming', 'CRI 98 Natural Daylight', 'Auto Ambient Brightness Sensor']
        ]
    ];

    return apply_filters('ecommerce_catalog_products', $default_products);
}

/**
 * Filter products by category or tab
 */
function ecommerce_filter_products($tab = 'all') {
    $all = ecommerce_get_catalog_products();
    if ($tab === 'all') return $all;
    if ($tab === 'trending') return array_filter($all, fn($p) => !empty($p['is_trending']));
    if ($tab === 'bestseller') return array_filter($all, fn($p) => !empty($p['is_bestseller']));
    if ($tab === 'new') return array_filter($all, fn($p) => !empty($p['is_new']));
    return array_filter($all, fn($p) => $p['category'] === $tab);
}

/**
 * Retrieve a product by ID or slug
 */
function ecommerce_get_product_by_id($id) {
    $products = ecommerce_get_catalog_products();
    foreach ($products as $p) {
        if ($p['id'] === $id || sanitize_title($p['title']) === $id) {
            return $p;
        }
    }
    // Return first product as fallback if not found
    return $products[0] ?? null;
}

/**
 * Generate product permalink
 */
function ecommerce_get_product_url($product) {
    $id = is_array($product) ? ($product['id'] ?? '') : $product;
    return home_url('/product/' . $id . '/');
}

/**
 * Generate route permalink
 */
function ecommerce_get_page_url($slug) {
    return home_url('/' . trim($slug, '/') . '/');
}

/**
 * Custom Route Rewrite Rules
 */
function ecommerce_custom_rewrite_rules() {
    add_rewrite_rule('^shop/?$', 'index.php?ecommerce_route=shop', 'top');
    add_rewrite_rule('^categories/?$', 'index.php?ecommerce_route=categories', 'top');
    add_rewrite_rule('^deals/?$', 'index.php?ecommerce_route=deals', 'top');
    add_rewrite_rule('^about/?$', 'index.php?ecommerce_route=about', 'top');
    add_rewrite_rule('^reviews/?$', 'index.php?ecommerce_route=reviews', 'top');
    add_rewrite_rule('^contact/?$', 'index.php?ecommerce_route=contact', 'top');
    add_rewrite_rule('^cart/?$', 'index.php?ecommerce_route=cart', 'top');
    add_rewrite_rule('^checkout/?$', 'index.php?ecommerce_route=checkout', 'top');
    add_rewrite_rule('^product/([^/]+)/?$', 'index.php?ecommerce_product=$matches[1]', 'top');
}
add_action('init', 'ecommerce_custom_rewrite_rules');

/**
 * Register Custom Query Vars
 */
function ecommerce_custom_query_vars($vars) {
    $vars[] = 'ecommerce_route';
    $vars[] = 'ecommerce_product';
    return $vars;
}
add_filter('query_vars', 'ecommerce_custom_query_vars');

/**
 * Template Router for Custom Routes
 */
function ecommerce_template_include($template) {
    $route = get_query_var('ecommerce_route');
    $product_id = get_query_var('ecommerce_product');

    // Also support GET query parameters as fallback (?route=shop or ?product=prod-1)
    if (empty($route) && isset($_GET['route'])) {
        $route = sanitize_key($_GET['route']);
    }
    if (empty($product_id) && isset($_GET['product'])) {
        $product_id = sanitize_text_field($_GET['product']);
    }

    if (!empty($product_id)) {
        $single_template = locate_template(['single-product.php']);
        if ($single_template) {
            return $single_template;
        }
    }

    if (!empty($route)) {
        $templates_map = [
            'shop'       => 'page-shop.php',
            'categories' => 'page-categories.php',
            'deals'      => 'page-deals.php',
            'about'      => 'page-about.php',
            'reviews'    => 'page-reviews.php',
            'contact'    => 'page-contact.php',
            'cart'       => 'page-cart.php',
            'checkout'   => 'page-checkout.php',
        ];
        if (isset($templates_map[$route])) {
            $custom_template = locate_template([$templates_map[$route]]);
            if ($custom_template) {
                return $custom_template;
            }
        }
    }

    return $template;
}
add_filter('template_include', 'ecommerce_template_include');

/**
 * Ensure Rewrite Rules are Flushed Once
 */
function ecommerce_check_flush_rewrite_rules() {
    if (!get_option('ecommerce_rewrite_rules_flushed_v3')) {
        ecommerce_custom_rewrite_rules();
        flush_rewrite_rules();
        update_option('ecommerce_rewrite_rules_flushed_v3', 1);
    }
}
add_action('init', 'ecommerce_check_flush_rewrite_rules', 20);

