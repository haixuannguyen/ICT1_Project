<?php


// theme url
	$theme_text_domain = 'princess';	
	
	
	
	
// sets up the content width value based on the theme's design and stylesheet
	if ( ! isset( $content_width ) ){
		$content_width = 980;
	}
			
			

	
	

// set up theme defaults
	function princess_fw_setup() {
		
		// makes theme available for translation
		load_theme_textdomain( 'princess', get_template_directory() . '/languages' );
		
				
		// adds rss feed links to <head> for posts and comments
		add_theme_support( 'automatic-feed-links' );
		
		//theme is not defining titles on its own
		add_theme_support( 'title-tag' );
		
				
		// this theme uses wp_nav_menu() in one location
		register_nav_menu( 'primary', __( 'Primary Menu', 'princess' ) );
		register_nav_menu( 'footer', __( 'Footer Menu', 'princess' ) );
		
				
		//editor-style.css
		add_editor_style();		
		
			
		//remove gallery inline style
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		
		//gallery images link to file
		function princess_gal_link($out){
			$out['link'] = 'file'; 
			return $out;
		}
		add_filter( 'shortcode_atts_gallery','princess_gal_link');

		
		//change default gravatar
		add_filter( 'avatar_defaults', 'princess_newgravatar' );  		  
		function princess_newgravatar ($avatar_defaults) {  
			$myavatar = get_template_directory_uri() . '/images/avatar.jpg';  
			$avatar_defaults[$myavatar] = "princess user";  
			return $avatar_defaults;  
		}  

		
		// this theme uses a custom image size for featured images, displayed on "standard" posts
		add_theme_support( 'post-thumbnails' );
		
		
		// set thumbnail sizes with wp, forget custom imagecrop scripts		
		set_post_thumbnail_size( 162, 162, true ); // width, height, crop = true		
		if ( function_exists( 'add_image_size' ) ) {			
			add_image_size( 'princess-full-thumb', 576, 170, true ); // name, width, height, crop = true						
		}
		
	}
	add_action( 'after_setup_theme', 'princess_fw_setup' );
	
		
		
					
	
	
//frontend scipts and styles
	function princess_frontend_load(){
	
		//css
		wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css',array(),null,'all');				
		wp_enqueue_style('tp-default', get_stylesheet_uri(),array(),null,'all');	
		wp_enqueue_style('tp-responsive-style', get_template_directory_uri().'/style-responsive.css',array(),null,'all');
		
		//ie-only style sheets
		global $wp_styles;		
		wp_register_style('tp-ltie9-def', get_template_directory_uri(). '/style.css',array(),null);
		$wp_styles->add_data('tp-ltie9-def', 'conditional', 'lt IE 9');		
		wp_enqueue_style('tp-ltie9-def');
		
		wp_register_style('tp-ltie8', get_template_directory_uri(). '/css/stop_ie.css',array(),null);
		$wp_styles->add_data('tp-ltie8', 'conditional', 'lt IE 8');		
		wp_enqueue_style('tp-ltie8');
		
		//js
		wp_enqueue_script('jquery');
		wp_enqueue_script('retina_js', get_template_directory_uri() . '/js/retina.js', '', '', true );		
		wp_enqueue_script('startup', get_template_directory_uri().'/js/startup.js', array('jquery'));			
		wp_enqueue_script('tp-imageviewer', get_template_directory_uri().'/js/tp.imageviewer.js', array('jquery'));	
		
		
		if( is_single() && comments_open() && get_option( 'thread_comments' )){
			wp_enqueue_script( 'comment-reply' );
		}	
	}
	add_action( 'wp_enqueue_scripts', 'princess_frontend_load' );
	
	
	


// register widgetized areas, and load custom ones also!
	function princess_fw_widgets_init() {
		// located at the sidebar.
		register_sidebar( array(
			'name' => __( 'Sidebar Widget Area for Posts', 'princess' ),
			'id' => 'sidebar-widget-area',
			'description' => __( 'The sidebar widget area for Posts', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Sidebar Widget Area for Pages', 'princess' ),
			'id' => 'sidebar-widget-area-pages',
			'description' => __( 'The sidebar widget area for Pages', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
	
		// area 1, located in the footer.
		register_sidebar( array(
			'name' => __( 'First Footer Widget Area', 'princess' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		// area 2, located in the footer. 
		register_sidebar( array(
			'name' => __( 'Second Footer Widget Area', 'princess' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'The second footer widget area', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		// area 3, located in the footer.
		register_sidebar( array(
			'name' => __( 'Third Footer Widget Area', 'princess' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'The third footer widget area', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		// area 4, located in the footer.
		register_sidebar( array(
			'name' => __( 'Fourth Footer Widget Area', 'princess' ),
			'id' => 'fourth-footer-widget-area',
			'description' => __( 'The fourth footer widget area', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		// area 5, search/404 only
		register_sidebar( array(
			'name' => __( 'Search & 404 Sidebar', 'princess' ),
			'id' => 'search-widget-area',
			'description' => __( 'Sidebar for Search & 404 pages', 'princess' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		
	}	
	add_action( 'widgets_init', 'princess_fw_widgets_init' );
	
	
	

// removes the default styles that are packaged with the Recent Comments widget
	function princess_fw_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'princess_fw_remove_recent_comments_style' );
		
	
	
	
// comment functions
	function princess_validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}

	function princess_comments( $comment, $args, $depth ){		
		print '
		<li>';
		
		if(!princess_validate_gravatar(get_comment_author_email())){
			//replace to theme avatar
			print '<img class="avatar avatar-60 photo" width="60" height="60" src="'.get_template_directory_uri().'/images/avatar.jpg" alt="">';
			
		}else{
			//default
			print get_avatar($comment,'60');
		}
		
		print '
			<div class="holder">
				<p class="comment-author">'.get_comment_author().'<br /></p>		
				<p class="comment-info">';
					printf( __( '%1$s., %2$s','princess'), get_comment_date(),  get_comment_time() ); 
					edit_comment_link( __( '(Edit)' ,'princess'), ' ' );					
					print '&nbsp;&nbsp;&#8226;&nbsp;&nbsp;';
					
					comment_reply_link( 
						array_merge( $args, array( 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'], 
							'reply_text' => __('Reply','princess')
						) ) );
				print '</p>		
				<p class="comment">'.get_comment_text().'</p>
			</div>';
					
	}
		
		
	
	
		
		
// put theme options in customizer
	function princess_theme_customizer( $wp_customize ) {    
		$wp_customize->add_section( 'princess_logo_section' , array(
			'title'       => __( 'Logo & Favicon', 'princess' ),
			'priority'    => 30,
			'description' => 'Upload your logo (PNG) and favicon (PNG/ICO)',
		) );
		
		
		//logo
			$wp_customize->add_setting( 'princess_logo', array(
				'sanitize_callback' => 'esc_url_raw',
				'default' => get_template_directory_uri() .'/images/logo.png'
			)  );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'princess_logo', array(
				'label'    => __( 'Logo', 'princess' ),
				'section'  => 'princess_logo_section',
				'settings' => 'princess_logo',
			) ) );
		
		
		//favicon
			$wp_customize->add_setting( 'princess_favicon', array(
				'sanitize_callback' => 'esc_url_raw'
			)  );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'princess_favicon', array(
				'label'    => __( 'Favicon', 'princess' ),
				'section'  => 'princess_logo_section',
				'settings' => 'princess_favicon',
			) ) );
		
		
		
		
		
		//sidebar & footer
		$wp_customize->add_section( 'princess_sidebar_footer_section' , array(
			'title'       => __( 'Sidebar & Footer', 'princess' ),
			'priority'    => 100
		) );
		
		
		//sidebar
			$wp_customize->add_setting( 'princess_default_sidebar_position', array(
				'sanitize_callback' => 'princess_sanitize_sb_position'
			) );
			$wp_customize->add_control( 'princess_default_sidebar_position', array(
				'label'    => __( 'Default sidebar position', 'princess' ),
				'section'  => 'princess_sidebar_footer_section',
				'type' => 'select',
				'choices' => array(
					'' => __('Right','princess'),
					'left' => __('Left','princess')
				)
			) );
			
			function princess_sanitize_sb_position( $input ) {
				if($input == 'left'){
					return $input;
				}else{
					return '';
				}
			}
			
		
		//footer
			$wp_customize->add_setting( 'princess_footer_text', array(
				'sanitize_callback' => 'princess_sanitize_footer_text'
			) );
			$wp_customize->add_control( 'princess_footer_text', array(
				'label'    => __( 'Footer text in right bottom corner', 'princess' ),
				'section'  => 'princess_sidebar_footer_section',
				'type' => 'textarea'
			) );
			
			function princess_sanitize_footer_text( $input ) {
				return wp_kses_post( force_balance_tags( $input ) );
			}
		
	}
	add_action( 'customize_register', 'princess_theme_customizer' );
	
	
	


	
?>