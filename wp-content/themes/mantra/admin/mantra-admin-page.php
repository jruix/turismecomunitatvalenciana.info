
<div class="wrap">
<?php 
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
<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----"><input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>		</div>

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

