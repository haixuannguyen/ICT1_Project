<?php


get_header();


	$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');
	
	//check if sidebar is required
		//thumb
			//get post id, get post format, get n show thumb
			if(get_post_format(get_the_ID()) == 'image' and has_post_thumbnail(get_the_ID())){
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
				print '<div class="tp-single-image" style="background-image:url(\''.$src[0].'\')"></div>';
			}
			
		
		
		
		if(is_active_sidebar('sidebar-widget-area')){			
			//has sidebar	
				print '
				<section id="page-content">
				';
				
				//sidebar on left
				if($princess_default_sidebar_position == 'left'){
					print '<div class="sidebar left widget-area">';
					get_sidebar();
					print '</div>';
				}
				
				print '
					<div class="content with-sidebar">						
					';

					if (have_posts()) :
						while ( have_posts() ) : the_post();
						
						get_template_part('content-single');
							
						endwhile;
					endif;

				print '
					</div>
				';
				
				//sidebar on right
				if($princess_default_sidebar_position != 'left'){
					print '<div class="sidebar widget-area">';
					get_sidebar();
					print '</div>';
				}
				
				print '
				</section>';
			
		}else{				
			//no sidebar
				print '
				<section id="page-content">';
								
				
				print '
					<div class="content">
					';

					if (have_posts()) :
						while ( have_posts() ) : the_post();
						
						get_template_part('content-single');
						
						endwhile;
					endif;

				print '
					</div>
				</section>';
		}
	

get_footer();

?>