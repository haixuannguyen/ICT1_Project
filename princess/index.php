<?php
/*	This page displays blog posts */

	
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
						if('page' == get_option('show_on_front') && get_option('page_for_posts') && is_home()){					
							$page_for_posts_id = get_option('page_for_posts');
							$page_data = get_page($page_for_posts_id);
							if(!empty($page_data->post_content)){
								print '<article>'.apply_filters('the_content', $page_data->post_content).'</article>';
								print '<hr />';
							}
						}
						
						
						print '
							<div class="blog-small">
						';

						if (have_posts()) :
							while ( have_posts() ) : the_post();
							
								get_template_part( 'content-blog-small' );						
							
							endwhile;
						endif;

						print '
							</div>
						';
					
										
					
					//pagination
						global $wp_query;
						
						if(function_exists('wp_paginate')) {
							print '<div class="vspace3">';
							wp_paginate();		
						} 
						else{
							//display default next/prev links					
							if($wp_query->max_num_pages > 1 ){								
								
								print '						
								<div id="page_control">';
								
									print '<div class="left">'; previous_posts_link('<div id="page_control-newer"><i class="fa fa-angle-left circle"></i><span class="hiddenonmobile">&nbsp;&nbsp;'.__('Previous Page ','princess').'</span></div>'); print '</div>';
								
									print '<div class="pageof">- ';
										$page_curr = (get_query_var('paged')) ? get_query_var('paged') : 1;								
										print sprintf(__('PAGE %d OF %d','princess'),$page_curr,$wp_query->max_num_pages);
									print ' -</div>';
									
									
									print '<div class="right">'; next_posts_link('<div id="page_control-older"><span class="hiddenonmobile">'.__('Next Page','princess').'&nbsp;&nbsp;</span><i class="fa fa-angle-right circle"></i></div>'); print '</div>';
									
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
				if('page' == get_option('show_on_front') && get_option('page_for_posts') && is_home()){					
					$page_for_posts_id = get_option('page_for_posts');
					$page_data = get_page($page_for_posts_id);
					if(!empty($page_data->post_content)){
						print '<article>'.apply_filters('the_content', $page_data->post_content).'</article>';
						print '<hr />';
					}
				}
				
				
				print '
					<div class="blog-small">
				';

				if (have_posts()) :
					while ( have_posts() ) : the_post();
					
						get_template_part( 'content-blog-small' );						
					
					endwhile;
				endif;

				print '
					</div>
				';
			
			
			
			//pagination
				global $wp_query;
				
				if(function_exists('wp_paginate')) {
					print '<div class="vspace3">';
					wp_paginate();		
				} 
				else{
					//display default next/prev links					
					if($wp_query->max_num_pages > 1 ){								
						
						print '						
						<div id="page_control">';
						
							print '<div class="left">'; previous_posts_link('<div id="page_control-newer"><i class="fa fa-angle-left circle"></i>&nbsp;&nbsp;'.__('Previous Page ','princess').'</div>'); print '</div>';
						
							print '<div class="pageof">- ';
								$page_curr = (get_query_var('paged')) ? get_query_var('paged') : 1;								
								print sprintf(__('PAGE %d OF %d','princess'),$page_curr,$wp_query->max_num_pages);
							print ' -</div>';
							
							
							print '<div class="right">'; next_posts_link('<div id="page_control-older">'.__('Next Page','princess').'&nbsp;&nbsp;<i class="fa fa-angle-right circle"></i></div>'); print '</div>';
							
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