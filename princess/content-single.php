<?php

	

	//date
		print '
		<div class="post-head">
			<div class="post-date">'.get_the_date('d').'<span>'.get_the_date('M').'</span><br />
				<div class="year">'.get_the_date('Y').'</div>
			</div>
			
			<div class="post-info"><span>'.str_replace('rel="category"','',get_the_category_list( __( ', ', 'princess' ) )).'&nbsp;&nbsp;&#8226;&nbsp;&nbsp;'; comments_number( __('0 comment','princess'), __('1 comment','princess'), __('% comments','princess') ); print'</span>
				<br /><h1>';
				
					print '<a href="'.get_permalink().'">';						
				
				
				print get_the_title().'</a></h1>
			</div>				
		</div>
		<div class="clear"></div>';
		
		print '<article class="tp-single-post">';
	
	
		if(has_excerpt()){
			print '<p class="excerpt">'.get_the_excerpt().'</p>';
		}
	
	
	
		
		the_content();
	
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'princess' ), 'after' => '</div>' ) ); 
		
		print '</article>
		<div class="vspace2"></div>';
			

		//TAGS						
			$posttags = get_the_tags( $post->ID );
			if ($posttags) {
				
				print '<p class="tags"><span>'.__('TAGS: ','princess').'</span>';
				
				 foreach($posttags as $tag) {
					$opt[] = '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'; 
				}
				print implode(', ',$opt);
				
				
				print '</p>
				<div class="vspace3"></div>';
			}
		
							
					
		//COMMENTS
			comments_template( '', true );	
		
		
?>