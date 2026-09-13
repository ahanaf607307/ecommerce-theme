<?php
/**
 * Main Template File (Fallback)
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
    if (is_front_page() || is_home()) {
        get_template_part('template-parts/section-hero');
        get_template_part('template-parts/section-categories');
        get_template_part('template-parts/section-products');
        get_template_part('template-parts/section-spotlight');
        get_template_part('template-parts/section-flash-deals');
        get_template_part('template-parts/section-reviews');
    } else {
        echo '<div class="container site-content-area">';
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title('<h1 class="entry-title">', '</h1>');
                echo '<div class="entry-content">';
                the_content();
                echo '</div>';
            }
        } else {
            echo '<p>' . esc_html__('No content found.', 'ecommerce') . '</p>';
        }
        echo '</div>';
    }
    ?>
</main>

<?php
get_footer();
