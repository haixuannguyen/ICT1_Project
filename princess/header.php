<!DOCTYPE html>
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php	

	
	$princess_favicon = get_theme_mod('princess_favicon');
	if(!empty($princess_favicon)){print '<link rel="shortcut icon" href="'.esc_url($princess_favicon).'" />
';} 
	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php esc_url(get_bloginfo( 'pingback_url' )); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php print get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>	
	<![endif]-->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	
	<!-- DISPLAY MESSAGE IF JAVA IS TURNED OFF -->	
	<noscript>		
		<div id="notification"><strong><?php print __('This website requires JavaScript!</strong> Please enable JavaScript in your browser and reload the page!','princess'); ?></div>	
	</noscript>

	<!-- OLD IE BROWSER WARNING -->
	<div id="ie_warning"><?php print '<img src="'.get_template_directory_uri().'/images/warning.png" alt="'.esc_attr(__('warning icon','princess')).'" /><br />'.__('<strong>YOUR BROWSER IS OUT OF DATE!</strong><br /><br />This website uses the latest web technologies so it requires an up-to-date, fast browser!<br />Please try <a href="http://www.mozilla.org/en-US/firefox/new/?from=getfirefox">Firefox</a> or <a href="https://www.google.com/chrome">Chrome</a>!','princess'); ?></div>
	
	
	<!-- PRELOADER -->
	<div id="preloader"></div>
	
	
	<!-- HEADER -->
	<header class="header">
		<div class="bg">
			<div class="wrapper">
						
				<nav class="responsive-res">
				<?php	
					$logo = get_theme_mod('princess_logo',get_template_directory_uri() .'/images/logo.png');				
					
					print '
					<div class="logo"><a href="'.esc_url(home_url()).'"><img src="'.esc_url($logo).'" alt="'.esc_attr(__('logo','princess')).'" /></a></div>
					
					<div id="responsive-menu"><i class="fa fa-bars"></i></div>
					
					';	
				?>
				</nav>
			
				<nav class="desktop-res">
				<?php		
						
				
					$princess_logo = get_theme_mod('princess_logo',get_template_directory_uri() .'/images/logo.png');
					
						//get logo ALT text
							
							$alt = '';
							$attachment_id = attachment_url_to_postid($princess_logo);
							$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);						
							if(empty($alt)){ $alt = __('logo','princess'); }
							
						print '<div class="logo style2"><a href="'.esc_url(home_url()).'"><img src="'.esc_url($princess_logo).'" alt="'.esc_attr($alt).'" /></a></div>';				
					
					
					if( has_nav_menu( 'primary' ) ) {									
						$def = array('container' => 'ul',
						'theme_location' => 'primary',
						'menu_id' => 'menu-main',
						'menu_class' => 'menu',
						'echo' => true);
						wp_nav_menu($def);							
					}else{
						$def = array('container' => 'ul',
						'menu_id' => 'menu-main',
						'menu_class' => 'menu',
						'echo' => true);						
						wp_nav_menu($def);	
					}
					
					
				?>
				</nav>				
			</div>
		</div>
	</header>
	
	<div id="header-shadow"></div>
	
	
		<!-- RESPONSIVE MENU -->
		<div id="respo-menu-holder">
			<?php			
				$menu_items = wp_nav_menu( array(
					'container' => 'ul',
					'theme_location' => 'primary',
					'menu_id' => 'respo-menu-list-left',					
					'echo' => false
				));	
				
				print $menu_items;			
			
			get_search_form();
			?>
		</div>
