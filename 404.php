<?php


//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');


//* Remove default loop *//
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );

function genesis_404() { ?>

	<article class="post-90 page type-page status-publish entry">
	
		<header class="entry-header">
	
			<h1 class="entry-title" itemprop="headline"><?php _e( 'Not Found, Error 404', 'genesis' ); ?></h1> 

		</header>
		
		<div class="entry-content" itemprop="text">

			<p><?php printf( __( 'Oops! We could not find the page you were looking for.', 'genesis' ), home_url() ); ?></p>
			
		</div>
		
	</article>
		
		


<?php
}

genesis();