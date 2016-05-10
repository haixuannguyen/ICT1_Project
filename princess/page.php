<?php


get_header();


	$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');
	
	//check if sidebar is required		
		if(is_active_sidebar('sidebar-widget-area-pages')){		
			//has sidebar	
				print '
				<section id="page-content">
				';
								
				
				//sidebar on left
				if($princess_default_sidebar_position == 'left'){
					print '<div class="sidebar left widget-area">';
					get_sidebar('pages');
					print '</div>';
				}
				
				print '
					<div class="content with-sidebar">						
					';

					if (have_posts()) :
						while ( have_posts() ) : the_post();
						
							the_content();
							
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'princess' ), 'after' => '</div>' ) ); 
						endwhile;
					endif;

					
					
					if(comments_open()){
					
						print '
						
						<hr />
							
						<!-- COMMENTS -->							
						
						<div id="comments">';
					
							comments_template( '', true );
								
						print '
						</div>';
					
					}
					
					
					
					
				print '
					</div>
				';
				
				//sidebar on right
				if($princess_default_sidebar_position != 'left'){
					print '<div class="sidebar widget-area">';
					get_sidebar('pages');
					print '</div>';
				}
				
				print '
				</section>';
			
		}else{				
			//no sidebar
				print '
				<section id="page-content">
					<div class="content">
					';

					if (have_posts()) :
						while ( have_posts() ) : the_post();
						
							the_content();
						
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'princess' ), 'after' => '</div>' ) ); 
						endwhile;
					endif;
					
					
					if(comments_open()){
					
						print '
						
						<hr />
							
						<!-- COMMENTS -->							
						
						<div id="comments">';
					
							comments_template( '', true );
								
						print '
						</div>';
					
					}
					

				print '
					</div>
				</section>';
		}
	

get_footer();

?>