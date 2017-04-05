<?php //* Template Name: Blog *//

//* Add custom header for blog page *//
add_action('genesis_after_header', 'lift_blog_header');

remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
remove_action( 'genesis_before_content', 'genesis_do_post_title' );


function lift_blog_header() {

	global $post;
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-header' );
	
	if ( has_post_thumbnail( $post->ID ) ) {
	
		?>
			
			<div class="lift-page-header" style="background-image: url(<?php echo $image[0]; ?>);">
				<div class="wrap">
					<h1 class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
				</div>
			</div>
		

		<?php
			
	} else {
		
		?>
			
			<div class="lift-page-header lift-page-header-short">
				<div class="wrap">
					<h1 class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
				</div>
			</div>
		

		<?php
		
	}

}





//* Show page content above posts
add_action( 'genesis_loop', 'genesis_standard_loop', 5 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'lift_post_info_filter' );
function lift_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );



genesis();