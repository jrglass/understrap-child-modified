<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

//
// STS Enqueue Styles and Scripts
//
require get_stylesheet_directory() . '/inc/enqueue.php';

//
// STS Theme Settings
//
require get_stylesheet_directory() . '/inc/setup.php';

//
// STS Navigation Setup
//
require get_stylesheet_directory() . '/inc/nav.php';

//
// STS Mobile Detect Script
//
require_once get_stylesheet_directory() . '/inc/Mobile_Detect.php';
global $detect;
$detect = new Mobile_Detect;