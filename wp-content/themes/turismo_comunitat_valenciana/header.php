<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>  xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9" /> 
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(''); ?></title>
<?php
/* This  retrieves  admin options. */

$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {	
     ${"$key"} = $value ;
}
$totalwidth= $mantra_sidewidth+$mantra_sidebar+50;
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ($mantra_options['mantra_faviconshow']=="Enable" && $mantra_options['mantra_favicon']) { ?> <link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/uploads/'.$mantra_options['mantra_favicon']; ?>" />
<?php }

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
 	mantra_header(); 
	wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : 'YOUR_APP_ID', // App ID
      channelUrl : '//www.turismecomunitatvalenciana.info/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
<script>
    jQuery(document).ready(function() {
    jQuery("#content img").addClass("<?php echo 'image'.$mantra_image;?>");
    });

</script>

<div id="toTop"> </div>


<div id="wrapper" class="hfeed">

<?php if ( has_nav_menu( 'top' ) ) wp_nav_menu( array( 'container_class' => 'topmenu', 'theme_location' => 'top' ) ); ?>

<div id="header">

		<div id="masthead"> 
		
			<div id="branding" role="banner" >
				<?php if ($mantra_options['mantra_linkheader']=="Enable") { ?><a href="<?php echo home_url( '/' ); ?>" id="linky"> </a><?php } ?>  
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?><<?php echo $heading_tag; ?> id="site-title">
					<span> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> </span>
				</<?php echo $heading_tag; ?>>
				<div id="site-description" ><?php bloginfo( 'description' ); ?></div>
				
				<div class="socials" id="sheader"> <?php if($mantra_socialsdisplay0) set_social_icons(); ?> </div>

				<?php
				// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) && $mantra_fheader == "Enable" &&
							(  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' ); ?>   
					<style> #access {margin-top:<?php echo $image[2]+10;?>px !important;}  </style>  
				<?php else : if (get_header_image() != '') { ?>
					<style> #branding { background:url(<?php header_image(); ?>) no-repeat; <?php if ($mantra_dimselect=="Absolute") { ?>width:<?php echo HEADER_IMAGE_WIDTH; ?>px; <?php } ?> height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;} </style>
				<?php } else { ?><?php } ?>
				<?php endif; 

				if ($mantra_options['mantra_linkheader']=="Enable") { ?>  
				<style>
					#linky { display:block; position:absolute; width:<?php echo HEADER_IMAGE_WIDTH; ?>px; height:<?php echo HEADER_IMAGE_HEIGHT; ?>px; z-index:2; }
					#branding { height:<?php echo HEADER_IMAGE_HEIGHT; ?>px; }
					#site-title, #site-description, #sheader { position:relative; z-index:100 }
				</style>
				<?php } ?>
				<?php boom_header_image() ?>
				<div style="clear:both;"></div>
			
			</div><!-- #branding --> 
	
			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mantra' ); ?>"><?php _e( 'Skip to content', 'mantra' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */
				 wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->
	
		</div><!-- #masthead -->

<div style="clear:both;"> </div>




	</div><!-- #header -->
	<div id="main">
	<div  id="forbottom" >
			<div class="socials" id="smenul">
<?php if($mantra_socialsdisplay1) set_social_icons(); ?>
</div>
			<div class="socials" id="smenur">
<?php if($mantra_socialsdisplay2) set_social_icons(); ?>
</div>
<div style="clear:both;"> </div>
