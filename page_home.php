<?php //* Template Name: Home *//


//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');

//* Remove standard loop from the page *//
remove_action('genesis_loop', 'genesis_do_loop');


//* Add  custom jQuery scripts to end of document:
add_action( 'genesis_after', 'lift_home_scripts' );
function lift_home_scripts() {
	?>
	<script type="text/javascript">			

		
		
		$=jQuery;
		
		$(document).ready(function() {
		  getWidthAndHeight();
		});
		
		// adjust on resize
		$(window).resize(function() {
		  getWidthAndHeight();
		});
		
		function getWidthAndHeight(){
		  $=jQuery;
		  var winWidth = $(window).width();
		  var winHeight = $(window).height();
		  
		  if ( winWidth > 767 ) {
			  $('.full-window').css({
			    'width': winWidth,
			    'height': winHeight,
			  });
		  } else {
			  $('.full-window').css({
			    'width': winWidth,
			    'height': 400,
			  });
		  }
		}
		
	
		 
	</script>

<?php }



//* Add custom content for the home page *//
add_action('genesis_before_content_sidebar_wrap', 'lift_do_home');

function lift_do_home() { 
	
	
	while(has_sub_field("content_areas")):
 	
 	
	 	if(get_row_layout() == "full_page_slider") { ?>
	 	
	 	
	 		<?php
			// check if the repeater field has rows of data
			if( have_rows('slide_info') ) { ?>
			
				<div id="lift-home-slider" class="full-window cycle-slideshow" 
				data-cycle-fx="fade"
						data-cycle-reverse="false"
						data-cycle-pause-on-hover="false"
						data-cycle-timeout="4000"
						data-cycle-speed="2000"
						data-cycle-auto-height="calc"
						data-cycle-slides="> .lift-slide"
				>
			
			
			<?php 

			 	// loop through the rows of data
			    while ( have_rows('slide_info') ) : the_row();
								        			
					$src='';
					
					if (get_sub_field("slide_image")) {
						$src = wp_get_attachment_image_src( get_sub_field("slide_image"), 'full-page', true ); 
					}
						
					?>
						
					<div class="lift-slide" data-stellar-background-ratio="0.5"  style="background-image:url(<?php echo $src[0];?>);"></div>
									
				<?php
			    endwhile;
			    ?>
				</div>
			<?php
			}					
			?>			
		
		<?php } 
		
		elseif (get_row_layout() == "headline_row") { ?>
			
			<div class="lift-home-banner">
		        <div class="wrap">
		        
		        	<h2 class="lift-home-headline">
						<?php echo get_sub_field("section_content"); ?>
					</h2>
		            
		        </div>
		    </div>
		    
		<?	
		}
		
		elseif (get_row_layout() == "image_right_content_left") { 
			
		?> 
    
		    <div class="lift-section" style="padding:50px 0 50px;">
		    	<div class="wrap">
		    	
		    		<?php the_sub_field("content"); ?>
					
		    	</div>
		    </div>
		    
		<?	
		}
		
		elseif (get_row_layout() == "image_left_content_right") { 
			$src='';
			$img='';
					
			if (get_sub_field("featured_image")) {
				$src = wp_get_attachment_image_src( get_sub_field("featured_image"), 'full', true ); 
				$img = $src[0];
			}
		?> 
    
		    <div class="lift-section" style="padding:100px 0 50px;">
		    	<div class="wrap">
		    	
		    		<img class="lift-home-image-left" src="<?php echo $img; ?>" />
		    		
		    		<?php the_sub_field("content"); ?>
					
					
		    	</div>
		    </div>
		    
		<?	
		}
				
		
		elseif(get_row_layout() == "quote_slider") { 
			$src='';
			$img='';
					
			if (get_sub_field("quote_area_background")) {
				$src = wp_get_attachment_image_src( get_sub_field("quote_area_background"), 'full-page', true ); 
				$img = $src[0];
			}
		?>
	 	
	 		<div class="lift-section lift-quote" style="background-image:url(<?php echo $img;?>);">
		 		<div class="lift-quote-overlay"></div>
	 			<div class="wrap">
	 			
	 			
	 		<?php
			// check if the repeater field has rows of data
			if( have_rows('quotes') ) { ?>
			
				<div id="lift-quote-group" class="cycle-slideshow" style="height:100%;"
				data-cycle-fx="fade"
				data-cycle-reverse="false"
				data-cycle-pause-on-hover="false"
				data-cycle-timeout="10000"
				data-cycle-speed="500"
				data-cycle-slides="> .lift-quote-text"
				data-cycle-random="true"
				>
			
			
			<?php 

			 	// loop through the rows of data
			    while ( have_rows('quotes') ) : the_row();
						
					?>
						
					<div class="lift-quote-text">
		    			<?php the_sub_field("slide_quote"); ?>
		    		</div>
									
				<?php
			    endwhile;
			    ?>
					
				</div>
    	
		    	
			<?php
			}					
			?>	
			
				</div>
				
		    	
		    </div>		
		
		<?php } 
			
		
		elseif (get_row_layout() == "latest_news") { 
			$src='';
			$img='';
					
			if (get_sub_field("featured_image")) {
				$src = wp_get_attachment_image_src( get_sub_field("featured_image"), 'full', true ); 
				$img = $src[0];
			}
			
			$args = array(
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'numberposts' => '5',
			    'orderby' => 'post_date',
			    'order' => 'DESC',
			    );
			    
			global $post;
			
			$posts = get_posts($args);    
		?> 
		    
		    
		    <div class="lift-section lift-latest-news">
		    	<div class="wrap">
			    	
		    		<div class="lift-latest-interior">
			    		<h2><?php echo get_sub_field("section_title"); ?></h2>
			
						<ul>
						
						<?php
							foreach($posts as $post) {								
								setup_postdata($post); 
								
						?>
							<li>
							
								<div class="lift-news-thumbnail">
									<?php if ( has_post_thumbnail($post->ID) ) : ?>
									    <a href="<?php the_permalink($post->ID); ?>">
									        <?php the_post_thumbnail('thumbnail'); ?>
									    </a>
									<?php endif; ?>
								</div>
								
								<div class="lift-news-content">
									<h4><a href="<?php echo get_the_permalink($post->ID);?>"><?php echo get_the_title($post); ?></a></h4>
									<div class="lift-news-date"><?php echo get_the_date('F Y', $post); ?></div>
								</div>
								
								<div class="clearfix"></div>
								
							</li>
						
						<?php 
							wp_reset_postdata();
							}
						?>	
							
						</ul>
						
						<div style="text-align:center;margin:80px auto 0;">
							<a class="lift-button" href="<?php echo get_sub_field("button_url"); ?>">Read More</a>
						</div>
						
		    		</div>
		    	</div>
		     </div>
		    
		<?	
		}

	endwhile;
	
}

genesis();