<?php
/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_store_wp_template
 * @since 1.0.0
 */

// ładowanie plików stylów
function my_theme_styles() {
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('additional-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('header-styles', get_template_directory_uri() . '/assets/css/header.css', array(), false, 'all');
}
add_action('wp_enqueue_scripts', 'my_theme_styles');

// ładowanie plików skryptów
function my_theme_scripts() {
    wp_enqueue_script('jquery-script', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), true);
    wp_enqueue_script('my-theme-script', get_template_directory_uri() . '/assets/js/header.js', array('jquery'));
    wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), true);
    wp_enqueue_script('footer-script', get_template_directory_uri() . '/assets/js/footer.js', array('jquery'), true);
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');
