<?php

/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_store_wp_template
 * @since 1.0.0
 */
include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

// ładowanie plików stylów
function my_theme_styles()
{
    // wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('header-styles', get_template_directory_uri() . '/assets/css/header.css', array(), false, 'all');
    wp_enqueue_style('home-page-styles', get_template_directory_uri() . '/assets/css/home-page.css', array(), false, 'all');
    wp_enqueue_style('product-page-styles', get_template_directory_uri() . '/assets/css/product-page.css', array(), false, 'all');
    // zewnetrzny skrypt
    wp_enqueue_style('additional-styles', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

// ładowanie plików skryptów
function my_theme_scripts()
{
    // zewnętrzne skrypty
    // wp_enqueue_script('jquery-script', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', array('jquery'), '1.14.7', true);
    // wp_enqueue_script('popper-script', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), '1.14.7');
    // wp_enqueue_script('bootstrap-script', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '1.14.7', true);
    // moje skrypty
    wp_enqueue_script('jquery-script', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), true);
    wp_enqueue_script('my-theme-script', get_template_directory_uri() . '/assets/js/header.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), true);
    wp_enqueue_script('footer-script', get_template_directory_uri() . '/assets/js/footer.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

// woocommerce instalaation
include_once get_template_directory() . '/inc/install_woocommerce.php';
include_once get_template_directory() . '/inc/install_basic_store.php';

//woocommerce actions
include_once get_template_directory() . '/woocommerce/actions.php';


add_filter('woocommerce_product_tabs', 'customize_product_tabs', 98);

function customize_product_tabs($tabs)
{
    if (isset($tabs['description'])) {
        $tabs['description']['class'][] = 'active';
    }
    return $tabs;
}


remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_all_actions('woocommerce_after_single_product_summary');
