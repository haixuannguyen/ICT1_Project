<?php
/*
Template Name: Page with Full Width Image
*/


get_header();


	print '
	<div id="full-width-slider">
		<div class="loading"></div>
		<div class="pattern"></div>
		<div class="shine"></div>
		';
		
		//load slider item		
		if(has_post_thumbnail(get_the_ID())){					
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			print '<div class="layer" style="background-image:url(\''.$src[0].'\')"></div>';
		}else{
			print '<div class="layer note"><p>'.__('Please set a featured image for this page to display an image here!<br />Try to keep its file size below 350kbyte for faster loading!','princess').'</p></div>';
		}
			
			
		
	print '
	</div>
	';


get_footer();

?>