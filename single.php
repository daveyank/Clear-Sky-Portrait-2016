<?php 


//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'lift_post_info_filter' );
function lift_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}


//* Add custom header for page
add_action('genesis_after_header', 'lift_blog_header');
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


/** Add custom header for pages as needed **/
function lift_blog_header() {

	global $post;
	
	?>
		
		<div class="lift-page-header lift-page-header-short">
			<div class="wrap">
				<h1 class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
			</div>
		</div>
	

	<?php		

}


genesis();