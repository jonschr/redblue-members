<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Red Blue members
 * @package  rbm_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

add_action( 'cmb2_init', 'rbm_register_members_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function rbm_register_members_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_rbm_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$rbm = new_cmb2_box( array(
		'id'            => $prefix . 'members_metabox',
		'title'         => __( 'Member details', 'cmb2' ),
		'object_types'  => array( 'members', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'cmb_styles' => true, // false to disable the CMB stylesheet
		'closed'     => false, // true to keep the metabox closed by default
	) );

	$rbm->add_field( array(
		'name' => __( 'Title & Company', 'cmb2' ),
		'desc' => __( "<p>The text you would like to appear below the member's name, e.g. <b>CEO of Apple, Inc.</b></p>", 'cmb2' ),
		'id'   => $prefix . 'members_title',
		'type' => 'text_medium',
		'repeatable' => false,
		// 'after_field'  => "<p>The text you would like to appear below the testimonial author's name, e.g. <b>CEO of Apple, Inc.</b></p>",
	) );

	// $rbm->add_field( array(
	// 	'name' => __( 'Website URL', 'cmb2' ),
	// 	'desc' => __( 'The full website address for the testimonial author, e.g. <b>http://apple.com</b>', 'cmb2' ),
	// 	'id'   => $prefix . 'members_url',
	// 	'type' => 'text_url',
	// 	'protocols' => array( 'http', 'https', ), // Array of allowed protocols
	// 	'repeatable' => false,
	// 	// 'after_field'  => '<p>The full website address for the testimonial author, e.g. <b>http://apple.com</b></p>',
	// ) );
}