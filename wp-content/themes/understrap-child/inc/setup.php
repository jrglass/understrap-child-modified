<?php

/**
* Child Theme Setup
*/

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

function understrap_child_setup() {

    add_image_size( 'main-thumbnail', 1000, 640, true ); // 1000px wide x 640px tall cropped

    // Register other image sizes for media uploader
    //add_filter( 'image_size_names_choose', 'my_image_sizes' );
    //function my_image_sizes( $sizes ) {
    //    $addsizes = array(
    //        'small' => __( 'Small' ),
    //    );
    //    $newsizes = array_merge( $sizes, $addsizes );
    //    return $newsizes;
    //}

    //Set up the WordPress Theme logo feature.
    add_theme_support( 'custom-logo' );

    add_theme_support( 'post-thumbnails' );

    add_post_type_support( 'page', 'excerpt' );

    add_theme_support( 'responsive-embeds' );

}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

add_action( 'after_setup_theme', 'understrap_child_setup', 11 );
// End Understrap Child Setup


/**
* Responsive oEmbed videos
*/

add_filter( 'embed_oembed_html', 'wpse_embed_oembed_html', 10, 4 );
function wpse_embed_oembed_html( $cache, $url, $attr, $post_ID ) {
    $classes = array();

    // Add these classes to all embeds.
    //$classes_all = array(
    //    'video-container',
    //);

    // Check for different providers and add appropriate classes.

    if ( false !== strpos( $url, 'vimeo.com' ) ) {
        $classes[] = 'video-container';
    }

    if ( false !== strpos( $url, 'youtu.be' ) ) {
        $classes[] = 'video-container';
    }

    if ( false !== strpos( $url, 'youtube.com' ) ) {
        $classes[] = 'video-container';
    }

    if ( false !== strpos( $url, 'instagram.com' ) ) {
        $classes[] = 'instagram-container';
    }

    $classes = array_merge( $classes );

    return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
}

/**
* Setup posts categories so they can be paged
*/

function custom_pre_get_posts( $query ) {
if( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {
    $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) );  }  }

add_action('pre_get_posts','custom_pre_get_posts', 0);

function custom_request($query_string ) {
     if( isset( $query_string['page'] ) && ($query_string['name'] === 'page')) {
         if( ''!=$query_string['page'] ) {
             if( isset( $query_string['name'] ) ) {
							 unset( $query_string['name'] );
						 }
					 }
				 }

	return $query_string;
}

add_filter('request', 'custom_request', 10);


/**
* Remove "Read More" link on the_excerpt script
*/

function understrap_all_excerpts_get_more_link( $post_excerpt ) {

	return $post_excerpt . '';
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

/**
* Custom Options Page
*/
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

function add_categories_to_pages() {
register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );