<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'ClearSky 2016' );
define( 'CHILD_THEME_URL', 'http://clearskyportrait.com/' );
define( 'CHILD_THEME_VERSION', '3.0' );



//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Remove the admin bar
add_filter('show_admin_bar', '__return_false');


//* Custom image sizes
add_image_size('page-square', 500, 500, TRUE);
add_image_size('full-page', 1920, 1400, FALSE);


//* Content width for Jetpack Galleries
if ( ! isset( $content_width ) )
    $content_width = 1140;
    
    
//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'lift_add_scripts');
function lift_add_scripts() {

	//jQuery:
	wp_enqueue_script( 'jquery' );

	//Google Web Fonts:
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700|PT+Sans:400,700|Crimson+Text:400,600,700|Old+Standard+TT:400,700', array(), CHILD_THEME_VERSION );
	
	//Font Awesome:
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );
		
	//jQuery Cycle2:
	wp_enqueue_script( 'jquery-cycle2', CHILD_URL . '/scripts/jquery.cycle2.min.js', array(), '2.1.6' );
	
	//Parrallax scripts:
	wp_enqueue_script( 'jquery-parallax', CHILD_URL . '/scripts/jquery.parallax-1.1.3.js', array(), PARENT_THEME_VERSION );
	wp_enqueue_script( 'jquery-localscroll', CHILD_URL . '/scripts/jquery.localscroll-1.2.7-min.js', array(), PARENT_THEME_VERSION );
	wp_enqueue_script( 'jquery-scrollto', CHILD_URL . '/scripts/jquery.scrollTo-1.4.2-min.js', array(), PARENT_THEME_VERSION );
	
	
}


//* Enqueue post-plugin Scripts
add_action( 'wp_enqueue_scripts', 'post_plugin_scripts',100);
function post_plugin_scripts() {
	
	//unhook photonic calling this script since we are using cycle version 2
	wp_dequeue_script('jquery-cycle'); 
	
}


//* Add jQuery scripts to <head>
add_action( 'wp_head', 'lift_child_scripts' );
function lift_child_scripts() {
	?>
	<script type="text/javascript">	
	
		$ = jQuery;
	
		$(function($){
		    $('.site-header').data('size','big');
		});
		
		
		
		$(window).scroll(function($){			
			icstickynav();
		});
		
		
		$(window).resize(function($) {
		  //icstickynav();
		  if ($(window).width() < 1139) {
			    $('.site-header').data('size','big');
		        
					
	        	$( ".lift-sticky-header" ).animate({
				    opacity: 0
				  }, 200, function() {
				    $( ".site-header" ).removeClass( "lift-sticky-header" );
				  });
				 
				$( ".site-header" ).animate({
					opacity:1
				}, 400, function() {
					
				});
		    }
		});	
			
			
		function icstickynav () {
			
			$ = jQuery;
			
		    if($(document).scrollTop() > 100)
		    {
			    $ = jQuery;
		        if($('.site-header').data('size') == 'big' && $(window).width() > 1139)
		        {
		        
		        	$('.site-header').data('size','small');
		        	
		        	$( ".site-header" ).addClass( "lift-sticky-header" );
		        	
		        	$( ".lift-sticky-header" ).animate({
					    opacity: 0
					  }, 0, function() {
					    // Animation complete.
					  });
		        	
		        	$( ".lift-sticky-header" ).animate({
					    opacity: 1
					  }, 200, function() {
					    // Animation complete.
					  });
					  
		        }
		    }
		    else
		    {
		        if( jQuery('.site-header').data('size') == 'small' && $(window).width() > 1139)
		        {
		        
		        	$('.site-header').data('size','big');
		        
					
		        	$( ".lift-sticky-header" ).animate({
					    opacity: 0
					  }, 200, function() {
					    $( ".site-header" ).removeClass( "lift-sticky-header" );
					  });
					 
					$( ".site-header" ).animate({
						opacity:1
					}, 400, function() {
						
					});
		        	
		        }  
		    }
		    
		    
		    
		}

	
	</script>
	
  <?php
}



//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );


//* Full-width layout:
function lift_fullwidth_layout($opt) {
    $opt = 'full-width-content';
    return $opt;
}

//* Content-sidebar layout:
function lift_content_sidebar_layout($opt) {
    $opt = 'content-sidebar';
    return $opt;
}

//* Sidebar-content layout:
function lift_sidebar_content_layout($opt) {
    $opt = 'sidebar-content';
    return $opt;
}



//* Unregister un-used Genesis site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );




//* Custom footer text:
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'lift_custom_footer' );

function lift_custom_footer() {
	
	echo '&copy; ' . date('Y') . ' Clear Sky Portrait. All rights reserved. Site built by <a href="http://liftdevelopment.com" rel="nofollow" target="_blank">Lift Development</a>';
	
}




//* Set up read-only option for Gravity Forms
add_filter('gform_pre_render', 'lift_add_readonly_script');
function lift_add_readonly_script($form){
    ?>
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
            // apply only to a textarea with a class of gf_readonly 
            jQuery("li.gf_readonly textarea").attr("readonly","readonly");
        });
    </script>
    
    <?php
    return $form;
}




//* Add custom header for pages as needed *//
function lift_page_header() {

	global $post;
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-header' );
	
	if ( has_post_thumbnail( $post->ID ) ) {
	
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_before_content', 'genesis_do_post_title' );
		
		?>
			
			<div class="lift-page-header" style="background-image: url(<?php echo $image[0]; ?>);">
				<div class="wrap">
					<h1 class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
				</div>
			</div>
		

		<?php
			
	} else {
		
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_before_content', 'genesis_do_post_title' );
		
		?>
			
			<div class="lift-page-header lift-page-header-short">
				<div class="wrap">
					<h1 class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
				</div>
			</div>
		

		<?php
		
	}

}
