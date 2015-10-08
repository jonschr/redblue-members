<?php

/**
 * Register the member types taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function member_types() {

	$labels = array(
		'name'					=> _x( 'Member Types', 'Taxonomy member types', 'rbm' ),
		'singular_name'			=> _x( 'Member Type', 'Taxonomy member type', 'rbm' ),
		'search_items'			=> __( 'Search Member Types', 'rbm' ),
		'popular_items'			=> __( 'Popular Member Types', 'rbm' ),
		'all_items'				=> __( 'All Member Types', 'rbm' ),
		'parent_item'			=> __( 'Parent Member Type', 'rbm' ),
		'parent_item_colon'		=> __( 'Parent Member Type', 'rbm' ),
		'edit_item'				=> __( 'Edit Member Type', 'rbm' ),
		'update_item'			=> __( 'Update Member Type', 'rbm' ),
		'add_new_item'			=> __( 'Add New Member Type', 'rbm' ),
		'new_item_name'			=> __( 'New Member Type Name', 'rbm' ),
		'add_or_remove_items'	=> __( 'Add or remove Member Types', 'rbm' ),
		'choose_from_most_used'	=> __( 'Choose from most used Member Types', 'rbm' ),
		'menu_name'				=> __( 'Member Types', 'rbm' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => false,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'member-types', array( 'members' ), $args );
}

add_action( 'init', 'member_types' );
