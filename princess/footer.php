<?php
//footer widget areas
	
	
	//footer area 1		
		if ( is_active_sidebar( 'first-footer-widget-area' ) ){
			$footer_widget_areas[] = 'first-footer-widget-area';
		}			
	//footer area 2		
		if ( is_active_sidebar( 'second-footer-widget-area' ) ){
			$footer_widget_areas[] = 'second-footer-widget-area';
		}			
	//footer area 3		
		if ( is_active_sidebar( 'third-footer-widget-area' ) ){
			$footer_widget_areas[] = 'third-footer-widget-area';
		}			
	//footer area 4		
		if ( is_active_sidebar( 'fourth-footer-widget-area' ) ){
			$footer_widget_areas[] = 'fourth-footer-widget-area';
		}			
		
				
	
	
	
	//print footer area
		if(!empty($footer_widget_areas) && !is_page_template('page-home.php')){
			$num_of_fa = count($footer_widget_areas);		
			if($num_of_fa == '4'){
				$fa_class = 'one_fourth';
			}elseif($num_of_fa == '3'){
				$fa_class = 'one_third';
			}elseif($num_of_fa == '2'){
				$fa_class = 'one_half';
			}else{
				$fa_class = '';
			}
			
			print '<section class="footer-widgets widget-area">';
			$fawctr = '0';
			foreach($footer_widget_areas as $faw){
				$fawctr++;
				if($fawctr == $num_of_fa){
					print '<div class="'.$fa_class.' last">';
				}else{
					print '<div class="'.$fa_class.'">';
				}
				
				dynamic_sidebar( $faw );
				
				print '</div>';
			}
			print '</section>';
		}
		
	
		
?>

	<footer>						
		<div class="bg">
			<section class="wrapper">
				<?php
					$tp_footer_logo = get_theme_mod('princess_logo');
					if(!empty($tp_footer_logo)){
						//get logo ALT text
							$alt = '';
							$attachment_id = attachment_url_to_postid($tp_footer_logo);
							$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);			
					
						print '<div class="logo"><a href="'.home_url().'"><img src="'.esc_url($tp_footer_logo).'" alt="'.esc_attr($alt).'" /></a></div>';						
					}else{
						print '<div class="logo"><a href="'.home_url().'"><img src="'.get_template_directory_uri().'/images/logo.png" alt="'.esc_attr(__('logo','princess')).'" /></a></div>';
					}
					
					print '<div class="footer-left">';
					
						if(has_nav_menu( 'footer' )){
							$footer_menu = wp_nav_menu( array( 							
								'container' => 'ul',													
								'menu' => 'footer',
								'menu_id' => 'footer-menu',
								'depth' => '1',
								'after' => '<li class="li-sep">&nbsp;|&nbsp;'
							)); 				
							
							print str_replace('</li><li>','</li></li>',$footer_menu);							
						}else{
							print '<ul id="footer-menu" class="menu"><li>&nbsp;</li></ul>';
						}
							
						
						
						print '<br /><p class="copyright">DESIGN &amp; CODE BY <a href="http://themeprince.com" target="_blank">THEMEPRINCE.COM</a></p>';
						
						
						
					print '</div>';
					
					
					$princess_footer_text = get_theme_mod('princess_footer_text');
					if(!empty($princess_footer_text)){
						$allowedhtml = array(
							'a' => array(
								'href' => array(),
								'title' => array(),
								'target' => array()
							),
							'br' => array(),
							'em' => array(),
							'strong' => array(),
							'b' => array(),
							'i' => array(
								'class' => array()
							),
							'u' => array(),
							'p' => array(),
							'div' => array(),
							'img' => array(
								'src' => array(),
								'class' => array(),
								'id' => array(),
								'alt' => array(),
								'title' => array()
							),
							'span' => array()
							);
						$princess_footer_text = wp_kses($princess_footer_text,$allowedhtml);
					
						print '<div id="footer-icons">'.do_shortcode($princess_footer_text).'</div>';
					}
				?>
			</section>
		</div>
	</footer>
							
	
	
	
	<!-- CUSTOM PHOTO VIEWER -->
	<div id="tp-photo-viewer">
		<div id="tp-pv-loading"><img src="<?php print get_template_directory_uri().'/images/tp-pv-loading.gif'; ?>" alt="<?php _e('loading','princess'); ?>" /></div>
		<div id="tp-pv-img"></div>
		<div id="tp-pv-close">&times;</div>
		<div id="tp-pv-prev"><i class="fa fa-angle-left"></i></div>
		<div id="tp-pv-next"><i class="fa fa-angle-right"></i></div>
	</div>
	
	
	
	<!-- WP FOOTER STARTS -->
	<?php wp_footer(); ?>
	<!-- WP FOOTER ENDS -->
	
		
	
</body>
</html>