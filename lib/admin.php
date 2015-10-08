<?php

/**
 * Get rid of WordPress SEO metabox
 * Adapted from http://wordpress.stackexchange.com/a/91184/2015
 * @return string
 */
function rbm_remove_wp_seo_meta_box() {
    remove_meta_box( 'wpseo_meta', 'members', 'normal' ); // change members into the name of your custom post type
}
add_action( 'add_meta_boxes', 'rbm_remove_wp_seo_meta_box', 100000 );

/**
 * Customize the admin screen title
 * @param  string $title
 * @return string
 */
function rbm_custom_title_admin( $title ){
	$screen = get_current_screen();
 
	if  ( 'members' == $screen->post_type ) {
		$title = "Enter the member's name";
		return $title;
	}
}
add_filter( 'enter_title_here', 'rbm_custom_title_admin' );