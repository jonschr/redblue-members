<?php 

// Remove post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

function rbm_add_title() {
	global $post;
	$title = get_post_meta( get_the_ID(), '_rbm_members_title', true );
	if ( $title )
		printf( '<h4 class="member-subtitle">%s</h4>', $title );
}
add_action( 'genesis_entry_header', 'rbm_add_title', 25 );

/**
 * Output the image
 * We're only going to link the image if there's something to link to
 */
function rmb_add_image() {
	$imageclass = 'alignright member-single-image';
	if ( $image = genesis_get_image( 'format=url&size=member-image' ) ) {
		printf( '<div class="portfolio-image"><img class="%s" src="%s" alt="%s" /></div>', $imageclass, $image, the_title_attribute( 'echo=0' ) );
	}
}
add_action( 'genesis_entry_header', 'rmb_add_image', 0 );

genesis();