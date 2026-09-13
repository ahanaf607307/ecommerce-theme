<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @package Ecommerce
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Seamlessly render the theme's premium shop storefront template
require get_template_directory() . '/page-shop.php';
