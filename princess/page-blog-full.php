<?php
/*
Template Name: Blog - Full Posts
*/

get_header();


	
	//check if sidebar is required		
		$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');		
		
	//with sidebar	
		if(is_active_sidebar('sidebar-widget-area')){					
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
				
				
				
			//load blog posts
				print '<div class="blog-full">';
				
				
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type' => 'post',
							'paged' => $paged
						);
						$the_query = new WP_Query( $args );						
						if($the_query->have_posts()){
							while($the_query->have_posts()){
								$the_query->the_post();
								
								get_template_part( 'content-blog-full' );
								
							}
						}
						
						
				print '</div>';
				
				
			
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
				';
				
				
				
				print '
					<div class="content">
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
				
			//load blog posts
				print '<div class="blog-full full">';
				
				
				
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
							'post_type' => 'post',
							'paged' => $paged
						);
						$the_query = new WP_Query( $args );						
						if($the_query->have_posts()){
							while($the_query->have_posts()){
								$the_query->the_post();
								
								get_template_part( 'content-blog-full' );
								
							}
						}
					
					
				print '</div>';
				
				
			
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
				</section>';
		}
	

get_footer();

?>