<?php
/*
 * Plugin Name: Filter Featured for WooCommerce
 * Plugin URI: https://github.com/Backpackstudio/bps-woo-filter-featured
 * Description: Improves WooCommerce back-end by adding capability to filter products based on their featured status.
 * Version: 1.0.1
 * Author: Backpack.Studio
 * Author URI: https://backpack.studio
 * Requires at least: 5.4
 * Requires PHP: 7.4
 * Text Domain: bpsfilterfeatured
 * Domain Path: /i18n/languages
 */

// Prevent direct acces, use only exclusively as an include.
if (count(get_included_files()) == 1) {
    http_response_code(403);
    die();
}

/**
 * Hooks plugin functionality
 */
function init_bps_woo_filter_featured()
{
    // Checkk that Woocommerce is available
    if (class_exists('woocommerce')) {
        // Include vendor scripts loader
        require_once 'vendor/vendor-autoload.php';
        // Hook plugin functionality
        add_action('restrict_manage_posts', '\BackpackStudio\WooFilter\FilterFeatured::addFilter');
        add_filter('parse_query', '\BackpackStudio\WooFilter\FilterFeatured::filterProducts');
    } else {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-warning is-dismissible"><p>WooCommerce is required for usage of Filter Featured Products.</p></div>';
        });
    }
}

// Hook plugin
add_action('init', 'init_bps_woo_filter_featured', PHP_INT_MAX);