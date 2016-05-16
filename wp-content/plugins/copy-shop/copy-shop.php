<?php
/*
Plugin Name: Copy Shop
Plugin URI: none
Description: Copy Shop designed on Wordpess WooComerce without admin access
Version: 1.0.0
Author: Vitalii Prodan
Author URI: https://plus.google.com/u/0/113458128161616702309/posts
*/
ini_set('max_execution_time', 36000);
// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

function mt_add_pages() {
    // Add a new submenu under Options:
    add_management_page('Copy Shop', 'Copy Shop', 8, 'copy-shop', 'mt_options_page');
}

// mt_options_page() displays the page content for the Test Options submenu
function mt_options_page() {
    wp_enqueue_style( 'ups_calc' );
    wp_enqueue_script('ups_calc');
    require_once('settings.php');
}

function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=copy-shop">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );