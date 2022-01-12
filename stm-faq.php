<?php

/**
 * Plugin Name: FAQ
 * Description: FAQs welche unter /faq auf der steuermachen.de zu finden sind
 * Author: Tobias Röder
 * Author URI: https://tobias-roeder.de/
 * Text Domain: stm-faq
 */


// define fixed paths/directories
define('STM_FAQ_VIEWS_DIR', __DIR__ . '/views');

include_once __DIR__ . '/functions.php';


// Add Admin Menu
function stm_faq_admin_menu() {
    add_menu_page('FAQ', 'FAQ', 'edit_posts', 'stm-faq', 'stm_faq_menu', 'dashicons-feedback');
    // add_submenu_page('stm-faq', 'Editor', 'Editor', 'edit_posts', 'stm-faq-editor', 'stm_faq_menu');
}
add_action('admin_menu', 'stm_faq_admin_menu');


// Add Menu
function stm_faq_menu() {

    $requestURI = $_SERVER['REQUEST_URI'];
    $pluginDirUrl = plugin_dir_url(__FILE__);
    $currentPage = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : 'stm-faq';
    $getView = $_GET['view'] ?? false;

    // var_dump($currentPage);

    switch ($getView) {
        case 'editor': 
            $view = STM_FAQ_VIEWS_DIR . '/editor.view.php';
            break;

        default:
            $view = STM_FAQ_VIEWS_DIR . '/list.view.php';
            break;
    }

    wp_enqueue_style( 'stm-faq-style', $pluginDirUrl . '/css/style.min.css' );
    wp_enqueue_script( 'stm-faq-script-stm', $pluginDirUrl . '/js/stm.js' );
    wp_enqueue_script( 'stm-faq-script', $pluginDirUrl . '/js/script.js' );

    ?>

    <div class="wrap">
        <?php include_once $view; ?>
    </div>

    <?php
}


// Add Shortcode
function stm_faq_shortcode( $atts ) {

    // Attributes
    $atts = shortcode_atts(
        array(
        ),
        $atts
    );

    return 'Hey (STM FAQ)';
}
add_shortcode( 'STM_FAQ', 'stm_faq_shortcode' );