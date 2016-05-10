<?php


get_header();


	$princess_default_sidebar_position = get_theme_mod('princess_default_sidebar_position');
	
		
		
		if(is_active_sidebar('search-widget-area')){			
			//has sidebar	
				print '
				<section id="page-content">
				
				
				<div class="tp-title style2 page-title">
					<div class="titles">
					<h1>'.__('SEARCH RESULTS FOR','princess').'</h1>
					<br /><h5>'.strtoupper(get_search_query()).'</h5>
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
					';
					if (have_posts()) :
						while ( have_posts() ) : the_post();
							//collect results						
							
								if(has_excerpt()){
									$s_results[] = '
									<article class="sresult">
										<h4 class="results-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										<p class="results-date">'.get_the_date().'</p>
										<p class="results-excerpt">'.get_the_excerpt().'</p>
									</article>
									<hr class="hr2" />
									';
								}else{
									$s_results[] = '
									<article class="sresult">
										<h4 class="results-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										<p class="results-date">'.get_the_date().'</p>
									</article>
									<hr class="hr2" />
									';
								}
							
						
						endwhile;
					endif;

					
					//list results
					
						if(!empty($s_results)){
							$res_count = count($s_results);
						}else{
							$res_count = '0';
						}
						
						if(!empty($s_results)){						
							foreach($s_results as $rp){
								print $rp;
							}
						}else{
							_e('Sorry, but nothing matched your search criteria in posts.','princess');
						}
						
					

				print '
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
						<h1>'.__('SEARCH RESULTS FOR','princess').'</h1>
						<br /><h5>'.strtoupper(get_search_query()).'</h5>
						</div>
					</div>
				
					<div class="content">
					
					';

					if (have_posts()) :
						while ( have_posts() ) : the_post();
							//collect results						
							
								if(has_excerpt()){
									$s_results[] = '
									<article class="sresult">
										<h4 class="results-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										<p class="results-date">'.get_the_date().'</p>
										<p class="results-excerpt">'.get_the_excerpt().'</p>
									</article>
									<hr class="hr2" />
									';
								}else{
									$s_results[] = '
									<article class="sresult">
										<h4 class="results-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
										<p class="results-date">'.get_the_date().'</p>
									</article>
									<hr class="hr2" />
									';
								}
							
						
						endwhile;
					endif;

					
					//list results
					
						if(!empty($s_results)){
							$res_count = count($s_results);
						}else{
							$res_count = '0';
						}
						
						
						if(!empty($s_results)){						
							foreach($s_results as $rp){
								print $rp;
							}
						}else{
							_e('Sorry, but nothing matched your search criteria in posts.','princess');
						}
						
					
					
				print '
					</div>
				</section>';
		}
	

get_footer();

?>