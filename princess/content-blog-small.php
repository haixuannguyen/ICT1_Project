<?php
	

	$postclass = get_post_class();
	if(has_post_thumbnail()){
		$postclass[] = 'has-thumb';
	}
	
	if(is_sticky()){
		$postclass[] = 'sticky';
	}
	
	print '<article class="'.implode(' ',$postclass).'">';
	
		//thumb
			if(has_post_thumbnail()){
				print '<div class="post-thumb"><a href="'.get_permalink().'">';
				if(get_post_format() == 'video'){
					print '<div class="icon-play"></div>';
				}
				print get_the_post_thumbnail().'</a></div>';
			}
			
		//date
			print '
			<div class="post-head">
				<div class="post-date">'.get_the_date('d').'<span>'.get_the_date('M').'</span><br />
					<div class="year">'.get_the_date('Y').'</div>
				</div>
				
				<div class="post-info"><span>'.str_replace('rel="category"','',get_the_category_list( __( ', ', 'princess' ) )); 
				if(comments_open()){
					print '&nbsp;&nbsp;&#8226;&nbsp;&nbsp;';
					comments_number( __('0 comment','princess'), __('1 comment','princess'), __('% comments','princess') ); 
				}
				
						
				print '</span>
					<br /><h3>';

					if(is_sticky()){
						print '<img src="'.get_template_directory_uri().'/images/sticky.png" alt="'.__('sticky post','princess').'" class="icon-sticky" />';
					}
				

					
					print '<a href="'.get_permalink().'" title="';  the_title_attribute(); print '">';						
					
								
					$title = get_the_title();
					if(!empty($title)){
						print get_the_title();
					}else{
						print __('Untitled','princess');
					}
					print '</a></h3>
				</div>
				
			</div>';
			
		
		
		
		
		
			print '<p class="post-excerpt"><br />'.get_the_excerpt().' <a href="'.get_permalink().'" title="';  the_title_attribute(); print '">'.__('Read more...','princess').'</a></p>';
		
		
		//display tags		
		
		if(has_tag()){
			print '<p class="tags"><span>'.__('TAGS: ','princess').'</span>';
				
				$posttags = get_the_tags( $post->ID );
				if ($posttags) {
				  foreach($posttags as $tag) {
					$opt[] = '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'; 
				  }
				  print implode(', ',$opt);
				}
				
			print '</p>';
		}
	
	
	print '</article>
	<hr class="hr2" />
	';
	
	
	
?>	