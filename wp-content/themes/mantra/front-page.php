<?php
/**
 * The main template file.
 *
 * This is the default fron-page.php file
 * If the front-page is enabled in the Mantra settings 
 * than the custom look will be applied.
 * If not a standard index.php will be loaded.
 *
 * @package Cryout Creations
 * @subpackage Mantra
 */
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {

     ${"$key"} = $value ;

}
get_header(); 
if ($mantra_frontpage!="Enable") {

if (is_page()) {
?>

	<section id="container">
		<?php get_sidebar(); ?>

	<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mantra' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'mantra' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php if ( comments_open() ) { comments_template( '', true );} else { ?>
														<p class="nocomments2"><?php _e( 'Comments are closed.', 'mantra' ); ?></p>


<?php } endwhile; ?>

			</div><!-- #content -->
		</section><!-- #container -->

<?php } else { ?>




		<div id="container">
			<?php get_sidebar(); ?>
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php mantra_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php mantra_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mantra' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php } }
else { ?>


		 <script type="text/javascript">

function flash(id){

             

             jQuery(id)
             .animate({opacity: 0.5}, 100) 
             .fadeOut(100)
			 .fadeIn(100)
             .animate({opacity: 1}, 100)
			
			

}

    jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({

			effect: '<?php  echo $mantra_fpslideranim; ?>',
        animSpeed: <?php echo $mantra_fpslidertime ?>,
        pauseTime: <?php echo $mantra_fpsliderpause ?>,
	<?php	if($mantra_fpsliderarrows=="Hidden") { ?> directionNav: false, <?php }
   	if($mantra_fpsliderarrows=="Always Visible") { ?>  directionNavHide: false, <?php } ?>

});

 

                jQuery('#front-columns > div img').mouseover(function(e) { flash(this); })






   
		});	
	</script>

<style>

<?php if ($mantra_fronthideheader) {?> #branding {display:none;} <?php }
	  if ($mantra_fronthidemenu) {?> #access {display:none;} <?php }
  	  if ($mantra_fronthidewidget) {?> #colophon {display:none;} <?php }
	  if ($mantra_fronthidefooter) {?> #footer2 {display:none;} <?php }
      if ($mantra_fronthideback) {?> #main {background:none;} <?php } ?>


#slider{ 
width:<?php echo $mantra_fpsliderwidth ?>px !important;
height:<?php echo $mantra_fpsliderheight ?>px !important;
margin:30px auto;
display:block;
}


#front-text1 h1 , #front-text2 h1{
display:block;
float:none;
margin:30px auto;
text-align:center;
font-size:32px;
clear:both;
line-height:32px;
font-style:italic;
font-weight:bold;
font-variant:small-caps;
-webkit-text-shadow:1px 1px 1px #CCC;
-moz-text-shadow:1px 1px 1px #CCC;
text-shadow:1px 1px 1px #CCC;
font-weight:normal;
}

 #front-text2 h1{
font-size:28px;
line-height:28px;
margin-top:40px;
margin-bottom:15px;
}


#frontpage blockquote {
width:88% ;
max-width:88% !important;
margin-bottom:20px;
font-size:16px;
line-height:22px;
color:#444;
}

#frontpage #front-text4 blockquote {
font-size:14px;
line-height:18px;
color:#666;
}

#frontpage blockquote:before, #frontpage blockquote:after {
content:none;
}

.column-image {
height:<?php echo $mantra_colimageheight ?>px;
}

<?php if ($mantra_fpslidernav!="Bullets") { 
	if ($mantra_fpslidernav=="Numbers") {?>

.theme-default .nivo-controlNav {bottom:-22px;}
.theme-default .nivo-controlNav a {
    background: none;
	text-decoration:underline;
	margin-right:5px;
    display: block;
    float: left;
	text-align:center;
    height: 16px;
    text-indent:0;
    width: 16px;
}
<?php } else if ($mantra_fpslidernav=="None") {?>
.theme-default .nivo-controlNav {display:none;}

<?php } } ?>
</style>
<div id="frontpage">
<?php  if($mantra_fronttext1) {?><div id="front-text1"> <h1><?php echo $mantra_fronttext1 ?> </h1></div><?php } ?>

 <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
             <?php  if($mantra_sliderimg1) {?>    <a href="<?php echo $mantra_sliderlink1 ?>"><img width="<?php echo $mantra_fpsliderwidth ?>" src="<?php echo $mantra_sliderimg1 ?>" id="slider1" alt="" <?php if ($mantra_slidertitle1 || $mantra_slidertext1 ) { ?>title="#caption1" <?php }?> /></a><?php } 
           			if($mantra_sliderimg2) {?>    <a href="<?php echo $mantra_sliderlink2 ?>"><img width="<?php echo $mantra_fpsliderwidth ?>" src="<?php echo $mantra_sliderimg2 ?>" id="slider2" alt="" <?php if ($mantra_slidertitle2 || $mantra_slidertext2 ) { ?>title="#caption2" <?php }?> /></a><?php } 
 					if($mantra_sliderimg3) {?>    <a href="<?php echo $mantra_sliderlink3 ?>"><img width="<?php echo $mantra_fpsliderwidth ?>" src="<?php echo $mantra_sliderimg3 ?>" id="slider3" alt="" <?php if ($mantra_slidertitle3 || $mantra_slidertext3 ) { ?>title="#caption3" <?php }?> /></a><?php } 
 		    		if($mantra_sliderimg4) {?>    <a href="<?php echo $mantra_sliderlink4 ?>"><img width="<?php echo $mantra_fpsliderwidth ?>" src="<?php echo $mantra_sliderimg4 ?>" id="slider4" alt="" <?php if ($mantra_slidertitle4 || $mantra_slidertext4 ) { ?>title="#caption4" <?php }?> /></a><?php } 
			 		if($mantra_sliderimg5) {?>    <a href="<?php echo $mantra_sliderlink5 ?>"><img width="<?php echo $mantra_fpsliderwidth ?>" src="<?php echo $mantra_sliderimg5 ?>" id="slider5" alt="" <?php if ($mantra_slidertitle5 || $mantra_slidertext5 ) { ?>title="#caption5" <?php }?> /></a><?php } ?>
              
            </div>
            <div id="caption1" class="nivo-html-caption">
                <?php echo '<h2>'.$mantra_slidertitle1.'</h2>'.$mantra_slidertext1 ?>
            </div>
            <div id="caption2" class="nivo-html-caption">
                <?php echo '<h2>'.$mantra_slidertitle2.'</h2>'.$mantra_slidertext2 ?>
            </div>
            <div id="caption3" class="nivo-html-caption">
                <?php echo '<h2>'.$mantra_slidertitle3.'</h2>'.$mantra_slidertext3 ?>
            </div>
            <div id="caption4" class="nivo-html-caption">
                <?php echo '<h2>'.$mantra_slidertitle4.'</h2>'.$mantra_slidertext4 ?>
            </div>

            <div id="caption5" class="nivo-html-caption">
                <?php echo '<h2>'.$mantra_slidertitle5.'</h2>'.$mantra_slidertext5 ?>
            </div>
        </div>

<?php  if($mantra_fronttext2) {?><div id="front-text2"> <h1><?php echo $mantra_fronttext2 ?> </h1></div><?php } ?>

<div id="front-columns"> 
	<div id="column1">
	<a  href="<?php echo $mantra_columnlink1 ?>">	<div class="column-image" ><img  src="<?php echo $mantra_columnimg1 ?>" id="column1" alt="" /> </div> <h3><?php echo $mantra_columntitle1 ?></h3> </a><div class="column-text"><?php echo $mantra_columntext1 ?></div>
	<div class="columnmore"> <a href="<?php echo $mantra_columnlink1 ?>">Read more &raquo;</a> </div>
	</div>
	<div id="column2">
		<a  href="<?php echo $mantra_columnlink2 ?>">	<div class="column-image" ><img  src="<?php echo $mantra_columnimg2 ?>" id="column2" alt="" /> </div> <h3><?php echo $mantra_columntitle2 ?></h3> </a><div class="column-text"><?php echo $mantra_columntext2 ?></div>
	<div class="columnmore"> <a href="<?php echo $mantra_columnlink2 ?>">Read more &raquo;</a> </div>
	</div>
	<div id="column3">
		<a  href="<?php echo $mantra_columnlink3 ?>">	<div class="column-image" ><img  src="<?php echo $mantra_columnimg3 ?>" id="column3" alt="" /> </div> <h3><?php echo $mantra_columntitle3 ?></h3> </a><div class="column-text"><?php echo $mantra_columntext3 ?></div>
	<div class="columnmore"> <a href="<?php echo $mantra_columnlink3 ?>">Read more &raquo;</a> </div>
	</div>

	<div id="column4">
		<a  href="<?php echo $mantra_columnlink4 ?>">	<div class="column-image" ><img  src="<?php echo $mantra_columnimg4 ?>" id="column4" alt="" /> </div> <h3><?php echo $mantra_columntitle4 ?></h3> </a><div class="column-text"><?php echo $mantra_columntext4 ?></div>
	<div class="columnmore"> <a href="<?php echo $mantra_columnlink4 ?>">Read more &raquo;</a> </div>
	</div>

</div>

<?php  if($mantra_fronttext3) {?><div id="front-text3"> <blockquote><?php echo $mantra_fronttext3 ?> </blockquote></div><?php } 
  if($mantra_fronttext4) {?><div id="front-text4"> <blockquote><?php echo $mantra_fronttext4 ?> </blockquote></div><?php } 

 ?>
</div> <!-- frontpage -->

 <?php  }// end if 

 get_footer(); ?>