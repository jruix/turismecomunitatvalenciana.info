<?php

//  Hooks/Filters
add_action('admin_init', 'mantra_init_fn' );
add_action('admin_menu', 'mantra_add_page_fn');
add_action('init', 'mantra_init');

function mantra_init() {
	wp_register_script('uploader',get_template_directory_uri() . '/admin/js/ajaxupload.js', array('jquery') );
	wp_enqueue_script('uploader');
	wp_enqueue_script("farbtastic");
	wp_enqueue_style( 'farbtastic' );
    wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');	
	load_theme_textdomain( 'mantra', get_template_directory_uri() . '/languages' );
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}

$mantra_options= mantra_get_theme_options();


// The settings
function mantra_init_fn(){
	wp_register_style( 'mantra',get_template_directory_uri() . '/admin/mantra-admin.css' );
	wp_register_style( 'mantra2',get_template_directory_uri() . '/js/farbtastic/farbtastic.css' );
	wp_register_style( 'jqueryui',get_template_directory_uri() . '/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css' );


	register_setting('ma_options', 'ma_options', 'ma_options_validate' );
	add_settings_section('layout_section', __('Layout Settings','mantra'), 'section_layout_fn', __FILE__);
	add_settings_section('presentation_section', __('Presentation Page','mantra'), 'section_presentation_fn', __FILE__);
	add_settings_section('text_section', __('Text Settings','mantra'), 'section_text_fn', __FILE__);
	add_settings_section('appereance_section',__('Color Settings','mantra') , 'section_appereance_fn', __FILE__);
	add_settings_section('graphics_section', __('Graphics Settings','mantra') , 'section_graphics_fn', __FILE__);
	add_settings_section('post_section', __('Post Information Settings','mantra') , 'section_post_fn', __FILE__);
	add_settings_section('excerpt_section', __('Post Excerpt Settings','mantra') , 'section_excerpt_fn', __FILE__);
	add_settings_section('featured_section', __('Featured Image Settings','mantra') , 'section_featured_fn', __FILE__);
	add_settings_section('socials_section', __('Social Media Settings','mantra') , 'section_social_fn', __FILE__);
	add_settings_section('misc_section', __('Miscellaneous Settings','mantra') , 'misc_social_fn', __FILE__);

	add_settings_field('mantra_side', __('Main Layout','mantra') , 'setting_side_fn', __FILE__, 'layout_section');
	add_settings_field('mantra_sidewidth', __('Content / Sidebar Width','mantra') , 'setting_sidewidth_fn', __FILE__, 'layout_section');
	add_settings_field('mantra_hheight', __('Header Image Height','mantra') , 'setting_hheight_fn', __FILE__, 'layout_section');

	add_settings_field('mantra_frontpage', __('Enable Presentation Page','mantra') , 'setting_frontpage_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontslider', __('Slider Settings','mantra') , 'setting_frontslider_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontslider2', __('Slides','mantra') , 'setting_frontslider2_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontcolumns', __('Presentation Page Columns','mantra') , 'setting_frontcolumns_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_fronttext', __('Extras','mantra') , 'setting_fronttext_fn', __FILE__, 'presentation_section');

	add_settings_field('mantra_fontfamily', __('General Font','mantra') , 'setting_fontfamily_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontsize', __('General Font Size','mantra') , 'setting_fontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fonttitle', __('Post Title Font ','mantra') , 'setting_fonttitle_fn', __FILE__, 'text_section');
	add_settings_field('mantra_headfontsize', __('Post Title Font Size','mantra') , 'setting_headfontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontside', __('Sidebar Font','mantra') , 'setting_fontside_fn', __FILE__, 'text_section');
	add_settings_field('mantra_sidefontsize', __('SideBar Font Size','mantra') , 'setting_sidefontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontsubheader', __('Sub-Headers Font','mantra') , 'setting_fontsubheader_fn', __FILE__, 'text_section');
	add_settings_field('mantra_textalign', __('Force Text Align','mantra') , 'setting_textalign_fn', __FILE__, 'text_section');
	add_settings_field('mantra_parindent', __('Paragraph indent','mantra') , 'setting_parindent_fn', __FILE__, 'text_section');
	add_settings_field('mantra_headerindent', __('Header indent','mantra') , 'setting_headerindent_fn', __FILE__, 'text_section');
	add_settings_field('mantra_lineheight', __('Line Height','mantra') , 'setting_lineheight_fn', __FILE__, 'text_section');
	add_settings_field('mantra_wordspace', __('Word spacing','mantra') , 'setting_wordspace_fn', __FILE__, 'text_section');
	add_settings_field('mantra_letterspace', __('Letter spacing','mantra') , 'setting_letterspace_fn', __FILE__, 'text_section');
	add_settings_field('mantra_textshadow', __('Text shadow','mantra') , 'setting_textshadow_fn', __FILE__, 'text_section');

	add_settings_field('mantra_backcolor', __('Background Color','mantra') , 'setting_backcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headercolor', __('Header (Banner and Menu) Background Color','mantra') , 'setting_headercolor_fn', __FILE__, 'appereance_section');
	
	add_settings_field('mantra_titlecolor', __('Site Title Color','mantra') , 'setting_titlecolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_descriptioncolor', __('Site Description Color','mantra') , 'setting_descriptioncolor_fn', __FILE__, 'appereance_section');

	add_settings_field('mantra_contentcolor', __('Content Text Color','mantra') , 'setting_contentcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_linkscolor', __('Links Color','mantra') , 'setting_linkscolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_hovercolor', __('Links Hover Color','mantra') , 'setting_hovercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headtextcolor',__( 'Post Title Color','mantra') , 'setting_headtextcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headtexthover', __('Post Title Hover Color','mantra') , 'setting_headtexthover_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_sideheadbackcolor', __('Sidebar Header Background Color','mantra') , 'setting_sideheadbackcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_sideheadtextcolor', __('Sidebar Header Text Color','mantra') , 'setting_sideheadtextcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_prefootercolor', __('Footer Widget Background Color','mantra') , 'setting_prefootercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footercolor', __('Footer Background Color','mantra') , 'setting_footercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footerheader', __('Footer Widget Header Text Color','mantra') , 'setting_footerheader_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footertext', __('Footer Widget Link Color','mantra') , 'setting_footertext_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footerhover', __('Footer Widget Hover Color','mantra') , 'setting_footerhover_fn', __FILE__, 'appereance_section');

	add_settings_field('mantra_caption', __('Caption Border','mantra') , 'setting_caption_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_image', __('Post Images Border','mantra') , 'setting_image_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_pin', __('Caption Pin','mantra') , 'setting_pin_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_sidebullet', __('Sidebar Menu Bullets','mantra') , 'setting_sidebullet_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_metaback', __('Meta Area Background','mantra') , 'setting_metaback_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_contentlist', __('Content List Bullets','mantra') , 'setting_contentlist_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_title', __('Title and Description','mantra') , 'setting_title_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_pagetitle', __('Page Titles','mantra') , 'setting_pagetitle_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_categetitle', __('Category Page Titles','mantra') , 'setting_categtitle_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_tables', __('Hide Tables','mantra') , 'setting_tables_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_backtop', __('Back to Top button','mantra') , 'setting_backtop_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comtext', __('Text Under Comments','mantra') , 'setting_comtext_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comclosed', __('Comments are closed text','mantra') , 'setting_comclosed_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comoff', __('Comments off','mantra') , 'setting_comoff_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_copyright', __('Insert footer copyright','mantra') , 'setting_copyright_fn', __FILE__, 'graphics_section');

	add_settings_field('mantra_postdate', __('Post Date','mantra') , 'setting_postdate_fn', __FILE__, 'post_section');
	add_settings_field('mantra_posttime', __('Post Time','mantra') , 'setting_posttime_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postauthor', __('Post Author','mantra') , 'setting_postauthor_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postcateg', __('Post Category','mantra') , 'setting_postcateg_fn', __FILE__, 'post_section');
	add_settings_field('mantra_posttag', __('Post Tags','mantra') , 'setting_posttag_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postbook', __('Post Permalink','mantra') , 'setting_postbook_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postmetas', __('All Post Metas','mantra') , 'setting_postmetas_fn', __FILE__, 'post_section');

	add_settings_field('mantra_excerpthome', __('Post Excerpts on Home Page','mantra') , 'setting_excerpthome_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptarchive', __('Post Excerpts on Arhive and Category Pages','mantra') , 'setting_excerptarchive_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptwords', __('Number of Words for Post Excerpts ','mantra') , 'setting_excerptwords_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_magazinelayout', __('Magazine Layout','mantra') , 'setting_magazinelayout_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptdots', __('Excerpt suffix','mantra') , 'setting_excerptdots_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptcont', __('Continue reading link text ','mantra') , 'setting_excerptcont_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerpttags', __('HTML tags in Excerpts','mantra') , 'setting_excerpttags_fn', __FILE__, 'excerpt_section');

	add_settings_field('mantra_fpost', __('Featured Images as POST Thumbnails ','mantra') , 'setting_fpost_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fauto', __('Auto Select Images From Posts ','mantra') , 'setting_fauto_fn', __FILE__, 'featured_section'); 
	add_settings_field('mantra_falign', __('Thumbnails Alignment ','mantra') , 'setting_falign_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fsize', __('Thumbnails Size ','mantra') , 'setting_fsize_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fheader', __('Featured Images as HEADER Images ','mantra') , 'setting_fheader_fn', __FILE__, 'featured_section');

	add_settings_field('mantra_socials1', __('Link nr. 1','mantra') , 'setting_socials1_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials2', __('Link nr. 2','mantra') , 'setting_socials2_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials3', __('Link nr. 3','mantra') , 'setting_socials3_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials4', __('Link nr. 4','mantra') , 'setting_socials4_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials5', __('Link nr. 5','mantra') , 'setting_socials5_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socialshow', __('Socials display','mantra') , 'setting_socialsdisplay_fn', __FILE__, 'socials_section');

	add_settings_field('mantra_linkheader', __('Make Site Header a Link','mantra') , 'setting_linkheader_fn', __FILE__, 'misc_section');
	add_settings_field('mantra_favicon', __('FavIcon','mantra') , 'setting_favicon_fn', __FILE__, 'misc_section');
	add_settings_field('mantra_customcss', __('Custom CSS','mantra') , 'setting_customcss_fn', __FILE__, 'misc_section');

}

// Adding the mantra subpage
function mantra_add_page_fn() {
$page = add_theme_page('Mantra Settings', 'Mantra Settings', 'edit_theme_options', 'mantra-page', 'mantra_page_fn');
/*$page2 = add_theme_page('Layout', '&nbsp;&nbsp; - Layout', 'edit_theme_options', 'mantra-layout', 'mantra_page_fn');
$page3 = add_theme_page('Text', '&nbsp;&nbsp; - Text', 'edit_theme_options', 'mantra-text', 'mantra_page_fn');
$page4 = add_theme_page('Colors', '&nbsp;&nbsp; - Colors', 'edit_theme_options', 'mantra-colors', 'mantra_page_fn');
$page5 = add_theme_page('Graphics', '&nbsp;&nbsp; - Graphics', 'edit_theme_options', 'mantra-graphics', 'mantra_page_fn');
$page5 = add_theme_page('Post_Social', '&nbsp;&nbsp; - Post and Social', 'edit_theme_options', 'mantra-post', 'mantra_page_fn');*/
	add_action( 'admin_print_styles-'.$page, 'mantra_admin_styles' );

}
function mantra_admin_styles() {

	wp_enqueue_style( 'mantra' );
	wp_enqueue_style( 'jqueryui' );
	wp_enqueue_style( 'mantra2' );
}



// ************************************************************************************************************


// Callback functions

// General suboptions description

function  section_layout_fn() {

//	echo "<p>".__("Settings for adjusting your blog's layout.", "mantra")."</p>";
}

function  section_presentation_fn() {

//	echo "<p>".__("Settings for adjusting your blog's layout.", "mantra")."</p>";
}


function  section_text_fn() {
	//echo "<p>".__("All text related customization options.", "mantra")."</p>";
}

function  section_graphics_fn() {
//	echo "<p>".__("Settings for hiding or showing different graphics.", "mantra")."</p>";
}

function  section_post_fn() {
	//echo "<p>".__("Settings for hiding or showing different post tags.", "mantra")."</p>";
}

function  section_excerpt_fn() {
//	echo "<p>".__("Settings for post excerpts", "mantra")."</p>";
}

function  section_appereance_fn() {
//	echo "<p>".__("Set text and background colors.", "mantra")."</p>";
}


function  section_featured_fn() {
//	echo "<p>".__("Insert the addreses for your social media. Leave blank if not the case.
//	Please type the whole address (including <i>http://</i> ) Example : <u>http://www.facebook.com</u>.", "mantra")."</p>";
}

function  section_social_fn() {
//	echo "<p>".__("Insert the addreses for your social media. Leave blank if not the case.
//	Please type the whole address (including <i>http://</i> ) Example : <u>http://www.facebook.com</u>.", "mantra")."</p>";
}

function  misc_social_fn() {

}





////////////////////////////////
//// LAYOUT SETTINGS ///////////
////////////////////////////////


// RADIO-BUTTON - Name: ma_options[side]
function setting_side_fn() {
global $mantra_options;
	$items = array("1c", "2cSr", "2cSl", "3cSr" , "3cSl", "3cSs");
	$layout_text["1c"] = __("One column (no sidebars)","mantra");
	$layout_text["2cSr"] = __("Two columns,  sidebar on the right","mantra");
	$layout_text["2cSl"] = __("Two columns,  sidebar on the left","mantra");
	$layout_text["3cSr"] = __("Three columns, sidebars on the right","mantra");
	$layout_text["3cSl"] = __("Three columns, sidebars on the left","mantra");
	$layout_text["3cSs"] = __("Three columns, one sidebar on each side","mantra");

// For backward compatibility;
	if ($mantra_options['mantra_side'] == 'Disable') $mantra_options['mantra_side'] = '1c';
	if ($mantra_options['mantra_side'] == 'Right') $mantra_options['mantra_side'] = '2cSr';
	if ($mantra_options['mantra_side'] == 'Left') $mantra_options['mantra_side'] = '2cSl';


	foreach($items as $item) {

		$checkedClass = ($mantra_options['mantra_side']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='layouts  $checkedClass'><input ";
		checked($mantra_options['mantra_side'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','layouts');\" name='ma_options[mantra_side]' type='radio' /><img src='".get_template_directory_uri()."/admin/images/".$item.".png'/><span> $layout_text[$item]</span></label>";
	}
		echo "<div><small>".__("Choose your layout ","mantra")."</small></div>";
}



 //SLIDER - Name: ma_options[sidewidth]
function setting_sidewidth_fn()
   {
global $mantra_options;
	$items = array ("Absolute" , "Relative");
	$itemsare = array( __("Absolute","mantra"), __("Relative","mantra"));
	echo "Use <select id='mantra_dimselect' name='ma_options[mantra_dimselect]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_dimselect'],$item);
	echo ">$itemsare[$id]</option>";
}
echo "</select> dimmensions";

   ?><script>

	jQuery(function() {

		jQuery( "#slider-range" ).slider({
			range: true,
			step:10,
			min: 0,
			max: 1980,
			values: [ <?php echo $mantra_options['mantra_sidewidth'] ?>, <?php echo ($mantra_options['mantra_sidewidth']+$mantra_options['mantra_sidebar']); ?> ],
			slide: function( event, ui ) {
		
											}
	
										});

			jQuery( "#mantra_sidewidth" ).val( <?php echo $mantra_options['mantra_sidewidth'];?> );
			jQuery( "#mantra_sidebar" ).val( <?php echo $mantra_options['mantra_sidebar'];?> );
	var	percentage =parseInt(	jQuery( "#slider-range .ui-slider-range" ).css('width'));
	var leftwidth =	parseInt(jQuery( "#slider-range .ui-slider-range" ).position().left);
			jQuery( "#barb" ).css('left',150+leftwidth+percentage/2+"px");
			jQuery( "#contentb" ).css('left',210+leftwidth/2+"px");
			jQuery( "#totalb" ).css('left',100+(percentage+leftwidth)/2+"px");
							});

		jQuery( "#slider-range" ).bind( "slide", function(event, ui) {
			range=ui.values[ 1 ] - ui.values[ 0 ];

 			if (ui.values[ 0 ]<500) {ui.values[ 0 ]=500; return false;};
			if(	range<220 || range>800 ){ ui.values[ 1 ] =  <?php echo $mantra_options['mantra_sidebar']+$mantra_options['mantra_sidewidth'];?>; return false;  };			
																	
			jQuery( "#mantra_sidewidth" ).val( ui.values[ 0 ] );
			jQuery( "#mantra_sidebar" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
			jQuery( "#totalsize" ).html( ui.values[ 1 ]);
			jQuery( "#contentsize" ).html( ui.values[ 0 ]);jQuery( "#barsize" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

	var	percentage =parseInt(	jQuery( "#slider-range .ui-slider-range" ).css('width'));
	var leftwidth =	parseInt(jQuery( "#slider-range .ui-slider-range" ).position().left);
			jQuery( "#barb" ).css('left',180+leftwidth+percentage/2+"px");
			jQuery( "#contentb" ).css('left',220+leftwidth/2+"px");	
			jQuery( "#totalb" ).css('left',100+(percentage+leftwidth)/2+"px");
																	});		




jQuery(function() {

		jQuery( "#slider-rangeRel" ).slider({
			range: true,
			step:1,
			min: 0,
			max: 100,
			values: [ <?php echo $mantra_options['mantra_sidewidthRel'] ?>, <?php echo ($mantra_options['mantra_sidewidthRel']+$mantra_options['mantra_sidebarRel']); ?> ],
			slide: function( event, ui ) {
		
											}
	
										});

			jQuery( "#mantra_sidewidthRel" ).val( <?php echo $mantra_options['mantra_sidewidthRel'];?> );
			jQuery( "#mantra_sidebarRel" ).val( <?php echo $mantra_options['mantra_sidebarRel'];?> );
	var	percentageRel =parseInt(	jQuery( "#slider-rangeRel .ui-slider-range" ).css('width'));
	var leftwidthRel =	parseInt(jQuery( "#slider-rangeRel .ui-slider-range" ).position().left);
			jQuery( "#barbRel" ).css('left',150+leftwidthRel+percentageRel/2+"px");
			jQuery( "#contentbRel" ).css('left',210+leftwidthRel/2+"px");
			jQuery( "#totalbRel" ).css('left',100+(percentageRel+leftwidthRel)/2+"px");
							});

		jQuery( "#slider-rangeRel" ).bind( "slide", function(event, ui) {
			range=ui.values[ 1 ] - ui.values[ 0 ];

 			if (ui.values[ 0 ]<40) {ui.values[ 0 ]=40; return false;};
			if(	range<20 || range>50 ){ ui.values[ 1 ] =  <?php echo $mantra_options['mantra_sidebarRel']+$mantra_options['mantra_sidewidthRel'];?>; return false;  };			
																	
			jQuery( "#mantra_sidewidthRel" ).val( ui.values[ 0 ] );
			jQuery( "#mantra_sidebarRel" ).val( ui.values[ 1 ] - ui.values[ 0 ] );
			jQuery( "#totalsizeRel" ).html( ui.values[ 1 ]);
			jQuery( "#contentsizeRel" ).html( ui.values[ 0 ]);jQuery( "#barsizeRel" ).html( ui.values[ 1 ]-ui.values[ 0 ]);

	var	percentageRel =parseInt(	jQuery( "#slider-rangeRel .ui-slider-range" ).css('width'));
	var leftwidthRel =	parseInt(jQuery( "#slider-rangeRel .ui-slider-range" ).position().left);
			jQuery( "#barbRel" ).css('left',180+leftwidthRel+percentageRel/2+"px");
			jQuery( "#contentbRel" ).css('left',220+leftwidthRel/2+"px");	
			jQuery( "#totalbRel" ).css('left',100+(percentageRel+leftwidthRel)/2+"px");
																	});	
							
	</script>

<div id="absolutedim">

	<b id="contentb" style="display:block;float:left;position:absolute;margin-top:-20px;">Content = <span id="contentsize"><?php echo $mantra_options['mantra_sidewidth'];?></span>px</b>
	<b id="barb" style="margin-left:40px;color:#F6A828;display:block;float:left;position:absolute;margin-top:-20px;" >Sidebar(s) = <span id="barsize"><?php echo $mantra_options['mantra_sidebar'];?></span>px</b>
	<b id="totalb" style="margin-left:40px;color:#999;display:block;float:left;position:absolute;margin-top:12px;" >^&mdash;&mdash;&mdash; Total width = <span id="totalsize"><?php echo $mantra_options['mantra_sidewidth']+ $mantra_options['mantra_sidebar'];?></span>px &mdash;&mdash;&mdash;^</b>

<p>
	<?php echo  "<input type='hidden'  name='ma_options[mantra_sidewidth]' id='mantra_sidewidth'   />";
	 echo  "<input type='hidden'  name='ma_options[mantra_sidebar]' id='mantra_sidebar'   />";?>
</p>
<div id="slider-range"></div>

 <?php
   echo "<div><small>".__("Select the width of your <b>content</b> and <b>sidebar(s)</b>. 
 		While the content cannot be less than 500px wide, the sidebar area is at least 220px and no more than 800px.<br />
	If you went for a 3 column area ( with 2 sidebars) they will each have half the selected width.","mantra")."</small></div>"; ?>


</div><!-- End absolutedim -->

<div id="relativedim">

	<b id="contentbRel" style="display:block;float:left;position:absolute;margin-top:-20px;">Content = <span id="contentsizeRel"><?php echo $mantra_options['mantra_sidewidthRel'];?></span>%</b>
	<b id="barbRel" style="margin-left:40px;color:#F6A828;display:block;float:left;position:absolute;margin-top:-20px;" >Sidebar(s) = <span id="barsizeRel"><?php echo $mantra_options['mantra_sidebarRel'];?></span>%</b>
	<b id="totalbRel" style="margin-left:40px;color:#999;display:block;float:left;position:absolute;margin-top:12px;" >^&mdash;&mdash;&mdash; Total width = <span id="totalsizeRel"><?php echo $mantra_options['mantra_sidewidthRel']+$mantra_options['mantra_sidebarRel'];?></span>% &mdash;&mdash;&mdash;^</b>

<p>
	<?php echo  "<input type='hidden'  name='ma_options[mantra_sidewidthRel]' id='mantra_sidewidthRel'   />";
	echo  "<input type='hidden'  name='ma_options[mantra_sidebarRel]' id='mantra_sidebarRel'   />";?>

</p>
<div id="slider-rangeRel"></div>
 <?php
   echo "<div><small>".__("Select the width of your <b>content</b> and <b>sidebar(s)</b>. 
 		These are realtive dimmensions - relative to the user's browser. The total width is a percentage of the browser's width.<br />
	 While the content cannot be less than 40% wide, the sidebar area is at least 20% and no more than 50%.<br />
	If you went for a 3 column area ( with 2 sidebars) they will each have half the selected width.","mantra")."</small></div>"; ?>
</div><!-- End relativedim -->
<?php
  
   }




 //SELECT - Name: ma_options[hheight]
function  setting_hheight_fn() {
	global $mantra_options;
	$items =array ("60px","90px", "120px" , "150px" , "180px" , "200px", "240px", "300px","350px", "400px", "450px", "500px");
	echo "<select id='mantra_hheight' name='ma_options[mantra_hheight]'>";
foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_hheight'],$item);
	echo ">$item</option>";
}
	echo "</select>";
$totally = $mantra_options['mantra_sidebar']+$mantra_options['mantra_sidewidth'];
echo "<div><small>".__("Select the header's height. After saving the settings go and upload your new header image. The header's width will be equal to the Total Site Width = ","mantra").$totally."px.</small></div>";
}


////////////////////////////////
//// PRESENTATION SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: ma_options[frontpage]
function setting_frontpage_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_frontpage' name='ma_options[mantra_frontpage]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_frontpage'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the presentation front-page. This will become your new home page and it will replace whatever page you have selected as homepage. It has a slider and columns for presentation
		text and images.","mantra")."</small></div>";

}

//CHECKBOX - Name: ma_options[frontslider]
function setting_frontslider_fn() {
	global $mantra_options;

	echo "<div class='slmini'><b>Slider Dimensions:</b> ";
	echo "<input id='mantra_fpsliderwidth' name='ma_options[mantra_fpsliderwidth]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderwidth'] )."'  /> px (width) <strong>X</strong> ";
	echo "<input id='mantra_fpsliderheight' name='ma_options[mantra_fpsliderheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderheight'] )."'  /> px (height)";
	echo "<small>".__("The dimensions of your slider. Make sure your images are of the same size.","mantra")."</small></div>";


	echo "<div class='slmini'><b>Animation:</b> ";
	$items = array ("random" , "fold", "fade", "slideInRight", "slideInLeft", "sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown" , "sliceUpDownLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow" , "boxRainGrowReverse");
	$itemsare = array( __("Random","mantra"), __("Fold","mantra"), __("Fade","mantra"), __("SlideInRight","mantra"), __("SlideInLeft","mantra"), __("SliceDown","mantra"), __("SliceDownLeft","mantra"), __("SliceUp","mantra"), __("SliceUpLeft","mantra"), __("SliceUpDown","mantra"), __("SliceUpDownLeft","mantra"), __("BoxRandom","mantra"), __("BoxRain","mantra"), __("BoxRainReverse","mantra"), __("BoxRainGrow","mantra"), __("BoxRainGrowReverse","mantra"));
	echo "<select id='mantra_fpslideranim' name='ma_options[mantra_fpslideranim]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpslideranim'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("The transition effect your slider will have.","mantra")."</small></div>";

	echo "<div class='slmini'><b>Animation Time:</b> ";
	echo "<input id='mantra_fpslidertime' name='ma_options[mantra_fpslidertime]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpslidertime'] )."'  /> miliseconds (1000ms = 1 second) ";
	echo "<small>".__("The time in which the transition animation will take place.","mantra")."</small></div>";

	echo "<div class='slmini'><b>Pause Time:</b> ";
	echo "<input id='mantra_fpsliderpause' name='ma_options[mantra_fpsliderpause]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fpsliderpause'] )."'  /> miliseconds (1000ms = 1 second) ";
	echo "<small>".__("The time in which a slide will be still and visible.","mantra")."</small></div>";


	echo "<div class='slmini'><b>Slider navigation:</b> ";
	$items = array ("Numbers" , "Bullets" ,"None");
	$itemsare = array( __("Numbers","mantra"), __("Bullets","mantra"), __("None","mantra"));
	echo "<select id='mantra_fpslidernav' name='ma_options[mantra_fpslidernav]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpslidernav'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("Your slider navigation type. Shown under the slider.","mantra")."</small></div>";

	echo "<div class='slmini'><b>Slider arrows:</b> ";
	$items = array ("Always Visible" , "Visible on Hover" ,"Hidden");
	$itemsare = array( __("Always Visible","mantra"), __("Visible on Hover","mantra"), __("Hidden","mantra"));
	echo "<select id='mantra_fpsliderarrows' name='ma_options[mantra_fpsliderarrows]'>";
	foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpsliderarrows'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<small>".__("The Left and Right arrows on your slider","mantra")."</small></div>";


/*
// The Query
query_posts('' );

// The Loop
while ( have_posts() ) : the_post();
	echo '<li>';
	the_title();
echo get_the_post_thumbnail();
	echo '</li>';
endwhile;

// Reset Query
wp_reset_query();
*/

}

//CHECKBOX - Name: ma_options[frontslider2]
function setting_frontslider2_fn() {
	global $mantra_options;
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var uploadparent = 0;
		var old_send_to_editor = window.send_to_editor;
		var old_tb_remove = window.tb_remove;
		
		jQuery('.upload_image_button').click(function(){
			uploadparent = jQuery(this).closest('.slidebox');
			tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
			return false;
		});
		
		window.tb_remove = function() {
			uploadparent = 0;
			old_tb_remove();
		}
		
		window.send_to_editor = function(html) {
			if(uploadparent){              
				imgurl = jQuery('img',html).attr('src');
				uploadparent.find('.slideimages').attr('value', imgurl);
				tb_remove();
			} else {
				old_send_to_editor();
			}
		}
	});
jQuery('.slidetitle').click(function() {
 
jQuery(this).next().toggle("fast");
});

</script>

<div class="slidebox"> 
<h4 class="slidetitle" > Slide 1 </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_sliderimg1']; ?>" name="ma_options[mantra_sliderimg1]" id="mantra_sliderimg1" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>                                
<h5> Title </h5>
<input id='mantra_slidertitle1' name='ma_options[mantra_slidertitle1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle1'] ) ?>'  />            
<h5> Text </h5>
<textarea id='mantra_slidertext1' name='ma_options[mantra_slidertext1]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_slidertext1'] ?></textarea>
<h5> Link </h5>
<input id='mantra_sliderlink1' name='ma_options[mantra_sliderlink1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_sliderlink1'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > Slide 2 </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_sliderimg2']; ?>" name="ma_options[mantra_sliderimg2]" id="mantra_sliderimg2" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>     
<h5> Title </h5>
<input id='mantra_slidertitle2' name='ma_options[mantra_slidertitle2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle2'] ) ?>'  />                            
<h5> Text </h5>
<textarea id='mantra_slidertext2' name='ma_options[mantra_slidertext2]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_slidertext2'] ?></textarea>
<h5> Link </h5>
<input id='mantra_sliderlink2' name='ma_options[mantra_sliderlink2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_sliderlink2'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > Slide 3 </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_sliderimg3']; ?>" name="ma_options[mantra_sliderimg3]" id="mantra_sliderimg3" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> Title </h5>
<input id='mantra_slidertitle3' name='ma_options[mantra_slidertitle3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle3'] ) ?>'  />                              
<h5> Text </h5>
<textarea id='mantra_slidertext3' name='ma_options[mantra_slidertext3]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_slidertext3'] ?></textarea>
<h5> Link </h5>
<input id='mantra_sliderlink3' name='ma_options[mantra_sliderlink3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_sliderlink3'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > Slide 4 </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_sliderimg4']; ?>" name="ma_options[mantra_sliderimg4]" id="mantra_sliderimg4" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> Title </h5>
<input id='mantra_slidertitle4' name='ma_options[mantra_slidertitle4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle4'] ) ?>'  />                              
<h5> Text </h5>
<textarea id='mantra_slidertext4' name='ma_options[mantra_slidertext4]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_slidertext4'] ?></textarea>
<h5> Link </h5>
<input id='mantra_sliderlink4' name='ma_options[mantra_sliderlink4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_sliderlink4'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" > Slide 5 </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_sliderimg5']; ?>" name="ma_options[mantra_sliderimg5]" id="mantra_sliderimg5" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>
<h5> Title </h5>
<input id='mantra_slidertitle5' name='ma_options[mantra_slidertitle5]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_slidertitle5'] ) ?>'  />                                 
<h5> Text </h5>
<textarea id='mantra_slidertext5' name='ma_options[mantra_slidertext5]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_slidertext5'] ?></textarea>
<h5> Link </h5>
<input id='mantra_sliderlink5' name='ma_options[mantra_sliderlink5]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_sliderlink5'] ) ?>'  />            
</div>
</div>
<?php	echo "<small>".__(" Your slides' content. Only the image is required, all other fields are optional. Only the slides with an image selected will become acitve and visible in the live slider.","mantra")."</small>"; 


?><?php
}

//CHECKBOX - Name: ma_options[frontcolumns]
function setting_frontcolumns_fn() {
	global $mantra_options;

echo "<div id='cdimensions'><b>Image Height:</b> ";
	echo "<input id='mantra_colimageheight' name='ma_options[mantra_colimageheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_colimageheight'] )."'  /> px </div>";


?>
<div class="slidebox"> 
<h4 class="slidetitle" > 1st Column </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_columnimg1']; ?>" name="ma_options[mantra_columnimg1]" id="mantra_columnimg1" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>                                
<h5> Title </h5>
<input id='mantra_columntitle1' name='ma_options[mantra_columntitle1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle1'] ) ?>'  />            
<h5> Text </h5>
<textarea id='mantra_columntext1' name='ma_options[mantra_columntext1]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_columntext1'] ?></textarea>
<h5> Link </h5>
<input id='mantra_columnlink1' name='ma_options[mantra_columnlink1]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columnlink1'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" >  2nd Column </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_columnimg2']; ?>" name="ma_options[mantra_columnimg2]" id="mantra_columnimg2" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>     
<h5> Title </h5>
<input id='mantra_columntitle2' name='ma_options[mantra_columntitle2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle2'] ) ?>'  />                            
<h5> Text </h5>
<textarea id='mantra_columntext2' name='ma_options[mantra_columntext2]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_columntext2'] ?></textarea>
<h5> Link </h5>
<input id='mantra_columnlink2' name='ma_options[mantra_columnlink2]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columnlink2'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" >  3rd Column  </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_columnimg3']; ?>" name="ma_options[mantra_columnimg3]" id="mantra_columnimg3" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> Title </h5>
<input id='mantra_columntitle3' name='ma_options[mantra_columntitle3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle3'] ) ?>'  />                              
<h5> Text </h5>
<textarea id='mantra_columntext3' name='ma_options[mantra_columntext3]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_columntext3'] ?></textarea>
<h5> Link </h5>
<input id='mantra_columnlink3' name='ma_options[mantra_columnlink3]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columnlink3'] ) ?>'  />            
</div>
</div>

<div class="slidebox"> 
<h4 class="slidetitle" >  4th Column  </h4>
<div class="slidercontent">
<h5>Image</h5>
<input type="text" value="<?php echo  $mantra_options['mantra_columnimg4']; ?>" name="ma_options[mantra_columnimg4]" id="mantra_columnimg4" class="slideimages" />
<span class="description"><a href="#" class="upload_image_button"><?php _e( 'Upload or select image from gallery', 'mantra' );?></a> </span>   
<h5> Title </h5>
<input id='mantra_columntitle4' name='ma_options[mantra_columntitle4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columntitle4'] ) ?>'  />                              
<h5> Text </h5>
<textarea id='mantra_columntext4' name='ma_options[mantra_columntext4]' rows='3' cols='50' type='textarea' ><?php echo $mantra_options['mantra_columntext4'] ?></textarea>
<h5> Link </h5>
<input id='mantra_columnlink4' name='ma_options[mantra_columnlink4]' size='50' type='text' value='<?php echo esc_attr( $mantra_options['mantra_columnlink4'] ) ?>'  />            
</div>
</div>

<?php
}



//CHECKBOX - Name: ma_options[fronttext]
function setting_fronttext_fn() {
	global $mantra_options;

echo "<div class='slidebox'><h4 class='slidetitle'> Extra Text </h4><div  class='slidercontent'><h5>Top Title</h5> ";
	echo "<input id='mantra_fronttext1' name='ma_options[mantra_fronttext1]' size='50' type='text' value='".esc_attr( $mantra_options['mantra_fronttext1'] )."'  />";
echo "<h5>Second Title</h5> ";
	echo "<input id='mantra_fronttext2' name='ma_options[mantra_fronttext2]' size='50' type='text' value='".esc_attr( $mantra_options['mantra_fronttext2'] )."'  />";
echo "<h5>Bottom Text 1</h5> ";
	echo "<textarea id='mantra_fronttext3' name='ma_options[mantra_fronttext3]' rows='3' cols='50' type='textarea' >{$mantra_options['mantra_fronttext3']}  </textarea>";
echo "<h5>Bottom Text 2 </h5> ";
		echo "<textarea id='mantra_fronttext4' name='ma_options[mantra_fronttext4]' rows='3' cols='50' type='textarea' >{$mantra_options['mantra_fronttext4']}  </textarea></div></div>";

echo "<div><small>".__("More text for your front page. The top title is above the slider, the second title between the slider and the columns and 2 more rows of text under the columns.
		 It's all optional so leave any input field empty if it's not required. ","mantra")."</small></div>";




echo "<br /><div class='slidebox'><h4 class='slidetitle'> Hide areas </h4><div  class='slidercontent'>";


		$items = array( "FronHeader", "FrontMenu", "FrontWidget" , "FrontFooter","FrontBack");

		$checkedClass0 = ($mantra_options['mantra_fronthideheader']=='1') ? ' checkedClass0' : '';
		$checkedClass1 = ($mantra_options['mantra_fronthidemenu']=='1') ? ' checkedClass1' : '';
		$checkedClass2 = ($mantra_options['mantra_fronthidewidget']=='1') ? ' checkedClass2' : '';
		$checkedClass3 = ($mantra_options['mantra_fronthidefooter']=='1') ? ' checkedClass3' : '';
		$checkedClass4 = ($mantra_options['mantra_fronthideback']=='1') ? ' checkedClass4' : '';

		echo " <label id='$items[0]' for='$items[0]$items[0]' class='hideareas $checkedClass0'><input  ";
		 checked($mantra_options['mantra_fronthideheader'],'1');
	echo "value='1' id='$items[0]$items[0]'  name='ma_options[mantra_fronthideheader]' type='checkbox' /> Hide the header area (image or background color). </label>";

		echo " <label id='$items[1]' for='$items[1]$items[1]' class='hideareas $checkedClass1'><input  ";
		 checked($mantra_options['mantra_fronthidemenu'],'1');
	echo "value='1' id='$items[1]$items[1]'  name='ma_options[mantra_fronthidemenu]' type='checkbox' /> Hide the main menu (the top navigation tabs). </label>";

		echo " <label id='$items[2]' for='$items[2]$items[2]' class='hideareas $checkedClass2'><input  ";
		 checked($mantra_options['mantra_fronthidewidget'],'1');
	echo "value='1' id='$items[2]$items[2]'  name='ma_options[mantra_fronthidewidget]' type='checkbox' /> Hide the footer widgets.</label>";

		echo " <label id='$items[3]' for='$items[3]$items[3]' class='hideareas $checkedClass3'><input  ";
		 checked($mantra_options['mantra_fronthidefooter'],'1');
	echo "value='1' id='$items[3]$items[3]'  name='ma_options[mantra_fronthidefooter]' type='checkbox' /> Hide the footer (copyright area) </label>";

	echo " <label id='$items[4]' for='$items[4]$items[4]' class='hideareas $checkedClass4'><input  ";
		 checked($mantra_options['mantra_fronthideback'],'1');
	echo "value='1' id='$items[4]$items[4]'  name='ma_options[mantra_fronthideback]' type='checkbox' /> Hide the white color. Only the background color remains. </label>";
		

echo "</div></div>";		
		echo "<div><p><small>".__(" Choose the areas to hide on the first page.","mantra")."</small></p></div>";










}




////////////////////////////////
//// TEXT SETTINGS /////////////
////////////////////////////////

//SELECT - Name: ma_options[fontsize]
function  setting_fontsize_fn() {
	global $mantra_options;
	$items =array ("12px", "13px" , "14px" , "15px" , "16px", "17px", "18px");
	echo "<select id='mantra_fontsize' name='ma_options[mantra_fontsize]'>";
		foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Select the font size you'll use in your blog. Pages, posts and comments will be affected. Buttons, Headers and Side menus will remain the same.","mantra")."</small></div>";
}


//SELECT - Name: ma_options[fontfamily]
function  setting_fontfamily_fn() {
	global $mantra_options;
	global $itemsans, $itemserif, $itemsmono, $itemscursive;

	echo "<select id='mantra_fontfamily' name='ma_options[mantra_fontfamily]'>";
	echo "<optgroup label='Sans-Serif'>";
foreach($itemsans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($itemserif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($itemsmono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($itemscursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontfamily'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you'll use in your blog. All content text will be affected (including menu buttons).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[fonttitle]
function  setting_fonttitle_fn() {
	global $mantra_options;
	global $itemsans, $itemserif, $itemsmono, $itemscursive;

	echo "<select id='mantra_fonttitle' name='ma_options[mantra_fonttitle]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($itemsans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($itemserif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($itemsmono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($itemscursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fonttitle'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want for your titles. It will affect post titles and page titles. Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";
}

//SELECT - Name: ma_options[fontside]
function  setting_fontside_fn() {
	global $mantra_options;
	global $itemsans, $itemserif, $itemsmono, $itemscursive;

	echo "<select id='mantra_fontside' name='ma_options[mantra_fontside]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($itemsans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($itemserif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($itemsmono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($itemscursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontside'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want your sidebar(s) to have. Text in sidebars will be affected, including any widgets. Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";
}


//SELECT - Name: ma_options[fontsubheader]
function  setting_fontsubheader_fn() {
	global $mantra_options;
	global $itemsans, $itemserif, $itemsmono, $itemscursive;

	echo "<select id='mantra_fontsubheader' name='ma_options[mantra_fontsubheader]'>";
	echo "<option value='Default'";
	selected($mantra_options['mantra_fonttitle'],'Defaut');
	echo ">Default</option>";
	echo "<optgroup label='Sans-Serif'>";
foreach($itemsans as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Serif'>";
foreach($itemserif as $item) {

	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='MonoSpace'>";
foreach($itemsmono as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";

	echo "<optgroup label='Cursive'>";
foreach($itemscursive as $item) {
	echo "<option style='font-family:$item;' value='$item'";
	selected($mantra_options['mantra_fontsubheader'],$item);
	echo ">$item</option>";
}
	echo "</optgroup>";
	echo "</select>";
	echo "<div><small>".__("Select the font family you want your subheaders to have (h2 - h6 tags will be affected). Leave 'Default' and the general font you selected will be used.","mantra")."</small></div>";
}

//SELECT - Name: ma_options[headfontsize]
function  setting_headfontsize_fn() {
	global $mantra_options;
	$items = array ("Default" , "14px" , "16px" , "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px");
	$itemsare = array( __("Default","mantra") ,"14px" , "16px" , "18px" , "20px", "22px" , "24px" , "26px" , "28px" , "30px" , "32px" , "34px" , "36px", "38px" , "40px");
	echo "<select id='mantra_headfontsize' name='ma_options[mantra_headfontsize]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_headfontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Post Header Font size. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[sidefontsize]
function  setting_sidefontsize_fn() {
	global $mantra_options;
	$items = array ("Default" , "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px");
	$itemsare = array( __("Default","mantra") , "8px" , "9px" , "10px" , "11px", "12px" , "13px" , "14px" , "15px" , "16px" , "17px" , "18px");
	echo "<select id='mantra_sidefontsize' name='ma_options[mantra_sidefontsize]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_sidefontsize'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Sidebar Font size. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[textalign]
function  setting_textalign_fn() {
	global $mantra_options;
	$items = array ("Default" , "Left" , "Right" , "Justify" , "Center");
	$itemsare = array( __("Default","mantra"), __("Left","mantra"), __("Right","mantra"), __("Justify","mantra"), __("Center","mantra"));
	echo "<select id='mantra_textalign' name='ma_options[mantra_textalign]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_textalign'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("This overwrites the text alignment in posts and pages. Leave 'Default' for normal settings (alignment will remain as declared in posts, comments etc.).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[parindent]
function  setting_parindent_fn() {
	global $mantra_options;
	$items = array ("0px" , "5px" , "10px" , "15px" , "20px");
	echo "<select id='mantra_parindent' name='ma_options[mantra_parindent]'>";
foreach($items as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_parindent'],$item);
	echo ">$item</option>";
}
	echo "</select>";
	echo "<div><small>".__("Choose the indent for your paragraphs.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[headerindent]
function setting_headerindent_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_headerindent' name='ma_options[mantra_headerindent]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_headerindent'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Disable the default header and title indent (left margin).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[lineheight]
function  setting_lineheight_fn() {
	global $mantra_options;
	$items = array ("Default" ,"0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em");
	$itemsare = array( __("Default","mantra"),"0.8em" , "0.9em", "1.0em" , "1.1em" , "1.2em" , "1.3em", "1.4em" , "1.5em" , "1.6em" , "1.7em" , "1.8em" , "1.9em" , "2.0em");
	echo "<select id='mantra_lineheight' name='ma_options[mantra_lineheight]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_lineheight'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Text line height. The height between 2 rows of text. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[wordspace]
function  setting_wordspace_fn() {
	global $mantra_options;
	$items = array ("Default" ,"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px");
	$itemsare = array( __("Default","mantra"),"-3px" , "-2px", "-1px" , "0px" , "1px" , "2px", "3px" , "4px" , "5px" , "10px");
	echo "<select id='mantra_wordspace' name='ma_options[mantra_wordspace]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_wordspace'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The space between <i>words</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}

//SELECT - Name: ma_options[letterspace]
function  setting_letterspace_fn() {
	global $mantra_options;
	$items = array ("Default" ,"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em");
	$itemsare = array( __("Default","mantra"),"-0.05em" , "-0.04em", "-0.03em" , "-0.02em" , "-0.01em" , "0.01em", "0.02em" , "0.03em" , "0.04em" , "0.05em");
	echo "<select id='mantra_letterspace' name='ma_options[mantra_letterspace]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_letterspace'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The space between <i>letters</i>. Leave 'Default' for normal settings (size value will be as set in the CSS).","mantra")."</small></div>";
}



//CHECKBOX - Name: ma_options[textshadow]
function setting_textshadow_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_textshadow' name='ma_options[mantra_textshadow]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_textshadow'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Disable the default text shadow on headers and titles.","mantra")."</small></div>";
}

////////////////////////////////
//// APPEREANCE SETTINGS ///////
////////////////////////////////

//TEXT - Name: ma_options[backcolor]
function  setting_backcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_backcolor" name="ma_options[mantra_backcolor]" value="'.esc_attr( $mantra_options['mantra_backcolor'] ).'"  />';
    echo '<div id="mantra_backcolor2"></div>';
	echo "<div><small>".__("Background color (Default value is 444444).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headercolor]
function  setting_headercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headercolor" name="ma_options[mantra_headercolor]" value="'.esc_attr( $mantra_options['mantra_headercolor'] ).'"  />';
	echo '<div id="mantra_headercolor2"></div>';
	echo "<div><small>".__("Header background color (Default value is 333333). You can delete all inside text for no background color.","mantra")."</small></div>";
}

//TEXT - Name: ma_options[prefootercolor]
function  setting_prefootercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_prefootercolor" name="ma_options[mantra_prefootercolor]" value="'.esc_attr( $mantra_options['mantra_prefootercolor'] ).'"  />';
	echo '<div id="mantra_prefootercolor2"></div>';
	echo "<div><small>".__("Footer widget-area background color. (Default value is 171717).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footercolor]
function  setting_footercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footercolor" name="ma_options[mantra_footercolor]" value="'.esc_attr( $mantra_options['mantra_footercolor'] ).'"  />';
	echo '<div id="mantra_footercolor2"></div>';
	echo "<div><small>".__("Footer background color (Default value is 222222).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[titlecolor]
function  setting_titlecolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_titlecolor" name="ma_options[mantra_titlecolor]" value="'.esc_attr( $mantra_options['mantra_titlecolor'] ).'"  />';
	echo '<div id="mantra_titlecolor2"></div>';
	echo "<div><small>".__("Your blog's title color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[descriptioncolor]
function  setting_descriptioncolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_descriptioncolor" name="ma_options[mantra_descriptioncolor]" value="'.esc_attr( $mantra_options['mantra_descriptioncolor'] ).'"  />';
	echo '<div id="mantra_descriptioncolor2"></div>';
	echo "<div><small>".__("Your blog's description color(Default value is 222222).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[contentcolor]
function  setting_contentcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_contentcolor" name="ma_options[mantra_contentcolor]" value="'.esc_attr( $mantra_options['mantra_contentcolor'] ).'"  />';
	echo '<div id="mantra_contentcolor2"></div>';
	echo "<div><small>".__("Content Text Color (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[linkscolor]
function  setting_linkscolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_linkscolor" name="ma_options[mantra_linkscolor]" value="'.esc_attr( $mantra_options['mantra_linkscolor'] ).'"  />';
	echo '<div id="mantra_linkscolor2"></div>';
	echo "<div><small>".__("Links color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[hovercolor]
function  setting_hovercolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_hovercolor" name="ma_options[mantra_hovercolor]" value="'.esc_attr( $mantra_options['mantra_hovercolor'] ).'"  />';
	echo '<div id="mantra_hovercolor2"></div>';
	echo "<div><small>".__("Links color on mouse over (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headtextcolor]
function  setting_headtextcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headtextcolor" name="ma_options[mantra_headtextcolor]" value="'.esc_attr( $mantra_options['mantra_headtextcolor'] ).'"  />';
	echo '<div id="mantra_headtextcolor2"></div>';
	echo "<div><small>".__("Post Header Text Color (Default value is 333333).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[headtexthover]
function  setting_headtexthover_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_headtexthover" name="ma_options[mantra_headtexthover]" value="'.esc_attr( $mantra_options['mantra_headtexthover'] ).'"  />';
	echo '<div id="mantra_headtexthover2"></div>';
	echo "<div><small>".__("Post Header Text Color on Mouse over (Default value is 000000).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[sideheadbackcolor]
function  setting_sideheadbackcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_sideheadbackcolor" name="ma_options[mantra_sideheadbackcolor]" value="'.esc_attr( $mantra_options['mantra_sideheadbackcolor'] ).'"  />';
	echo '<div id="mantra_sideheadbackcolor2"></div>';
	echo "<div><small>".__("Sidebar Header Background color (Default value is 444444).","mantra")."</small></div>";

}

//TEXT - Name: ma_options[sideheadtextcolor]
function  setting_sideheadtextcolor_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_sideheadtextcolor" name="ma_options[mantra_sideheadtextcolor]" value="'.esc_attr( $mantra_options['mantra_sideheadtextcolor'] ).'"  />';
	echo '<div id="mantra_sideheadtextcolor2"></div>';
	echo "<div><small>".__("Sidebar Header Text Color(Default value is 2EA5FD).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footerheader]
function  setting_footerheader_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footerheader" name="ma_options[mantra_footerheader]" value="'.esc_attr( $mantra_options['mantra_footerheader'] ).'"  />';
	echo '<div id="mantra_footerheader2"></div>';
	echo "<div><small>".__("Footer Widget Text Color (Default value is 0D85CC).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footertext]
function  setting_footertext_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footertext" name="ma_options[mantra_footertext]" value="'.esc_attr( $mantra_options['mantra_footertext'] ).'"  />';
	echo '<div id="mantra_footertext2"></div>';
	echo "<div><small>".__("Footer Widget Link Color (Default value is 666666).","mantra")."</small></div>";
}

//TEXT - Name: ma_options[footerhover]
function  setting_footerhover_fn() {
	global $mantra_options;
	echo '<input type="text" id="mantra_footerhover" name="ma_options[mantra_footerhover]" value="'.esc_attr( $mantra_options['mantra_footerhover'] ).'"  />';
	echo '<div id="mantra_footerhover2"></div>';
	echo "<div><small>".__("Footer Widget Link Color on Mouse Over (Default value is 888888).","mantra")."</small></div>";
}


////////////////////////////////
//// GRAPHICS SETTINGS /////////
////////////////////////////////

//SELECT - Name: ma_options[caption]
function  setting_caption_fn() {
global $mantra_options;
	$items = array ("White" , "Light" , "Light Gray" , "Gray" , "Dark Gray" , "Black");
	$itemsare = array( __("White","mantra"), __("Light","mantra"), __("Light Gray","mantra"), __("Gray","mantra"), __("Dark Gray","mantra"), __("Black","mantra"));
	echo "<select id='mantra_caption' name='ma_options[mantra_caption]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_caption'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("This setting changes the look of your captions. Images that are not inserted through captions will not be affected.","mantra")."</small></div>";
}

// RADIO-BUTTON - Name: ma_options[image]
function setting_image_fn() {
	global $mantra_options;
	$items = array("None", "One", "Two", "Three" , "Four", "Five", "Six", "Seven");
	foreach($items as $item) {
		
		$checkedClass = ($mantra_options['mantra_image']==$item) ? ' checkedClass' : '';
	
		echo " <label id='$item' for='$item$item' class='images $checkedClass'><input  ";
		 checked($mantra_options['mantra_image'],$item);
	echo "value='$item' id='$item$item' onClick=\"changeBorder('$item','images');\" name='ma_options[mantra_image]' type='radio' /><img id='image$item'  src='".get_template_directory_uri()."/admin/images/testimg.png'/></label>";
	}
		
		echo "<div><br /><p><small>".__("The border around your inserted images. ","mantra")."</small></p></div>";
}

// RADIO-BUTTON - Name: ma_options[pin]
function setting_pin_fn() {
global $mantra_options;
	$items = array("mantra_dot", "Pin1", "Pin2", "Pin3" , "Pin4", "Pin5");
	foreach($items as $item) {
		$none='';
		if ($item == 'mantra_dot') { $none='None'; }
		$checkedClass = ($mantra_options['mantra_pin']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='pins  $checkedClass'><input ";
		checked($mantra_options['mantra_pin'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','pins');\" name='ma_options[mantra_pin]' type='radio' />$none<img style='margin-left:10px;margin-right:10px;' src='".get_template_directory_uri()."/images/pins/".$item.".png'/></label>";
	}
		echo "<div><small>".__("The image on top of your captions. ","mantra")."</small></div>";
}

// RADIO-BUTTON - Name: ma_options[sidebullet]
function setting_sidebullet_fn() {
	global $mantra_options;
	$items = array("mantra_dot2", "arrow_black", "arrow_white", "bullet_dark" , "bullet_gray", "bullet_light", "square_dark", "square_white", "triangle_dark" , "triangle_gray", "triangle_white", "folder_black", "folder_light");
	foreach($items as $item) {
		$none='';
		if ($item == 'mantra_dot2') { $none='None'; }
		$checkedClass = ($mantra_options['mantra_sidebullet']==$item) ? ' checkedClass' : '';
		echo "<label id='$item' class='sidebullets  $checkedClass'><input ";
		checked($mantra_options['mantra_sidebullet'],$item);
		echo " value='$item' onClick=\"changeBorder('$item','sidebullets');\" name='ma_options[mantra_sidebullet]' type='radio' />$none<img style='margin-left:10px;margin-right:10px;' src='".get_template_directory_uri()."/images/bullets/".$item.".png'/></label>";
	}
	echo "<div><small>".__("The sidebar list bullets. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[metaback]
function setting_metaback_fn() {
	global $mantra_options;
	$items = array ("Gray" , "White", "None");
	$itemsare = array( __("Gray","mantra"), __("White","mantra"), __("None","mantra"));
	echo "<select id='mantra_metaback' name='ma_options[mantra_metaback]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_metaback'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("The background for your post-metas area (under your post tiltes). Gray by default.<","mantra")."</small></div>";

}

//CHECKBOX - Name: ma_options[contentlist]
function setting_contentlist_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_contentlist' name='ma_options[mantra_contentlist]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_contentlist'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show  bullets next to lists that are in your content area (posts, pages etc.).","mantra")."</small></div>";

}


//CHECKBOX - Name: ma_options[title]
function setting_title_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_title' name='ma_options[mantra_title]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_title'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show your blog's Title and Description in the header (recommended if you have a custom header image with text).","mantra")."</small></div>";

}
//CHECKBOX - Name: ma_options[pagetitle]
function setting_pagetitle_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_pagetitle' name='ma_options[mantra_pagetitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_pagetitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show Page titles on any <i>created</i> pages. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[categtitle]
function setting_categtitle_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_categtitle' name='ma_options[mantra_categtitle]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_categtitle'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show Page titles on <i>Category</i> Pages. ","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[tables]
function setting_tables_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_tables' name='ma_options[mantra_tables]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_tables'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide table borders and background color.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[comtext]
function setting_comtext_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_comtext' name='ma_options[mantra_comtext]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comtext'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the explanatory text under the comments form. (starts with  <i>You may use these HTML tags and attributes:...</i>).","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[comclosed]
function setting_comclosed_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide in posts", "Hide in pages", "Hide everywhere");
	$itemsare = array( __("Show","mantra"), __("Hide in posts","mantra"), __("Hide in pages","mantra"), __("Hide everywhere","mantra"));
	echo "<select id='mantra_comclosed' name='ma_options[mantra_comclosed]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comclosed'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the  <b>Comments are closed</b> text that by default shows up on pages or posts with the comments disabled.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[comoff]
function setting_comoff_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_comoff' name='ma_options[mantra_comoff]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_comoff'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the <b>Comments off</b> text next to posts that have comments disabled.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[backtop]
function setting_backtop_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_backtop' name='ma_options[mantra_backtop]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_backtop'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Back to Top button. The button appears after scrolling the page down.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[copyright]
function setting_copyright_fn() {
	global $mantra_options;
	echo "<textarea id='mantra_copyright' name='ma_options[mantra_copyright]' rows='3' cols='40' type='textarea' >{$mantra_options['mantra_copyright']}  </textarea>";
	echo "<div><small>".__("Insert custom text or HTML code that will appear last in you footer. <br /> You can use HTML to insert links, images and special characters like &copy .","mantra")."</small></div>";
}


////////////////////////////////
//// POST SETTINGS /////////////
////////////////////////////////

//CHECKBOX - Name: ma_options[postdate]
function setting_postdate_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postdate' name='ma_options[mantra_postdate]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postdate'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post date.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[posttime]
function setting_posttime_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_posttime' name='ma_options[mantra_posttime]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_posttime'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show the post time with the date. Time will not be visible if the Post Date is hidden.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postauthor]
function setting_postauthor_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postauthor' name='ma_options[mantra_postauthor]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postauthor'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide or show the post author.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postcateg]
function setting_postcateg_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postcateg' name='ma_options[mantra_postcateg]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postcateg'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post category.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[posttag]
function setting_posttag_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_posttag' name='ma_options[mantra_posttag]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_posttag'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the post tags.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postbook]
function setting_postbook_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postbook' name='ma_options[mantra_postbook]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postbook'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide the 'Bookmark permalink'.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[postmetas]
function setting_postmetas_fn() {
	global $mantra_options;
	$items = array ("Show" , "Hide");
	$itemsare = array( __("Show","mantra"), __("Hide","mantra"));
	echo "<select id='mantra_postmetas' name='ma_options[mantra_postmetas]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_postmetas'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Hide all the post metas. All meta info and meta areas will be hidden.","mantra")."</small></div>";
}


////////////////////////////////
//// EXCERPT SETTINGS /////////////
////////////////////////////////


//CHECKBOX - Name: ma_options[excerpthome]
function setting_excerpthome_fn() {
	global $mantra_options;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","mantra"), __("Full Post","mantra"));
	echo "<select id='mantra_excerpthome' name='ma_options[mantra_excerpthome]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerpthome'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on the main page. Only standard posts will be affected. All other post formats (aside, image, chat, quote etc.) have their specific formating.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[excerptarchive]
function setting_excerptarchive_fn() {
	global $mantra_options;
	$items = array ("Excerpt" , "Full Post");
	$itemsare = array( __("Excerpt","mantra"), __("Full Post","mantra"));
	echo "<select id='mantra_excerptarchive' name='ma_options[mantra_excerptarchive]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerptarchive'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Excerpts on archive, categroy and search pages. Same as above, only standard posts will be affected.","mantra")."</small></div>";
}


// TEXTBOX - Name: ma_options[excerptwords]
function setting_excerptwords_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptwords' name='ma_options[mantra_excerptwords]' size='6' type='text' value='".esc_attr( $mantra_options['mantra_excerptwords'] )."'  />";
	echo "<div><small>".__("The number of words an excerpt will have. When that number is reached the post will be interrupted by a <i>Continue reading</i> link that
							will take the reader to the full post page.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[magazinelayout]
function setting_magazinelayout_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_magazinelayout' name='ma_options[mantra_magazinelayout]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_magazinelayout'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Enable the Magazine Layout. This layout applies to pages with posts and shows 2 posts per row.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[excerptdots]
function setting_excerptdots_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptdots' name='ma_options[mantra_excerptdots]' size='40' type='text' value='".esc_attr( $mantra_options['mantra_excerptdots'] )."'  />";
	echo "<div><small>".__("Replaces the three dots ('[...])' that are appended automatically to excerpts.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[excerptcont]
function setting_excerptcont_fn() {
	global $mantra_options;
	echo "<input id='mantra_excerptcont' name='ma_options[mantra_excerptcont]' size='40' type='text' value='".esc_attr( $mantra_options['mantra_excerptcont'] )."'  />";
	echo "<div><small>".__("Edit the 'Continue Reading' link added to your post excerpts.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[excerpttags]
function setting_excerpttags_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_excerpttags' name='ma_options[mantra_excerpttags]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_excerpttags'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("By default WordPress excerpts remove all HTML tags (".htmlspecialchars('<pre>, <a>, <b>')." and all others) and only clean text is left in the excerpt. 
Enabling this option allows HTML tags to remain in excerpts so all your default formating will be kept.<br /> <b>Just a warning: </b>If HTML tags are enabled, you have to make sure 
they are not left open. So if within your post you have an opened HTML tag but the except ends before that tag closes, the rest of the site will be contained in that HTML tag. -- Leave 'Disable' if unsure -- ","mantra")."</small></div>";
}


////////////////////////////////
/// FEATURED IMAGE SETTINGS ////
////////////////////////////////


//CHECKBOX - Name: ma_options[fpost]
function setting_fpost_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fpost' name='ma_options[mantra_fpost]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fpost'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show featured images as thumbnails on posts. The images must be selected for each post in the Featured Image section.","mantra")."</small></div>";
}

//CHECKBOX - Name: ma_options[fauto]
function setting_fauto_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fauto' name='ma_options[mantra_fauto]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fauto'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show the first image that you inserted in a post as a thumbnail. If you enable this option, the first image in your post will be used even if you selected a Featured Image in you post.","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[falign]
function setting_falign_fn() {
	global $mantra_options;
	$items = array ("Left" , "Center", "Right");
	$itemsare = array( __("Left","mantra"), __("Center","mantra"), __("Right","mantra"));
	echo "<select id='mantra_falign' name='ma_options[mantra_falign]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_falign'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Thumbnail alignment.","mantra")."</small></div>";
}


// TEXTBOX - Name: ma_options[fwidth]
function setting_fsize_fn() {
	global $mantra_options;
	echo "<input id='mantra_fwidth' name='ma_options[mantra_fwidth]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fwidth'] )."'  />px (width) <b>X</b> ";
	echo "<input id='mantra_fheight' name='ma_options[mantra_fheight]' size='4' type='text' value='".esc_attr( $mantra_options['mantra_fheight'] )."'  />px (height)";
	echo "<div><small>".__("The size you want the thumbnails to have (in pixels).","mantra")."</small></div>";
}


//CHECKBOX - Name: ma_options[fheader]
function setting_fheader_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_fheader' name='ma_options[mantra_fheader]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_fheader'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Show featured images on headers. The header will be replaced with a featured image if you selected it as a Featured Image in the post and
							and if it is bigger or at least equal to the current header size.","mantra")."</small></div>";
}





////////////////////////
/// SOCIAL SETTINGS ////
////////////////////////

// TEXTBOX - Name: ma_options[social1]
function setting_socials1_fn() {
	global $mantra_options, $mantra_global_socials;
	echo "<select id='mantra_social1' name='ma_options[mantra_social1]'>";
foreach($mantra_global_socials as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social1'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";

	echo "<input id='mantra_social2' name='ma_options[mantra_social2]' size='32' type='text'  value='".esc_attr( $mantra_options['mantra_social2'] )."'  />";
	echo "<div><small>".__("Select your desired Social network from the left dropdown menu and insert your corresponding address in the right input field. (ex: <i>http://www.facebook.com/yourname</i> )","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social2]
function setting_socials2_fn() {
	global $mantra_options, $mantra_global_socials;
	echo "<select id='mantra_social3' name='ma_options[mantra_social3]'>";
foreach($mantra_global_socials as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social3'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_tweeter' name='ma_options[mantra_social4]' size='32' type='text'  value='".esc_attr( $mantra_options['mantra_social4'] )."'  />";
	echo "<div><small>".__("You can insert up to 5 different social sites and addresses.","mantra")."</small></div> ";
}

// TEXTBOX - Name: ma_options[social3]
function setting_socials3_fn() {
	global $mantra_options, $mantra_global_socials;
	echo "<select id='mantra_social5' name='ma_options[mantra_social5]'>";
	foreach($mantra_global_socials as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social5'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social6]' size='32' type='text'  value='".esc_attr( $mantra_options['mantra_social6'] )."'  />";
	echo "<div><small>".__("There are a total of 12 social networks to choose from. ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social4]
function setting_socials4_fn() {
	global $mantra_options, $mantra_global_socials;
	echo "<select id='mantra_social7' name='ma_options[mantra_social7]'>";
	foreach($mantra_global_socials as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social7'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social8]' size='32' type='text'  value='".esc_attr( $mantra_options['mantra_social8'] )."'  />";
	echo "<div><small>".__("You can leave any number of inputs empty. ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[social5]
function setting_socials5_fn() {
	global $mantra_options, $mantra_global_socials;
	echo "<select id='mantra_social9' name='ma_options[mantra_social9]'>";
	foreach($mantra_global_socials as $item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_social9'],$item);
	echo ">$item</option>";
}
	echo "</select><span class='address_span'> &raquo; </span>";
	echo "<input id='mantra_rss' name='ma_options[mantra_social10]' size='32' type='text'  value='".esc_attr( $mantra_options['mantra_social10'] )."'  />";
	echo "<div><small>".__("You can choose the same social media any number of times.  ","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[socialsdisplay]
function setting_socialsdisplay_fn() {
global $mantra_options;
		$items = array( "Header", "CLeft", "CRight" , "Footer");

		$checkedClass0 = ($mantra_options['mantra_socialsdisplay0']=='1') ? ' checkedClass0' : '';
		$checkedClass1 = ($mantra_options['mantra_socialsdisplay1']=='1') ? ' checkedClass1' : '';
		$checkedClass2 = ($mantra_options['mantra_socialsdisplay2']=='1') ? ' checkedClass2' : '';
		$checkedClass3 = ($mantra_options['mantra_socialsdisplay3']=='1') ? ' checkedClass3' : '';

		echo " <label id='$items[0]' for='$items[0]$items[0]' class='socialsdisplay $checkedClass0'><input  ";
		 checked($mantra_options['mantra_socialsdisplay0'],'1');
	echo "value='1' id='$items[0]$items[0]'  name='ma_options[mantra_socialsdisplay0]' type='checkbox' /> Top right corner of header </label>";

		echo " <label id='$items[1]' for='$items[1]$items[1]' class='socialsdisplay $checkedClass1'><input  ";
		 checked($mantra_options['mantra_socialsdisplay1'],'1');
	echo "value='1' id='$items[1]$items[1]'  name='ma_options[mantra_socialsdisplay1]' type='checkbox' /> Under menu - left side </label>";

		echo " <label id='$items[2]' for='$items[2]$items[2]' class='socialsdisplay $checkedClass2'><input  ";
		 checked($mantra_options['mantra_socialsdisplay2'],'1');
	echo "value='1' id='$items[2]$items[2]'  name='ma_options[mantra_socialsdisplay2]' type='checkbox' /> Under menu - right side </label>";

		echo " <label id='$items[3]' for='$items[3]$items[3]' class='socialsdisplay $checkedClass3'><input  ";
		 checked($mantra_options['mantra_socialsdisplay3'],'1');
	echo "value='1' id='$items[3]$items[3]'  name='ma_options[mantra_socialsdisplay3]' type='checkbox' /> In the footer (smaller icons) </label>";
		

		
		echo "<div><p><small>".__(" Choose the <b>areas</b> where to display the social icons.","mantra")."</small></p></div>";
}


////////////////////////
/// MISC SETTINGS ////
////////////////////////


//CHECKBOX - Name: ma_options[linkheader]
function setting_linkheader_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_linkheader' name='ma_options[mantra_linkheader]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_linkheader'],$item);
	echo ">$itemsare[$id]</option>";
}
	echo "</select>";
	echo "<div><small>".__("Make the site header into a clickable link that links to your index page.","mantra")."</small></div>";
}

// TEXTBOX - Name: ma_options[favicon]
function setting_favicon_fn() {
	global $mantra_options;
	$items = array ("Enable" , "Disable");
	$itemsare = array( __("Enable","mantra"), __("Disable","mantra"));
	echo "<select id='mantra_faviconshow' name='ma_options[mantra_faviconshow]'>";
foreach($items as $id=>$item) {
	echo "<option value='$item'";
	selected($mantra_options['mantra_faviconshow'],$item);
	echo ">$itemsare[$id]</option>";
}
echo "</select>";
?>

<!-- Upload Button-->
<div id="uploadarea">  
<div id="upload" >Upload File</div><span id="status" ></span>  

<img id="uploadpreview" src="<?php echo get_template_directory_uri().'/uploads/'.$mantra_options['mantra_favicon'] ?>" alt=""  />
<?php
	echo '<p id="filename"> Filename: '.$mantra_options['mantra_favicon'].'</p>';
	echo "<div><small>".__("Upload your Fav Icon<br />Limitations: It has to be an image and it can't be bigger than 20Kb. All uploaded files will 
be found in the <b>mantra/uploads/</b> folder.","mantra")."</small></div>";

?>

<!--List Files-->  
<ul id="files" ></ul> 

<script>

    jQuery(function(){  
        var btnUpload=jQuery('#upload');  
        var status=jQuery('#status');  
        new AjaxUpload(btnUpload, {  
            action: '<?php echo get_template_directory_uri() . "/admin/upload-file.php"; ?>',  
            //Name of the file input box  
            name: 'uploadfile',  
            onSubmit: function(file, ext){  
                if (! (ext && /^(jpg|png|jpeg|gif|ico)$/.test(ext))){  
                      // check for valid file extension  
                  alert('Only ICO, JPG, PNG or GIF files are allowed');  
                    return false;  
                }  
                status.text('Uploading...');  
            },  
            onComplete: function(file, response){  
                //On completion clear the status  
                status.text('');
                //Add uploaded file to list  
                if(response==="success"){  
                    jQuery('#uploadpreview').attr("src", "<?php echo get_template_directory_uri(); ?>/uploads/"+file);
				jQuery('#filename').text('Filename: '+file);
					jQuery('input[id="mantra_favicon"]').val(file); 
                } else{  
					
                     alert (response);   
                }  
            }  
        });  
    });  

</script>
</div>
<input id="mantra_favicon" type="hidden" name='ma_options[mantra_favicon]' value="<?php echo $mantra_options['mantra_favicon'] ?>" />
<?php
}

// TEXTBOX - Name: ma_options[customcss]
function setting_customcss_fn() {
	global $mantra_options;
	echo "<textarea id='mantra_customcss' name='ma_options[mantra_customcss]' rows='8' cols='70' type='textarea' >{$mantra_options['mantra_customcss']}  </textarea>";
	echo "<div><small>".__("Insert your custom CSS here. Any CSS declarations made here will overwrite Mantra's (even the custom options specified right here in the Mantra Settings page). <br /> Your custom CSS will be preserved when updating the theme.","mantra")."</small></div>";
}


// Display the admin options page
function mantra_page_fn() {

 if (!current_user_can('edit_theme_options'))  {
    wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','mantra') );
  }?>



<div class="wrap">
<php 
///// Get options previous to and including 1.6.6 into the new options
$mantra_options= mantra_get_theme_options();
if ($options) $mantra_options = $options;

?>
	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php _e("Mantra Settings","mantra"); ?></h2>
<div class="lefty">
<?php if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated'><p>";
	echo _e('Mantra settings updated successfully.','mantra');
	echo "</p></div>";
} ?>
	
	<form name="mantra_form" action="options.php" method="post" enctype="multipart/form-data">
		<div id="accordion">	
			<?php settings_fields('ma_options'); ?>
			<?php do_settings_sections(__FILE__); ?>
		</div>
	<div id="submitDiv">
			<input name="ma_options[mantra_defaults]" id="mantra_defaults" type="submit" style="float:left;" value="<?php _e('Reset to Defaults','mantra'); ?>" />
			<input name="ma_options[mantra_submit]" type="submit" style="float:right;"   value="<?php _e('Save Changes','mantra'); ?>" />
			
		</div>


	</form>
<?php      $theme_data = get_transient( 'theme_info');  ?>
<span id="version"> 
<?php echo $theme_data['Name'].' v. '.$theme_data['Version'].' by '.$theme_data['Author']; ?>
</span>
</div>

<div class="righty" >
	<div class="postbox donate"> 
	<h3 class="hndle"> Support the developer </h3>
	<div class="inside"><?php _e("<p>Here at Cryout Creations (the developers of yours truly Mantra Theme), we spend night after night improving the Mantra Theme. We fix a lot of bugs (that we previously created); we add more and more customization options while also trying to keep things as simple as possible; then... we might play a game or two but rest assured that we return to read and (in most cases) reply to your late night emails and comments, take notes and draw dashboards of things to implement in future versions.</p>
<p>So you might ask yourselves: <i>How do they do it? How can they keep so fresh after all that hard labor for that darned theme? </i> Well folks, it's simple. We drink coffee. Industrial quantities of hot boiling coffee. We love it! So if you want to help with the further development of the Mantra Theme...</p> ","mantra"); ?>
	<div style="display:block;float:none;margin:0 auto;text-align:center;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHRwYJKoZIhvcNAQcEoIIHODCCBzQCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTA
kNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCEbpng642kzK2LSQplNwr+K8U+3R7oVRuevXG5ZrBK61SkcTjjCA+hNY+lmPMZcG7knXp2YAHscTZ9XTvG+hN21PmNnOXGRhSV1ekr8HcSlE2jS/1IJ+CFdBLJHAriSO/FYz9lSRh50f9IYFBKiYjfVlg1taFlEr2oqu+iUHptdDELMAkGBSsOAwIaBQAwgcQGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIqe0+r/or6xSAgaDFwzKI5FjDcAs0kaOM9rzNn54h8hHryD/+FAFJtQ2WepyjTpyg3qqKj708ZkHhwtRATtNKBjUa/7SWMkn/FSjQTUyPzcPTM/qxVR/sdjVpcxUnRZVQVnEXZTw4wWDam4bYQG3gPvEshgleldmcP4ijDheT/134Ty4TDT1msFq6mM7VZWNXaC4PeigVrYiZaaC5cv2FzZxNO5c8Hd7W8Vi4oIIDhzCCA4MwggLsoAMC
AQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBk
TCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMTEwOTI3MTM1NDQ1WjAjBgkqhkiG9w0BCQQxFgQUkK29zIRZM5pcjU1GP2n20IuhL0gwDQYJKoZIhvcNAQEBBQAEgYAsk4w3oqJ
uGoJV/7kErByS98U5Gze/kUo5OvpezDjckdR0TJfoNFDKiAit+Qf9+ToViM/CmY2cONArejftWlnEKikB7UxCFuA3uPj8lXq5KXvukDTdrDJicqh+vZvjDr2ipMsrEl+BgRsUsYamXRosq6U/bT/zcmXcdgdbg44pJQ==-----END PKCS7-----"><input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>		</div>

	</div>
</div>

<div class="postbox support"> 
	<h3 class="hndle"> Mantra Help </h3>
	<br />
<div class="inside">
	<?php _e("
<ul>
<li>- Need any Mantra or WordPress help?</li>
<li>- Want to know what changes are made to the theme with each new version?</li>
<li>- Found a bug or maybe something doesn't work exactly as expected?</li>
<li>- Got an idea on how to improve the Mantra Theme to better suit your needs?</li>
<li>- Want a setting implemented?</li>
<li>- Do you have or would you like to make a translation of the Mantra Theme?</li>
</ul>
<p>Then come visit us at Mantra's support page.</p>
","mantra"); ?>
	<a style="display:block;float:none;margin:0 auto;text-align:center;padding-bottom:10px;" href='http://www.riotreactions.com/mantra'>Mantra Support Page</a>
</div>
</div>

<?php /* $mantra_options= mantra_get_theme_options(); print_r ($mantra_options); */?>

</div>

</div>
<script type="text/javascript">
  jQuery(document).ready(function() {

jQuery('#mantra_defaults').click (function() {
if (!confirm('Reset Mantra Settings to Defaults?')) {
                return false;}

 });

// Hide or show favicon upload form

jQuery('#mantra_faviconshow').change(function() {
 if(jQuery('#mantra_faviconshow option:selected').text()=="Disable") {jQuery('#uploadarea').hide("normal");}
else {jQuery('#uploadarea').show("normal");}
});
if(jQuery('#mantra_faviconshow option:selected').text()=="Disable") {jQuery('#uploadarea').hide("normal");}
else {jQuery('#uploadarea').show("normal");}

// Hide or show dimmensions

jQuery('#mantra_dimselect').change(function() {
 if(jQuery('#mantra_dimselect option:selected').text()=="Absolute") {jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");}
else {jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");}
});
if(jQuery('#mantra_dimselect option:selected').text()=="Absolute") {jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");}
else {jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");}


// Color selector enabler

function startfarb(a,b) {
jQuery(b).css('display','none');
	
   jQuery(b).farbtastic(a);
	jQuery(a).click(function() {
  if(jQuery(b).css('display') == 'none')	jQuery(b).show(300);
});

	jQuery(document).mousedown( function() {
			jQuery(b).hide(700);
		});
}

startfarb("#mantra_backcolor","#mantra_backcolor2");
startfarb("#mantra_headercolor","#mantra_headercolor2");
startfarb("#mantra_prefootercolor","#mantra_prefootercolor2");
startfarb("#mantra_footercolor","#mantra_footercolor2");
startfarb("#mantra_titlecolor","#mantra_titlecolor2");
startfarb("#mantra_descriptioncolor","#mantra_descriptioncolor2");
startfarb("#mantra_contentcolor","#mantra_contentcolor2");
startfarb("#mantra_linkscolor","#mantra_linkscolor2");
startfarb("#mantra_hovercolor","#mantra_hovercolor2");
startfarb("#mantra_headtextcolor","#mantra_headtextcolor2");
startfarb("#mantra_headtexthover","#mantra_headtexthover2");
startfarb("#mantra_sideheadbackcolor","#mantra_sideheadbackcolor2");
startfarb("#mantra_sideheadtextcolor","#mantra_sideheadtextcolor2");
startfarb("#mantra_footerheader","#mantra_footerheader2");
startfarb("#mantra_footertext","#mantra_footertext2");
startfarb("#mantra_footerhover","#mantra_footerhover2");

  });

	jQuery('.form-table').wrap('<div>');
	jQuery(function() {
		jQuery( "#accordion" ).accordion({
				 header: 'h3',
			autoHeight: false,
			collapsible: true,
			navigation: true,
			active: false });





	});

function changeBorder (idName, className) {
jQuery('.'+className).removeClass( 'checkedClass' );
jQuery('.'+className).removeClass( 'borderful' );
jQuery('#'+idName).addClass( 'borderful' );

return 0;
}


	</script>



<?php
}

/* Font family array */

	$itemsans = array("Segoe UI, Arial, sans-serif",
					 "Verdana, Geneva, sans-serif " ,
					 "Geneva, sans-serif ", 
					 "Helvetica Neue, Arial, Helvetica, sans-serif",
					 "Helvetica, sans-serif" ,
					 "Century Gothic, AppleGothic, sans-serif",
				     "Futura, Century Gothic, AppleGothic, sans-serif",
					 "Calibri, Arian, sans-serif",
				     "Myriad Pro, Myriad,Arial, sans-serif",
					 "Trebuchet MS, Arial, Helvetica, sans-serif" ,
					 "Gill Sans, Calibri, Trebuchet MS, sans-serif",
					 "Impact, Haettenschweiler, Arial Narrow Bold, sans-serif ",
					 "Tahoma, Geneva, sans-serif" ,
					 "Arial, Helvetica, sans-serif" ,
					 "Arial Black, Gadget, sans-serif",
					 "Lucida Sans Unicode, Lucida Grande, sans-serif ");

	$itemserif = array("Georgia, Times New Roman, Times, serif" ,
					  "Times New Roman, Times, serif",
					  "Cambria, Georgia, Times, Times New Roman, serif",	
					  "Palatino Linotype, Book Antiqua, Palatino, serif",
					  "Book Antiqua, Palatino, serif",
					  "Palatino, serif",
				      "Baskerville, Times New Roman, Times, serif",
 					  "Bodoni MT, serif",
					  "Copperplate Light, Copperplate Gothic Light, serif",
					  "Garamond, Times New Roman, Times, serif");

	$itemsmono = array( "Courier New, Courier, monospace" ,
					 "Lucida Console, Monaco, monospace",
					 "Consolas, Lucida Console, Monaco, monospace",
					 "Monaco, monospace");

	$itemscursive = array( "Lucida Casual, Comic Sans MS , cursive ",
				     "Brush Script MT,Phyllis,Lucida Handwriting,cursive",
					 "Phyllis,Lucida Handwriting,cursive",
					 "Lucida Handwriting,cursive",
					 "Comic Sans MS, cursive");

/* Social media links */

	$mantra_global_socials = array ("Delicious","DeviantArt", "Digg", "Facebook", "Flickr", "Google", "GoodReads", "GooglePlus" ,"LastFM", "LinkedIn", "Mail", "MySpace", "Picasa", "Reddit", "RSS", "Skype", "StumbleUpon", "Technorati","Tumblr", "Twitter","Vimeo","WordPress", "Yahoo", "YouTube" );

