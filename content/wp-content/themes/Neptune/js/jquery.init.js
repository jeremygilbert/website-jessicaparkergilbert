jQuery(function($){
	$(document).ready(function(){
		$('#single-portfolio-right').slides({
			effect: 'fade',
			crossfade: true,
			fadeSpeed: 800,
			slideSpeed: 800,
			slideEasing: "easeOutQuad",
			play: 5000,
			pause: 10,
			autoHeight: true,
			preload: false,
			hoverPause: true,
			generateNextPrev: false,
			generatePagination: true
		});
		$("ul.sf-menu").superfish({ 
			autoArrows: false,
			animation:  {opacity:'show',height:'show'}
		});
		
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 'slow');
			return false;
		});
		$('.portfolio-item').hover(function(){
			$(this).find('.portfolio-item-overlay').stop(true, true).fadeIn(300) }, function(){
			$(this).find('.portfolio-item-overlay').stop(true, true).fadeOut(300)	
		});
		$('.loop-entry-thumbnail').hover(function(){
			$(this).find('.loop-entry-overlay').stop(true, true).fadeIn(300) }, function(){
			$(this).find('.loop-entry-overlay').stop(true, true).fadeOut(300)	
		});
		$(".prettyphoto-link").prettyPhoto({
			theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook */
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			social_tools: false,
			autoplay_slideshow: false
		});
		$("a[rel^='prettyPhoto']").prettyPhoto({
			theme: 'pp_default', // light_rounded / dark_rounded / light_square / dark_square / facebook */
			animation_speed:'normal',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			slideshow:3000,
			social_tools: false,
			autoplay_slideshow: false,
			overlay_gallery: false
		});
	}); // END doc ready
}); // END function