<?php
// Validate user data
function ma_options_validate($input) {
global $mantra_defaults;
	// Sanitize the texbox input
	$input['mantra_copyright'] =  wp_kses_post($input['mantra_copyright']);

	$input['mantra_backcolor'] =  wp_kses_data($input['mantra_backcolor']);
	$input['mantra_headercolor'] =  wp_kses_data($input['mantra_headercolor']);
	$input['mantra_prefootercolor'] =  wp_kses_data($input['mantra_prefootercolor']);
	$input['mantra_footercolor'] =  wp_kses_data($input['mantra_footercolor']);
	$input['mantra_titlecolor'] =  wp_kses_data($input['mantra_titlecolor']);
	$input['mantra_descriptioncolor'] =  wp_kses_data($input['mantra_descriptioncolor']);
	$input['mantra_contentcolor'] =  wp_kses_data($input['mantra_contentcolor']);
	$input['mantra_linkscolor'] =  wp_kses_data($input['mantra_linkscolor']);
	$input['mantra_hovercolor'] =  wp_kses_data($input['mantra_hovercolor']);
	$input['mantra_headtextcolor'] =  wp_kses_data($input['mantra_headtextcolor']);
	$input['mantra_headtexthover'] =  wp_kses_data($input['mantra_headtexthover']);
	$input['mantra_sideheadbackcolor'] =  wp_kses_data($input['mantra_sideheadbackcolor']);
	$input['mantra_sideheadtextcolor'] =  wp_kses_data($input['mantra_sideheadtextcolor']);
	$input['mantra_footerheader'] =  wp_kses_data($input['mantra_footerheader']);
	$input['mantra_footertext'] =  wp_kses_data($input['mantra_footertext']);
	$input['mantra_footerhover'] =  wp_kses_data($input['mantra_footerhover']);

	$input['mantra_excerptwords'] =  intval(wp_kses_data($input['mantra_excerptwords']));
	$input['mantra_excerptdots'] =  wp_kses_data($input['mantra_excerptdots']);
	$input['mantra_excerptcont'] =  wp_kses_data($input['mantra_excerptcont']);

	$input['mantra_fwidth'] =  intval(wp_kses_data($input['mantra_fwidth']));
	$input['mantra_fheight'] =  intval(wp_kses_data($input['mantra_fheight']));

	$input['mantra_social2'] =  wp_kses_data($input['mantra_social2']);
	$input['mantra_social4'] =  wp_kses_data($input['mantra_social4']);
	$input['mantra_social6'] =  wp_kses_data($input['mantra_social6']);
	$input['mantra_social8'] =  wp_kses_data($input['mantra_social8']);
	$input['mantra_social10'] =  wp_kses_data($input['mantra_social10']);

	$input['mantra_customcss'] =  wp_kses_post($input['mantra_customcss']);

	$input['mantra_fpsliderwidth'] =  intval(wp_kses_data($input['mantra_fpsliderwidth']));
	$input['mantra_fpsliderheight'] = intval(wp_kses_data($input['mantra_fpsliderheight']));

	$input['mantra_sliderimg1'] =  wp_kses_data($input['mantra_sliderimg1']);
	$input['mantra_slidertitle1'] =  wp_kses_data($input['mantra_slidertitle1']);
	$input['mantra_slidertext1'] =  wp_kses_post($input['mantra_slidertext1']);
	$input['mantra_sliderlink1'] =  wp_kses_data($input['mantra_sliderlink1']);
	$input['mantra_sliderimg2'] =  wp_kses_data($input['mantra_sliderimg2']);
	$input['mantra_slidertitle2'] =  wp_kses_data($input['mantra_slidertitle2']);
	$input['mantra_slidertext2'] =  wp_kses_post($input['mantra_slidertext2']);
	$input['mantra_sliderlink2'] =  wp_kses_data($input['mantra_sliderlink2']);
	$input['mantra_sliderimg3'] =  wp_kses_data($input['mantra_sliderimg3']);
	$input['mantra_slidertitle3'] =  wp_kses_data($input['mantra_slidertitle3']);
	$input['mantra_slidertext3'] =  wp_kses_post($input['mantra_slidertext3']);
	$input['mantra_sliderlink3'] =  wp_kses_data($input['mantra_sliderlink3']);
	$input['mantra_sliderimg4'] =  wp_kses_data($input['mantra_sliderimg4']);
	$input['mantra_slidertitle4'] =  wp_kses_data($input['mantra_slidertitle4']);
	$input['mantra_slidertext4'] =  wp_kses_post($input['mantra_slidertext4']);
	$input['mantra_sliderlink4'] =  wp_kses_data($input['mantra_sliderlink4']);
	$input['mantra_sliderimg5'] =  wp_kses_data($input['mantra_sliderimg5']);
	$input['mantra_slidertitle5'] =  wp_kses_data($input['mantra_slidertitle5']);
	$input['mantra_slidertext5'] =  wp_kses_post($input['mantra_slidertext5']);
	$input['mantra_sliderlink5'] =  wp_kses_data($input['mantra_sliderlink5']);
	$input['mantra_social2'] =  wp_kses_data($input['mantra_social2']);
	$input['mantra_social2'] =  wp_kses_data($input['mantra_social2']);

	$input['mantra_colimageheight'] = intval(wp_kses_data($input['mantra_colimageheight']));

	$input['mantra_columnimg1'] =  wp_kses_data($input['mantra_columnimg1']);
	$input['mantra_columntitle1'] =  wp_kses_data($input['mantra_columntitle1']);
	$input['mantra_columntext1'] =  wp_kses_post($input['mantra_columntext1']);
	$input['mantra_columnlink1'] =  wp_kses_data($input['mantra_columnlink1']);
	$input['mantra_columnimg2'] =  wp_kses_data($input['mantra_columnimg2']);
	$input['mantra_columntitle2'] =  wp_kses_data($input['mantra_columntitle2']);
	$input['mantra_columntext2'] =  wp_kses_post($input['mantra_columntext2']);
	$input['mantra_columnlink2'] =  wp_kses_data($input['mantra_columnlink2']);
	$input['mantra_columnimg3'] =  wp_kses_data($input['mantra_columnimg3']);
	$input['mantra_columntitle3'] =  wp_kses_data($input['mantra_columntitle3']);
	$input['mantra_columntext3'] =  wp_kses_post($input['mantra_columntext3']);
	$input['mantra_columnlink3'] =  wp_kses_data($input['mantra_columnlink3']);
	$input['mantra_columnimg4'] =  wp_kses_data($input['mantra_columnimg4']);
	$input['mantra_columntitle4'] =  wp_kses_data($input['mantra_columntitle4']);
	$input['mantra_columntext4'] =  wp_kses_post($input['mantra_columntext4']);
	$input['mantra_columnlink4'] =  wp_kses_data($input['mantra_columnlink4']);

	$input['mantra_fronttext1'] =  wp_kses_data($input['mantra_fronttext1']);
	$input['mantra_fronttext2'] =  wp_kses_data($input['mantra_fronttext2']);
	$input['mantra_fronttext3'] = trim( wp_kses_post($input['mantra_fronttext3']));
	$input['mantra_fronttext4'] = trim (wp_kses_post($input['mantra_fronttext4']));

	 $resetDefault = ( ! empty( $input['mantra_defaults']) ? true : false );

	if ($resetDefault) {$input=$mantra_defaults;}


	return $input; // return validated input

}
?>
