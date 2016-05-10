<?php


get_header();


	$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');
	
	//check if sidebar is required
		
		
		if(is_active_sidebar('search-widget-area')){
			//has sidebar	
				print '
				<section id="page-content">
				
				
				<div class="tp-title style2 page-title">
					<div class="titles">
					<h1>'.__('PAGE NOT FOUND','princess').'</h1>
					<br /><h5>'.__('ERROR #404','princess').'</h5>
					</div>
				</div>
				';
				
				//sidebar on left
				if($princess_default_sidebar_position == 'left'){
					print '<div class="sidebar left widget-area">';
					get_sidebar('search');
					print '</div>';
				}
				
				print '
					<div class="content with-sidebar">						
						<article>
						<p><strong>'.__('Sorry!','princess').'</strong> '. __( 'The page you\'re looking for is not available!<br />Maybe you want to try a search?', 'princess' ).'</p>
						<div class="vspace3"></div>				
						';
						
						//get_search_form();
						
						print '
						</article>
					</div>
				';
				
				//sidebar on right
				if($princess_default_sidebar_position != 'left'){
					print '<div class="sidebar widget-area">';
					get_sidebar('search');
					print '</div>';
				}
				
				print '
				</section>';
			
		}else{				
			//no sidebar
				print '
				<section id="page-content">
					
					<div class="tp-title style2 page-title">
						<div class="titles">
						<h1>'.__('PAGE NOT FOUND','princess').'</h1>
						<br /><h5>'.__('ERROR #404','princess').'</h5>
						</div>
					</div>
				
					<div class="content">
						<article>
							<p><strong>'.__('Sorry!','princess').'</strong> '. __( 'The page you\'re looking for is not available!<br />Maybe you want to try a search?', 'princess' ).'</p>
							<div class="vspace3"></div>				
							';
							
							get_search_form();
							
							print '
						</article>
					</div>
				</section>';
		}
	

get_footer();

?>