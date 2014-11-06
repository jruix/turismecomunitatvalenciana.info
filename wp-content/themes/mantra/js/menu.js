

jQuery(document).ready(function() {



// Menu animation

jQuery("#access ul ul").css({display: "none"}); // Opera Fix

jQuery("#access li").hover(function(){
	jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(250);
	},function(){
	jQuery(this).find('ul:first').css({visibility: "hidden"});
								});
// Social Icons Animation

jQuery(".socialicons").hover(
function(){
	jQuery(this).animate({"top": "-5px" },{ queue: false, duration:200});
/*	 jQuery(this).css({
                        '-webkit-transform': 'rotate(5deg)',
                        '-moz-transform': 'rotate(5deg)',
                        '-ms-transform': 'rotate(5deg)',
                        '-o-transform': 'rotate(5deg)',
                        'transform': 'rotate(5deg)',
                        'zoom': 1
            });*/

					},
function(){
	jQuery(this).animate({ "top": "0px" }, { queue: false, duration:200 });
/* jQuery(this).css({
                        '-webkit-transform': 'rotate(0deg)',
                        '-moz-transform': 'rotate(0deg)',
                        '-ms-transform': 'rotate(0deg)',
                        '-o-transform': 'rotate(0deg)',
                        'transform': 'rotate(0deg)',
                        'zoom': 1
            });*/

					});







}); // ready 