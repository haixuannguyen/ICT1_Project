<?php 
/*
 * Set up the content width value based on the theme's design.
 */
if ( ! function_exists( 'foodrecipes_setup' ) ) :
function foodrecipes_setup() {
	
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900;
	}
	/*
	 * Make foodrecipes theme available for translation.
	 */
	load_theme_textdomain( 'foodrecipes', get_template_directory() . '/languages' );
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', foodrecipes_font_url() ) );
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// This theme uses wp_nav_menu() in two locations.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'foodrecipes-full-width', 1038, 576, true );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'foodrecipes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );
	add_theme_support( 'custom-background', apply_filters( 'foodrecipes_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );
	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'foodrecipes_get_featured_posts',
		'max_posts' => 6,
	) );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}

endif; // foodrecipes_setup
add_action( 'after_setup_theme', 'foodrecipes_setup' );

// Implement Custom Header features.
require get_template_directory() . '/function/custom-header.php';

//foodrecipes theme custom widget
require_once('function/foodrecipes-post-widget.php');

//foodrecipes theme theme option
require_once('theme-options/fasterthemes.php');

/*** TGM ***/
require_once('function/tgm-plugins.php');

/**
 * Add default menu style if menu is not set from the backend.
 */
function foodrecipes_add_menuid ($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $foodrecipes_matches);
	$foodrecipes_divclass = '';
	if(!empty($foodrecipes_matches)) { $foodrecipes_divclass = $foodrecipes_matches[1]; }	
	$foodrecipes_toreplace = array('<div class="'.$foodrecipes_divclass.' pull-right-res">', '</div>');
	$foodrecipes_replace = array('<div class="navbar-collapse collapse ">', '</div>');
	$foodrecipes_new_markup = str_replace($foodrecipes_toreplace,$foodrecipes_replace, $page_markup);
	$foodrecipes_new_markup= preg_replace('/<ul/', '<ul class="navbar-collapse collapse menu-foodrecipes"', $foodrecipes_new_markup);
	return $foodrecipes_new_markup;
}
add_filter('wp_page_menu', 'foodrecipes_add_menuid');

// thumbnail list 
function foodrecipes_thumbnail_image($content) {

    if( has_post_thumbnail() )
         return the_post_thumbnail( 'thumbnail' ); 
}
/**
 * Register Lato Google font for foodrecipes.
 */
function foodrecipes_font_url() {
	$foodrecipes_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'foodrecipes' ) ) {
		$foodrecipes_font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}
	return $foodrecipes_font_url;
}
/*
 * Header Title
*/
function foodrecipes_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );
	// Add the site description for the home/front page.
	$foodrecipes_site_description = get_bloginfo( 'description', 'display' );
	if ( $foodrecipes_site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $foodrecipes_site_description";
	}
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'foodrecipes' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'foodrecipes_wp_title', 10, 2 );

/*********** Register Sidebar **************/
function foodrecipes_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'foodrecipes' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'foodrecipes' ),
		'before_widget' => '<aside id="%1$s" class="widget blog-categories %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'foodrecipes_widgets_init' );

/*********** Enqueue File **************/
add_filter( 'wp_title', 'foodrecipes_wp_title', 10, 2 );
function foodrecipes_enqueue()
{
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css',array(),'','');
	wp_enqueue_style('style',get_stylesheet_uri(),array('bootstrap'),'','');
	wp_enqueue_style('foodrecipes_media',get_template_directory_uri().'/css/media.css',array(),'','');
	wp_enqueue_style('awesome',get_template_directory_uri().'/css/font-awesome.min.css',array(),'','');
	wp_enqueue_style('foodrecipes_base',get_template_directory_uri().'/css/base.css',array(),'','');
	wp_enqueue_script('bootstrapjs',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'','');	
	wp_enqueue_script('jquery-masonry');
	wp_enqueue_script('base',get_template_directory_uri().'/js/base.js',array('jquery'),'','');
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_enqueue_scripts', 'foodrecipes_enqueue');

/***************** Breadcrumbs **********************/
function foodrecipes_custom_breadcrumbs() {
  $foodrecipes_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $foodrecipes_delimiter = '/'; // delimiter between crumbs
  $foodrecipes_home = __('Home','foodrecipes'); // text for the 'Home' link
  $foodrecipes_showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $foodrecipes_before = '<span>'; // tag before the current crumb
  $foodrecipes_after = '</span>'; // tag after the current crumb

  global $post;
  $foodrecipes_homeLink = home_url();

  if (is_home() || is_front_page()) {

    if ($foodrecipes_showonhome == 1) echo '<div id="crumbs" class="foodrecipes-breadcrumb"><a href="' . $foodrecipes_homeLink . '">' . $foodrecipes_home . '</a></div>';

  } else {

    echo '<div id="crumbs" class="foodrecipes-breadcrumb"><a href="' . $foodrecipes_homeLink . '">' . $foodrecipes_home . '</a> ' . $foodrecipes_delimiter . ' ';

    if ( is_category() ) {
      $foodrecipes_thisCat = get_category(get_query_var('cat'), false);
      if ($foodrecipes_thisCat->parent != 0) echo get_category_parents($foodrecipes_thisCat->parent, TRUE, ' ' . $foodrecipes_delimiter . ' ');
      echo $foodrecipes_before . __('Archive by category','foodrecipes'). ' "'. single_cat_title('', false) . '"' . $foodrecipes_after;

    } elseif ( is_search() ) {
      echo $foodrecipes_before . __('Search results for','foodrecipes') .' "'. get_search_query() . '"' . $foodrecipes_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $foodrecipes_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $foodrecipes_delimiter . ' ';
      echo $foodrecipes_before . get_the_time('d') . $foodrecipes_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $foodrecipes_delimiter . ' ';
      echo $foodrecipes_before . get_the_time('F') . $foodrecipes_after;

    } elseif ( is_year() ) {
      echo $foodrecipes_before . get_the_time('Y') . $foodrecipes_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $foodrecipes_post_type = get_post_type_object(get_post_type());
        $foodrecipes_slug = $foodrecipes_post_type->rewrite;
        echo '<a href="' . $foodrecipes_homeLink . '/' . $foodrecipes_slug['slug'] . '/">' . $foodrecipes_post_type->labels->singular_name . '</a>';
        if ($foodrecipes_showCurrent == 1) echo ' ' . $foodrecipes_delimiter . ' ' . $foodrecipes_before . get_the_title() . $foodrecipes_after;
      } else {
        $foodrecipes_cat = get_the_category(); $foodrecipes_cat = $foodrecipes_cat[0];
        $foodrecipes_cats = get_category_parents($foodrecipes_cat, TRUE, ' ' . $foodrecipes_delimiter . ' ');
        if ($foodrecipes_showCurrent == 0) $foodrecipes_cats = preg_replace("#^(.+)\s$foodrecipes_delimiter\s$#", "$1", $foodrecipes_cats);
        echo $foodrecipes_cats;
        if ($foodrecipes_showCurrent == 1) echo $foodrecipes_before . get_the_title() . $foodrecipes_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $foodrecipes_post_type = get_post_type_object(get_post_type());
      echo $foodrecipes_before . $foodrecipes_post_type->labels->singular_name . $foodrecipes_after;

    } elseif ( is_attachment() ) {
      $foodrecipes_parent = get_post($post->post_parent);
      $foodrecipes_cat = get_the_category($foodrecipes_parent->ID); $foodrecipes_cat = $foodrecipes_cat[0];
      echo get_category_parents($foodrecipes_cat, TRUE, ' ' . $foodrecipes_delimiter . ' ');
      echo '<a href="' . get_permalink($foodrecipes_parent) . '">' . $foodrecipes_parent->post_title . '</a>';
      if ($foodrecipes_showCurrent == 1) echo ' ' . $foodrecipes_delimiter . ' ' . $foodrecipes_before . get_the_title() . $foodrecipes_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($foodrecipes_showCurrent == 1) echo $foodrecipes_before . get_the_title() . $foodrecipes_after;

    } elseif ( is_page() && $post->post_parent ) {
      $foodrecipes_parent_id  = $post->post_parent;
      $foodrecipes_breadcrumbs = array();
      while ($foodrecipes_parent_id) {
        $foodrecipes_page = get_page($foodrecipes_parent_id);
        $foodrecipes_breadcrumbs[] = '<a href="' . get_permalink($foodrecipes_page->ID) . '">' . get_the_title($foodrecipes_page->ID) . '</a>';
        $foodrecipes_parent_id  = $foodrecipes_page->post_parent;
      }
      $foodrecipes_breadcrumbs = array_reverse($foodrecipes_breadcrumbs);
      for ($foodrecipes_i = 0; $foodrecipes_i < count($foodrecipes_breadcrumbs); $foodrecipes_i++) {
        echo $foodrecipes_breadcrumbs[$foodrecipes_i];
        if ($foodrecipes_i != count($foodrecipes_breadcrumbs)-1) echo ' ' . $foodrecipes_delimiter . ' ';
      }
      if ($foodrecipes_showCurrent == 1) echo ' ' . $foodrecipes_delimiter . ' ' . $foodrecipes_before . get_the_title() . $foodrecipes_after;

    } elseif ( is_tag() ) {
      echo $foodrecipes_before . __('Posts tagged','foodrecipes').' "' . single_tag_title('', false) . '"' . $foodrecipes_after;

    } elseif ( is_author() ) {
       global $author;
      $foodrecipes_userdata = get_userdata($author);
      echo $foodrecipes_before . __('Articles posted by','foodrecipes').' '. $foodrecipes_userdata->display_name . $foodrecipes_after;

    } elseif ( is_404() ) {
      echo $foodrecipes_before . __('Error 404','foodrecipes') . $foodrecipes_after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','foodrecipes') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
}

/**
 * Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 **/
function foodrecipes_entry_meta() {

	$foodrecipes_category_list = get_the_category_list( ', ', 'foodrecipes' );

	$foodrecipes_tag_list = get_the_tag_list(', ', 'foodrecipes' );

	$foodrecipes_date = sprintf( '<a href="%1$s" title="%2$s" ><time datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$foodrecipes_author = sprintf( '<span><a href="%1$s" title="%2$s" >%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'foodrecipes' ), get_the_author() ) ),
		get_the_author()
	);
if(get_comments_number() > 0 ) {

	if ( $foodrecipes_tag_list ) {
			$foodrecipes_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s', 'foodrecipes' );
			echo __('Comments','foodrecipes'). ' : ' .get_comments_number().' ';
		} elseif ( $foodrecipes_category_list ) {
			$foodrecipes_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s', 'foodrecipes' );
			echo __('Comments','foodrecipes'). ' : ' .get_comments_number().' ';
		} else {
			$foodrecipes_utility_text = __( 'Posted on : %3$s by : %4$s', 'foodrecipes' );
			echo __('Comments','foodrecipes'). ' : ' .get_comments_number().' ';
		}
	
	
	
} else {
	if ( $foodrecipes_tag_list ) {
			$foodrecipes_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s', 'foodrecipes' );
		} elseif ( $foodrecipes_category_list ) {
			$foodrecipes_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s', 'foodrecipes' );
		} else {
			$foodrecipes_utility_text = __( 'Posted on : %3$s by : %4$s', 'foodrecipes' );
		}
}

	printf(
		$foodrecipes_utility_text,
		$foodrecipes_category_list,
		$foodrecipes_tag_list,
		$foodrecipes_date,
		$foodrecipes_author
	);
}



if ( ! function_exists( 'foodrecipes_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own foodrecipes_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function foodrecipes_comment( $comment, $foodrecipes_args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'foodrecipes' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( 'Edit', 'foodrecipes' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
</li>
<?php
			break;
		default :
		// Proceed with normal comments.
		if($comment->comment_approved==1)
		{
		global $post;
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment col-md-12 foodrecipes-inner-blog-comment">
    <figure class="avtar"> <a href="#"><?php echo get_avatar( get_the_author_meta(), '80'); ?></a> </figure>
    <div class="foodrecipes-comment-name txt-holder">
      <?php
                            printf( '<b class="fn">%1$s'.'</b>',
                                get_comment_author_link(),
                                ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author ', 'foodrecipes' ) . '</span>' : '' 
                            ); 
						?>
    </div>
    <div class="foodrecipes-comment-datetime"> <?php echo get_comment_date('F j, Y \a\t g:i a'); ?> </div>
    <div class="foodrecipes-comment-text blog-post-comment-text comment">
      <?php  comment_text(); ?>
    </div>
    <div class="foodrecipes-comment-reply-link">
      <?php
                    echo '<a href="#" class="reply pull-right">'.comment_reply_link( array_merge( $foodrecipes_args, array( 'reply_text' => __( 'Reply', 'foodrecipes' ), 'after' => '', 'depth' => $depth, 'max_depth' => $foodrecipes_args['max_depth'] ) ) ).'</a>';
                     ?>
    </div>
    <div class="foodrecipes-comment-hr"></div>
    <!-- .comment-content --> 
    
    <!-- .txt-holder --> 
  </article>
  <!-- #comment-## -->
  <?php
		}
		break;
	endswitch; // end comment_type check
}
endif;

/*
 * Replace Excerpt [...] with Read More
**/
function foodrecipes_read_more( ) {
return ' <br /><a class="more" href="'. get_permalink( get_the_ID() ) . '">'.__('Read more ','foodrecipes').'</a>';
 }
add_filter( 'excerpt_more', 'foodrecipes_read_more' ); 
