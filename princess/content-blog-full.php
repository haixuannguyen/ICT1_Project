<?php
	
	$postclass = get_post_class();
	if(has_post_thumbnail()){
		$postclass[] = 'has-thumb';
	}
	
	if(is_sticky()){
		$postclass[] = 'sticky';
	}
	
	print '<article class="'.implode(' ',$postclass).'">';
				
		//date
			print '
			<div class="post-head">
				<div class="post-date">'.get_the_date('d').'<span>'.get_the_date('M').'</span><br />
					<div class="year">'.get_the_date('Y').'</div>
				</div>
				
				<div class="post-info"><span>'.str_replace('rel="category"','',get_the_category_list( __( ', ', 'princess' ) )).'&nbsp;&nbsp;&#8226;&nbsp;&nbsp;'; comments_number( __('0 comment','princess'), __('1 comment','princess'), __('% comments','princess') ); print'</span>
					<br /><h1>';
					
					if(is_sticky()){
						print '<img src="'.get_template_directory_uri().'/images/sticky.png" alt="'.__('sticky post','princess').'" class="icon-sticky" />';
					}
					
					if(get_post_format() == 'link'){
						print '<a href="'.esc_url(get_post_meta($post->ID,'tp_postf_link',true)).'" target="_blank">';
					}else{
						print '<a href="'.get_permalink().'">';						
					}
					
					$title = get_the_title();
					if(!empty($title)){
						print get_the_title();
					}else{
						print __('Untitled','princess');
					}
					print '</a></h1>
				</div>				
			</div>';
			
		
		
		if(has_excerpt()){
			print '<p class="post-excerpt">'.get_the_excerpt().'</p>';
		}elseif(get_post_format() == 'quote'){
			print get_the_content();
		}
			
			
		
		if(get_post_format() == 'audio'){
			if(strstr(get_post_meta($post->ID,'tp_postf_audio',true), '.mp3')){
				print do_shortcode('[audio src="'.esc_url(get_post_meta($post->ID,'tp_postf_audio',true)).'" type="audio/mp3"]');
			}else{
				$gpm_audio = get_post_meta($post->ID,'tp_postf_audio',true);
				if(strstr($gpm_audio,'soundcloud')){
					print str_replace('&','&amp;',$gpm_audio);
				}else{
					print $gpm_audio;
				}
			}		
		}
		
		if(get_post_format() == 'video'){			
			$cnt = get_post_meta($post->ID,'tp_postf_video',true);
			$cnt = str_replace('&','&amp;',$cnt);		
			print $cnt;
		}
				
		
		
		print '<div class="vspace4"></div>';
		
		the_content();
	
	
	
	print '</article>
	<hr class="hr2" />
	';
	

	
	
?>	