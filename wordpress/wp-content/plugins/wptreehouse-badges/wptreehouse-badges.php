<?php

/*
* Plugin Name: Official Treehouse Badges Plugin
* Plugin URI:
* Description: Provides both widgets and shortcodes to help you display your badges
* Version: 1.0
* Author:
* Author URI:
* License: GPL2
*/

$plugin_url = WP_PLUGIN_URL . '/wptreehouse-badges';
$options = array();

function wptreehouse_badges_menu() {

    add_options_page(
        'Official Treehouse Badges Plugin',
        'Treehouse Badges',
        'manage_options',
        'wptreehouse-badges',
        'wptreehouse_badges_options_page'
    );

}
add_action( 'admin_menu', 'wptreehouse_badges_menu' );

function wptreehouse_badges_options_page() {

    if ( ! current_user_can( 'manage_options' ) ) {

        wp_die( 'You do not have sufficient permissions to access this page.' );

    }

    global $plugin_url;
    global $options;

    if( isset( $_POST['wptreehouse_form_submitted'] ) ) {

        $hidden_field = esc_html( $_POST['wptreehouse_form_submitted'] );

        if( $hidden_field == 'Y') {

            $wptreehouse_username = esc_html( $_POST['wptreehouse_username'] );

            $options['wptreehouse_username']    = $wptreehouse_username;
            $options['last_updated']            = time();

            update_option( 'wptreehouse_badges', $options );

        }
    }

    $options = get_option( 'wptreehouse_badges' );

    if( $options != '' ) {
        $wptreehouse_username = $options['wptreehouse_username'];
    }

    require( 'inc/options-page-wrapper.php' );

}

function wptreehouse_badges_styles() {

    wp_enqueue_style( 'wptreehouse_badges_styles', plugins_url( 'wptreehouse-badges/wptreehouse-badges.css' ) );
}
add_action( 'admin_head', 'wptreehouse_badges_styles' );

?>