<?php

// Loading Default values

require_once(dirname(__FILE__) . "/admin/mantra-defaults.php"); 

// Loading function that generates the custom css

require_once(dirname(__FILE__) . "/admin/mantra-custom-styles.php"); 

// Loading the mantra admin functions if admin section

if( is_admin() ) {
require_once(dirname(__FILE__) . "/admin/mantra-admin-functions.php");
require_once(dirname(__FILE__) . "/admin/mantra-sanitize.php");
}



// Getting the theme options and making sure defaults are used if no values are set

function mantra_get_theme_options() {
	global $mantra_defaults;
	$optionsMantra = get_option( 'ma_options', $mantra_defaults );
	$optionsMantra = array_merge($mantra_defaults, $optionsMantra);
return $optionsMantra;
}

$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;

}

// Bringing up Mantra Settings page after install

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=mantra-page' );



// Header hook

function mantra_header() {
    do_action('mantra_header');
}

// Loading mantra css style

function mantra_style() {
	wp_register_style( 'mantras', get_stylesheet_uri() );
	wp_enqueue_style( 'mantras');
}

// CSS loading and hook into wp_enque_scripts

		add_action('wp_print_styles', 'mantra_style',1 );
		add_action('wp_head', 'mantra_custom_styles' ,8);
		add_action('wp_head', 'mantra_customcss',8);
		

 $totalSize = $mantra_sidebar + $mantra_sidewidth+50;

// Scripts loading and hook into wp_enque_scripts

function mantra_scripts_method() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
    							 ${"$key"} = $value ;
									}


	if ( !is_admin() ) {
		wp_register_script('menu',get_template_directory_uri() . '/js/menu.js', array('jquery') );
		wp_enqueue_script('menu');
			if($mantra_backtop =="Enable") {
							wp_register_script('top',get_template_directory_uri() . '/js/top.js', array('jquery'));
							wp_enqueue_script('top');}
  									
		if($mantra_frontpage =="Enable") {
							wp_register_script('nivoSlider',get_template_directory_uri() . '/js/nivo-slider.js', array('jquery'));
							wp_enqueue_script('nivoSlider');}
  									}

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

add_action('wp_enqueue_scripts', 'mantra_scripts_method');



/**

 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = $mantra_sidewidth;

/** Tell WordPress to run mantra_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'mantra_setup' );

if ( ! function_exists( 'mantra_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override mantra_setup() in a child theme, add your own mantra_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since mantra 0.5
 */
function mantra_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions (cropped)

	// Add default posts and comments RSS feed links to head

	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status'));

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'mantra', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );



	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mantra' ),
		'top' => __( 'Top Navigation', 'mantra' ),
		'footer' => __( 'Footer Navigation', 'mantra' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to mantra_header_image_width and mantra_header_image_height to change these values.
	global $mantra_hheight;
	$mantra_hheight=(int)$mantra_hheight;
	global $totalSize;
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'mantra_header_image_width', $totalSize ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'mantra_header_image_height', $mantra_hheight) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the same size as the header.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See mantra_admin_header_style(), below.
	add_custom_image_header( '', 'mantra_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(


		'mantra' => array(
			'url' => '%s/images/headers/mantra.png',
			'thumbnail_url' => '%s/images/headers/mantra-thumbnail.png',
			// translators: header image description
			'description' => __( 'mantra', 'mantra' )
		),


	) );
}
endif;

if ( ! function_exists( 'mantra_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in mantra_setup().
 *
 * @since mantra 0.5
 */
function mantra_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since mantra 0.5
 */
function mantra_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mantra_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Mantra 1.0
 * @return int
 */
function mantra_excerpt_length( $length ) {
	global $mantra_excerptwords;
	return $mantra_excerptwords;
}
add_filter( 'excerpt_length', 'mantra_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since mantra 0.5
 * @return string "Continue Reading" link
 */
function mantra_continue_reading_link() {
	global $mantra_excerptcont;
	return ' <a href="'. get_permalink() . '">' .$mantra_excerptcont.' <span class="meta-nav">&rarr; </span>' . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mantra_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since mantra 0.5
 * @return string An ellipsis
 */
function mantra_auto_excerpt_more( $more ) {
	global $mantra_excerptdots;
	return $mantra_excerptdots. mantra_continue_reading_link();
}
add_filter( 'excerpt_more', 'mantra_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since mantra 0.5
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function mantra_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mantra_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'mantra_custom_excerpt_more' );




function mantra_trim_excerpt($text) {
global $mantra_excerptwords;
global $mantra_excerptcont;
global $mantra_excerptdots;
$raw_excerpt = $text;
if ( '' == $text ) {
    //Retrieve the post content.
    $text = get_the_content('');
 
    //Delete all shortcode tags from the content.
    $text = strip_shortcodes( $text );
 
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
 
    $allowed_tags = '<a>,<img>,<b>,<strong>,<ul>,<li>,<i>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<pre>,<code>,<em>,<u>';
    $text = strip_tags($text, $allowed_tags);
 
    $words = preg_split("/[\n\r\t ]+/", $text, $mantra_excerptwords + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $mantra_excerptwords ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text .' '.$mantra_excerptdots. ' <a href="'. get_permalink() . '">' .$mantra_excerptcont.' <span class="meta-nav">&rarr; </span>' . '</a>';
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
if ($mantra_excerpttags=='Enable') {
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mantra_trim_excerpt');
}



/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Mantra's style.css.
 *
 * @since mantra 0.5
 * @return string The gallery style filter, with the styles themselves removed.
 */
function mantra_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'mantra_remove_gallery_css' );

if ( ! function_exists( 'mantra_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own mantra_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since mantra 0.5
 */
function mantra_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 );
		?><?php printf(  '%s <span class="says">'.__('says:', 'mantra' ).'</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>



		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'mantra' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf(  '%1$s '.__('at', 'mantra' ).' %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mantra' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'mantra' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'mantra'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override mantra_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since mantra 0.5
 * @uses register_sidebar
 */
function mantra_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area - Sidebar 1', 'mantra' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Primary widget area - Sidebar 1', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area - Sidebar 1', 'mantra' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Secondary widget area - Sidebar 1', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3 for the second sidebar. Empty be default
	register_sidebar( array(
		'name' => __( 'Third Widget Area - Sidebar 2', 'mantra' ),
		'id' => 'third-widget-area',
		'description' => __( 'Third widget area - Sidebar 2', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located below the Third Widget Area in the second sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Widget Area - Sidebar 2', 'mantra' ),
		'id' => 'fourth-widget-area',
		'description' => __( 'Fourth widget area  - Sidebar 2', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'mantra' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'First footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'mantra' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Second footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'mantra' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'mantra' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running mantra_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'mantra_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since mantra 0.5
 */
function mantra_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'mantra_remove_recent_comments_style' );

if ( ! function_exists( 'mantra_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since mantra 0.5
 */
function mantra_posted_on() {

	printf( '&nbsp; %4$s <span class="onDate"> %3$s <span class="bl_sep">|</span> </span>  <span class="bl_categ"> %2$s </span>  ',
		'meta-prep meta-prep-author',
		get_the_category_list( ', ' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span> <span class="entry-time"> - %2$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard" >'.__( 'By ','mantra'). ' <a class="url fn n" href="%1$s" title="%2$s">%3$s</a> <span class="bl_sep">|</span></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'mantra' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

function mantra_comments_on() {

printf ( comments_popup_link( __( 'Leave a comment', 'mantra' ), __( '<b>1</b> Comment', 'mantra' ), __( '<b>%</b> Comments', 'mantra' ) ));

}







if ( ! function_exists( 'mantra_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since mantra 0.5
 */
function mantra_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in =  '<span class="bl_posted">'.__( 'Tagged','mantra').' %2$s.</span><span class="bl_bookmark">'.__(' Bookmark the ','mantra').' <a href="%3$s" title="Permalink to %4$s" rel="bookmark"> '.__('permalink','mantra').'</a>.</span>';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = '<span class="bl_bookmark">'.__( 'Bookmark the ','mantra'). ' <a href="%3$s" title="Permalink to %4$s" rel="bookmark">'.__('permalink','mantra').'</a>. </span>';
	} else {
		$posted_in = '<span class="bl_bookmark">'.__( 'Bookmark the ','mantra'). ' <a href="%3$s" title="Permalink to %4$s" rel="bookmark">'.__('permalink','mantra').'</a>. </span>';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'mantra_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mantra_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'mantra' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'mantra' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mantra_content_nav


function echo_first_image ($postID)
{				
	$args = array(
	'numberposts' => 1,
	'order'=> 'ASC',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => 'any',
	'post_type' => 'any'
	);
	
	$attachments = get_children( $args );
	
	//print_r($attachments);
	
	if ($attachments) {
		foreach($attachments as $attachment) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				
			return wp_get_attachment_thumb_url( $attachment->ID );
			
		}
	}
}




function set_featured_thumb() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;

}
global $post;
$image_src = echo_first_image($post->ID);


	 if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $mantra_fpost=='Enable') { the_post_thumbnail( array($mantra_fwidth,$mantra_fheight), array("class" => "align".strtolower($mantra_falign)." post_thumbnail" ) ); }


	else	if ($mantra_fpost=='Enable' && $mantra_fauto=="Enable" && $image_src && ($mantra_excerptarchive != "Full Post" || $mantra_excerpthome != "Full Post")) { 
 echo '<img width='.$mantra_fwidth.' height='.$mantra_fheight.' title="" alt="" class="align'.strtolower($mantra_falign).' post_thumbnail" src="'.$image_src.'">' ;
																							}
								
	}	

function set_social_icons() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;

}
if ($mantra_social1 && $mantra_social2) {  ?><a target="_blank" href="<?php echo $mantra_social2; ?>" class="socialicons" id="<?php echo $mantra_social1; ?>" title="<?php echo $mantra_social1; ?>"><img alt="<?php echo $mantra_social1; ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.$mantra_social1.'.png'; ?>" /></a><?php }
?><?php if ($mantra_social3 && $mantra_social4) {  ?><a target="_blank" href="<?php echo $mantra_social4 ?>" class="socialicons" id="<?php echo $mantra_social3 ?>" title="<?php echo $mantra_social3 ?>"><img alt="<?php echo $mantra_social3; ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.$mantra_social3.'.png'; ?>" /></a><?php }
?><?php if ($mantra_social5 && $mantra_social6) {  ?> <a target="_blank" href="<?php echo $mantra_social6 ?>" class="socialicons" id="<?php echo $mantra_social5 ?>" title="<?php echo $mantra_social5 ?>"><img alt="<?php echo $mantra_social5; ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.$mantra_social5.'.png'; ?>" /></a> <?php }
?><?php if ($mantra_social7 && $mantra_social8) {  ?> <a target="_blank" href="<?php echo $mantra_social8 ?>" class="socialicons" id="<?php echo $mantra_social7 ?>" title="<?php echo $mantra_social7 ?>"><img alt="<?php echo $mantra_social7; ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.$mantra_social7.'.png'; ?>" /></a> <?php }
?><?php if ($mantra_social9 && $mantra_social10) {  ?> <a target="_blank" href="<?php echo $mantra_social10 ?>" class="socialicons" id="<?php echo $mantra_social9 ?>" title="<?php echo $mantra_social9 ?>"><img alt="<?php echo $mantra_social9; ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.$mantra_social9.'.png'; ?>" /></a> <?php }
 
						}

// Get any existing copy of our transient data
if ( false === ( $theme_info = get_transient( 'theme_info' ) ) ) {
    // It wasn't there, so regenerate the data and save the transient
     $theme_info = get_theme_data( get_theme_root() . '/mantra/style.css' );

     set_transient( 'theme_info',  $theme_info ,60*60*12);
}

