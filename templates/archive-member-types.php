<?php

/**
 * Force the full width layout
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * FAQ loop.
 * We're replacing the Genesis loop with our own.
 */
function rbfaq_archive_loop() {

	$count = 0;

    if ( have_posts() ) {
    	while ( have_posts() ) {
    		the_post(); 

			//* Set up the count
    		$count++;

			//* Figure out what class to apply to the image
			//* If the image 
			if ( $count%2 == 0 ) {
				$imageclass = 'member-image member-image-left';		
			} else {
				$imageclass = 'member-image member-image-right';
			}
    	
    		printf( '<div class="%s">', implode( ' ', get_post_class( 'member-section' ) ) );

    			/**
    			 * Output the image
    			 * We're only going to link the image if there's something to link to
    			 */
    			if ( get_the_content() && $image = genesis_get_image( 'format=url&size=member-image' ) ) {
						printf( '<div class="portfolio-image"><a href="%s" rel="bookmark"><img class="%s" src="%s" alt="%s" /></a></div>', get_permalink(), $imageclass, $image, the_title_attribute( 'echo=0' ) );
    			} elseif ( $image = genesis_get_image( 'format=url&size=member-image' )) {
    					printf( '<div class="portfolio-image"><img class="%s" src="%s" alt="%s" /></div>', $imageclass, $image, the_title_attribute( 'echo=0' ) );
    			}

    			echo '<div class="member-content">';
					
					edit_post_link( 'Edit this member', '<small>', '</small>', '' );

					//* Only link the title if there's some content to link to
    				if ( get_the_content() ) {
    					printf( '<h2 class="entry-title"><a href="%s">%s</a></h2>', get_the_permalink(), get_the_title() );
    				} else {
    					printf( '<h2 class="entry-title">%s</h2>', get_the_title() );
    				}

					//* Add the member's title
					global $post;
	   				$title = get_post_meta( get_the_ID(), '_rbm_members_title', true );
	   				if ( $title )
	   					printf( '<h4 class="member-subtitle">%s</h4>', $title );

					echo '<p>';
						the_excerpt_max_charlength( 250 );
					echo '</p>';

					if ( get_the_content() )
						printf( '<a class="button" href="%s">Read more</a>', get_the_permalink() );			

    				
				echo '</div>'; // .member-content
			echo '</div>'; // the post_class() div
    	
    	} // end while
    } // end if
}

function the_excerpt_max_charlength( $charlength ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}
 
/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rbfaq_archive_loop' );

genesis();