<?php
/*
Plugin Name: Red Blue Members
Description: A plugin for displaying members of something.
Plugin URI: http://redblue.us
Author: Jon Schroeder
Author URI: http://redblue.us
Version: 1.0
License: GPL2
*/

/*
    Copyright (C) 2105 jon@redblue.us

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//* Register the post type
include_once( 'lib/post_type.php' );

//* Register the taxonomy
include_once( 'lib/taxonomy.php' );

//* Perform a few administrative functions
include_once( 'lib/admin.php' );

//* Add a metabox to members
include_once( 'lib/metabox/metabox.php' );

//* Add the image site
add_image_size( 'member-image', 650, 650, true );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'rbm_add_scripts' );
function rbm_add_scripts() {
    
    wp_register_style( 'member-style', plugins_url( '/css/member-style.css', __FILE__) );
    wp_enqueue_style( 'member-style' );

}

/**
 * Use a custom template for archives of members
 * @param  string
 * @return string
 */
function rbm_archive_template( $archive_template ) {
	global $post;

	if ( is_tax ( 'member-types' ) ) {
		$archive_template = dirname( __FILE__ ) . '/templates/archive-member-types.php';
    }
	return $archive_template;
}
add_filter( 'archive_template', 'rbm_archive_template', 1000 );

/**
 * Use a custom template for archives of members
 * @param  string
 * @return string
 */
function rbm_single_template( $single_template ) {
    global $post;

    if ( is_singular ( 'members' ) ) {
        $single_template = dirname( __FILE__ ) . '/templates/single-member.php';
    }
    return $single_template;
}
add_filter( 'single_template', 'rbm_single_template', 1000 );

/**
 * [rbm_pagesize description]
 * @param  [type] $query [description]
 * @return [type]        [description]
 */
function rbm_pagesize( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'members' ) || is_tax ( 'member-types' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'rbm_pagesize', 1 );