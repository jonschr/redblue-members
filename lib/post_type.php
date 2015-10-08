<?php 

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function rbm_register_members_cpt() {

	$labels = array(
		'name'                => __( 'Members', 'rbm' ),
		'singular_name'       => __( 'Member', 'rbm' ),
		'add_new'             => _x( 'Add New Member', 'rbm', 'rbm' ),
		'add_new_item'        => __( 'Add New Member', 'rbm' ),
		'edit_item'           => __( 'Edit Member', 'rbm' ),
		'new_item'            => __( 'New Member', 'rbm' ),
		'view_item'           => __( 'View Member', 'rbm' ),
		'search_items'        => __( 'Search Members', 'rbm' ),
		'not_found'           => __( 'No Members found', 'rbm' ),
		'not_found_in_trash'  => __( 'No Members found in Trash', 'rbm' ),
		'parent_item_colon'   => __( 'Parent Member:', 'rbm' ),
		'menu_name'           => __( 'Members', 'rbm' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-id',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 
			'editor',
			'thumbnail',
			'excerpt',
			'genesis-cpt-archives-settings'
			)
	);

	register_post_type( 'members', $args );
}

add_action( 'init', 'rbm_register_members_cpt' );