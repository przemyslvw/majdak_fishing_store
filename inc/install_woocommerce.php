<?php

// woocommerce init
// function install_woocommerce() {

//     // Include necessary files
//     include_once ABSPATH . 'wp-admin/includes/file.php';
//     include_once ABSPATH . 'wp-admin/includes/misc.php';
//     include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
//     include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
//     include_once ABSPATH . 'wp-admin/includes/plugin.php';

//     // Define the path to the plugin file
//     $pluginFilePath = get_template_directory() . '/assets/plugin/woocommerce.latest-stable.zip';

//     // Check if the plugin is already installed
//     if (!is_plugin_active('woocommerce/woocommerce.php')) {
//         // Check if the plugin folder already exists
//         if (!file_exists(WP_PLUGIN_DIR . '/woocommerce')) {
//             // Create a new instance of Plugin_Upgrader
//             $upgrader = new Plugin_Upgrader();

//             // Install the plugin
//             $installed = $upgrader->install($pluginFilePath);


//             if ($installed) {
//                 // If the plugin was installed successfully, schedule its activation
//                 wp_schedule_single_event(time(), 'activate_woocommerce_plugin');
//             }

//             // Then define the scheduled event somewhere else in your code
//             // add_action('activate_woocommerce_plugin', function() {
//             //     activate_plugin('woocommerce/woocommerce.php');
//             // });

//         }
//     }
// }

// add_action('after_switch_theme', 'install_woocommerce');

function install_woocommerce()
{
    // Include necessary files
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/misc.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    // Define the path to the plugin file
    $pluginFilePath = get_template_directory() . '/assets/plugin/woocommerce.latest-stable.zip';

    // Check if the plugin is already installed
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        // Check if the plugin folder already exists
        if (!file_exists(WP_PLUGIN_DIR . '/woocommerce')) {
            // Create a new instance of Plugin_Upgrader
            $upgrader = new Plugin_Upgrader();

            // Install the plugin
            $upgrader->install($pluginFilePath);

            // Activate the plugin
            activate_plugin('woocommerce/woocommerce.php');
        }
    }
}

add_action('wp_loaded', 'install_woocommerce');

function activate_woocommerce()
{
    // Include necessary files
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    // Check if the plugin is installed
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        // Activate the plugin
        activate_plugin('woocommerce/woocommerce.php');
    }
}
add_action('activate_woocommerce_plugin', 'activate_woocommerce');

function uninstall_woocommerce()
{
    // Include necessary files
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    // Check if the plugin is installed
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        // Deactivate the plugin
        deactivate_plugins('woocommerce/woocommerce.php');

        // Enable WooCommerce data removal
        update_option('woocommerce_uninstall_data', 'yes');

        // Delete the plugin
        delete_plugins(['woocommerce/woocommerce.php']);
    } else {
        // Enable WooCommerce data removal
        update_option('woocommerce_uninstall_data', 'yes');
        delete_plugins(['woocommerce/woocommerce.php']);
    }
}

add_action('switch_theme', 'uninstall_woocommerce');
