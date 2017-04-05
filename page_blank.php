<?php
 
/* Template Name: Content Only */
 
// remove widget areas
remove_theme_support( 'genesis-footer-widgets', 3 );
 
// unhook the unwanted pieces
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5);
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15);
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


// Remove Header
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');


// Remove Navigation
remove_action('genesis_before_header', 'news_do_topnav');
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_after_header', 'custom_do_subnav');


// Remove Title
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_theme_support('genesis-post-format-images');
// Remove Info Boxes
remove_action('genesis_after_loop', 'include_info_boxes', 1);
remove_action('genesis_after_loop', 'genesis_do_author_box_single', 9);
// Remove Breadcrumbs
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
// Remove Bottom Sidebars
remove_action('genesis_before_footer', 'news_include_footer_widgets');
// Remove Adsense
remove_action('genesis_before_entry', 'news_include_adsense_top', 9);
remove_action('genesis_after_entry', 'news_include_adsense_bottom', 9);
// Remove Post Info
remove_action('genesis_entry_header', 'genesis_post_info');
// Remove Post Meta
remove_action('genesis_entry_footer', 'genesis_post_meta');
// Remove SubNAV
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_after_header', 'custom_do_subnav');
// Remove Breadcrumbs
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
// Remove Info Boxes
remove_action('genesis_after_loop', 'include_info_boxes', 1);
// Remove Footer
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action('genesis_footer', 'custom_footer_stuff');

// Remove Footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
remove_action('genesis_before_footer','metric_include_footer_widgets');






remove_action( 'wp_head', 'lift_child_scripts' );
remove_action( 'genesis_footer', 'lift_custom_footer' );




//* Add CSS to hide menu
add_action( 'wp_head', 'lift_page_style' );
function lift_page_style() {
?>
	
	<style>	
		
		html {
			padding-top: 0px!important;
		}
		
		body {
			background:#fff;
		}
	
		#wprmenu_bar,
		#wprmenu_menu.top {
			display:none !important;
		}
		
		.entry {
		  margin-bottom: 0;
		  padding: 0px;
		}
		
		.site-inner {
			margin-top:0;
			padding-top: 20px;
		}
		
		h1 {
		  color: #00b2ea;
		  font-size: 26px;
		  margin: 0 0 25px;
		}
		
		td {
		  border-top: 1px solid #ddd;
		  padding: 5px 5px;
		}
				
	</style>

<?php 
} 
		

 
// force full layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
 
// add custom class for targeted styling
add_filter( 'body_class', 'lift_child_theme_body_class' );
 
function lift_child_theme_body_class( $classes ) {
  $classes[] = 'content-only';
  return $classes;
}
 
genesis();