<?php
/*
Template Name: Blog - Small Thumbs
*/


	
get_header();
	

	$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');
	
	//check if sidebar is required		
		if(is_active_sidebar('sidebar-widget-area')){
						
				
				print '
				<section id="page-content" class="has_sb">
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

						//print page content if set				
						if (have_posts()){							
							while(have_posts()){
								the_post();							
							
								if($post->post_content != ""){
									print '<article>';
									
									the_content();							
									
									print '</article>
									<hr />';
								}
							}							
						}
							
						
					//posts	
						print '
							<div class="blog-small">
						';

						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type' => 'post',
							'paged' => $paged
						);
						$the_query = new WP_Query( $args );						
						if($the_query->have_posts()){
							while($the_query->have_posts()){
								$the_query->the_post();
								
								get_template_part( 'content-blog-small' );
								
							}
						}
						

						print '
							</div>
						';
					
										
					
					//pagination						
						if(function_exists('wp_paginate')) {
							print '<div class="vspace3">';
							wp_paginate();		
						} 
						else{
							//display default next/prev links					
							if($the_query->max_num_pages > 1 ){								
								
								print '						
								<div id="page_control">';
								
									print '<div class="left">'; previous_posts_link('<div id="page_control-newer"><i class="fa fa-angle-left circle"></i><span class="hiddenonmobile">&nbsp;&nbsp;'.__('Previous Page ','princess').'</span></div>'); print '</div>';
								
									print '<div class="pageof">- ';
										$page_curr = (get_query_var('paged')) ? get_query_var('paged') : 1;								
										print sprintf(__('PAGE %d OF %d','princess'),$page_curr,$the_query->max_num_pages);
									print ' -</div>';
									
									
									print '<div class="right">'; next_posts_link('<div id="page_control-older"><span class="hiddenonmobile">'.__('Next Page','princess').'&nbsp;&nbsp;</span><i class="fa fa-angle-right circle"></i></div>',$the_query->max_num_pages); print '</div>';
									
								print '
								</div>';						
								
							}
						}			
						
						wp_reset_query();	
						wp_reset_postdata();
				
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
			<section id="page-content">
				<div class="content">';
				
				//print page content if set				
					if (have_posts()){							
						while(have_posts()){
							the_post();							
						
							if($post->post_content != ""){
								print '<article>';
								
								the_content();							
								
								print '</article>
								<hr />';
							}
						}							
					}
				
				
			
					//posts
						print '
							<div class="blog-small">
						';

						
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type' => 'post',
							'paged' => $paged
						);
						$the_query = new WP_Query( $args );						
						if($the_query->have_posts()){
							while($the_query->have_posts()){
								$the_query->the_post();
								
								get_template_part( 'content-blog-small' );
								
							}
						}
						

						print '
							</div>
						';
			
			
			
			//pagination				
				if(function_exists('wp_paginate')) {
					print '<div class="vspace3">';
					wp_paginate();		
				} 
				else{
					//display default next/prev links					
					if($the_query->max_num_pages > 1 ){								
						
						print '						
						<div id="page_control">';
						
							print '<div class="left">'; previous_posts_link('<div id="page_control-newer"><i class="fa fa-angle-left circle"></i><span class="hiddenonmobile">&nbsp;&nbsp;'.__('Previous Page ','princess').'</span></div>'); print '</div>';
						
							print '<div class="pageof">- ';
								$page_curr = (get_query_var('paged')) ? get_query_var('paged') : 1;								
								print sprintf(__('PAGE %d OF %d','princess'),$page_curr,$the_query->max_num_pages);
							print ' -</div>';
							
							
							print '<div class="right">'; next_posts_link('<div id="page_control-older">'.__('Next Page','princess').'&nbsp;&nbsp;<i class="fa fa-angle-right circle"></i></div>',$the_query->max_num_pages); print '</div>';
							
						print '
						</div>';						
						
					}
				}			
				
				wp_reset_query();	
				wp_reset_postdata();
			
			
			
			print '
				</div>
			</section>';
		}
		
	
			
	
get_footer();
?>