<?php
/*
	Template for displaying post by an Author.
*/

get_header(); 

	//check if sidebar is required
		$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');			
		
		if(is_active_sidebar('sidebar-widget-area')){			
			//has sidebar	
				print '
				<section id="page-content">
				';
				
				
				$author = get_userdata(get_query_var('author'));
					
				//add full width title 						
					print '
					<div class="tp-title style2 page-title">
						<div class="titles">
						<h1>'.__('AUTHOR ARCHIVES ','princess').'</h1><br />
						<h5>'. strtoupper(sprintf( __('%s','princess'), $author->display_name  )) .'</h5>			
						</div>
					</div>
					';
				
				
				
				//sidebar on left
				if($princess_default_sidebar_position == 'left'){
					print '<div class="sidebar left widget-area">';
					get_sidebar();
					print '</div>';
				}
				
				print '
					<div class="content with-sidebar">	
						<div class="blog-small">					
					';

				
					if ( $author->user_description  ){
						print '
						<article class="archive-author">
							<p>';
							if(!empty($author->user_url)){
								print '<a href="'.esc_url($author->user_url).'" target="_blank">'.get_avatar( $author->user_email ).'</a>';
							}else{
								print get_avatar( $author->user_email );
							}
						print '
							<strong>'.$author->nickname.'</strong>
							<br /><br />'.$author->user_description.'</p>
							
						</article>
						<hr />
						';
					}		
				
								
						
					if (have_posts()) :
						while ( have_posts() ) : the_post();
													
							get_template_part( 'content-blog-small' );
						
						endwhile;
					endif;
					
					
					
					
					//pagination
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
					

				print '
						</div>
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
				
				
				$author = get_userdata(get_query_var('author'));
						
				//add full width title 						
					print '
					<div class="tp-title style2 page-title">
						<div class="titles">
						<h1>'.__('AUTHOR ARCHIVES ','princess').'</h1><br />
						<h5>'. strtoupper(sprintf( __('%s','princess'), $author->display_name  )) .'</h5>			
						</div>
					</div>
					';
				
				
				print '
					<div class="content">
						<div class="blog-small">		
					';
					
					
					
					if ( $author->user_description  ){
						print '
						<article class="archive-author">
							<p>';
							if(!empty($author->user_url)){
								print '<a href="'.esc_url($author->user_url).'" target="_blank">'.get_avatar( $author->user_email ).'</a>';
							}else{
								print get_avatar( $author->user_email );
							}
						print '
							<strong>'.$author->nickname.'</strong>
							<br /><br />'.$author->user_description.'</p>
							
						</article>
						<hr />
						';
					}		
					
					
					if (have_posts()) :
						while ( have_posts() ) : the_post();
													
							get_template_part( 'content-blog-small' );
						
						endwhile;
					endif;
					
					
					
				//pagination
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
					

				print '
						</div>
					</div>
				</section>';
		}

	
	
get_footer(); 

?>