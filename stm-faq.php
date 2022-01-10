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
    add_submenu_page('stm-faq', 'Editor', 'Editor', 'edit_posts', 'stm-faq-editor', 'stm_faq_menu');
}
add_action('admin_menu', 'stm_faq_admin_menu');


// Add Menu
function stm_faq_menu() {

    $currentPage = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : 'stm-faq';

    // var_dump($currentPage);

    switch ($currentPage) {
        case 'stm-faq': 
            $view = STM_FAQ_VIEWS_DIR . '/list.view.php';
            break;

        case 'stm-faq-editor': 
            $view = STM_FAQ_VIEWS_DIR . '/editor.view.php';
            break;
    }

    ?>

    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>
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
add_shortcode( 'STM-FAQ', 'stm_faq_shortcode' );