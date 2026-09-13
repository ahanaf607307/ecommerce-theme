<?php
/**
 * The Landing Page Template for Ecommerce Theme
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <?php
    // 1. Hero Showcase
    get_template_part('template-parts/section-hero');

    // 2. Curated Categories
    get_template_part('template-parts/section-categories');

    // 3. Filterable Product Grid
    get_template_part('template-parts/section-products');

    // 4. Flagship Spotlight & Specs
    get_template_part('template-parts/section-spotlight');

    // 5. Limited Flash Sale & Bundles
    get_template_part('template-parts/section-flash-deals');

    // 6. Verified Reviews & FAQ
    get_template_part('template-parts/section-reviews');
    ?>
</main>

<?php
get_footer();
