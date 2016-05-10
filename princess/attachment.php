<?php  
get_header(); 

$type = get_post_mime_type( $post->ID );
	
	print '
	<section id="page-content">';
	
	//add full width title 						
		print '
		<div class="tp-title style2 page-title">
			<div class="titles">
			<h1>'.__('ATTACHMENT PAGE','princess').'</h1><br />
			<h5>'. strtoupper(get_the_title()) .' ('.$type.')</h5>			
			</div>
		</div>
		';
		
	
	switch ( $type ) {  	
		case 'audio/mpeg':  
			print do_shortcode('[audio src="'.esc_url(wp_get_attachment_url( $post->ID )).'"]<br />');
			
			break;  
		case 'video/mpeg':  
		case 'video/mp4':  
		case 'video/webm':  
			print do_shortcode('[video src="'.esc_url(wp_get_attachment_url( $post->ID )).'"]<br />');
			
			break;  		
		case 'image/jpeg':  
			
			print '
			<p class="aligncenter"><img src="'.esc_url(wp_get_attachment_url( $post->ID )).'" alt='.__('image attachment','princess').'" class="image" /></p>';
			
			break;  
		default:  			
		
			break;  
	}

	//show link to file		
		print '<p class="aligncenter"><a href="'.esc_url(wp_get_attachment_url( $post->ID )).'"><i>'.__('Link to the file...','princess').'</i></a></p>';
	
	
	print '</section>';

//FOOTER	
get_footer();

?>  