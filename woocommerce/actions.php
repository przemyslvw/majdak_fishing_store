<?php

// Usuń domyślne elementy

// remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// remove_all_actions('woocommerce_before_main_content');


// remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 100);
remove_all_actions('woocommerce_after_single_product_summary');



remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action('woocommerce_single_product_summary', 'my_custom_add_to_cart', 90);

function my_custom_add_to_cart()
{

    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 25);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    // add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
