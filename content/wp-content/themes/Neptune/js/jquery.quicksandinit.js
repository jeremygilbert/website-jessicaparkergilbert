jQuery(function($){
	$(document).ready(function() {
		
		//set height on container via css to fix some bugs
		var $portfolioHeight = $("#portfolio-wrap").innerHeight();
		$(".portfolio-content").height($portfolioHeight)
		
		//Options for the portfolio filter
		var $filterType = $('#portfolio-cats a.active').attr('rel');
		var $holder = $('ul.portfolio-content');
		var $data = $holder.clone();
		
		$('#portfolio-cats li a').click(function(e) {
		$('#portfolio-cats a').removeClass('active');
			var $filterType = $(this).attr('rel');
			$(this).addClass('active');
			
			if ($filterType == 'all') {
				var $filteredData = $data.find('li');
			}
			else {
				var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
			}
			
			$holder.quicksand($filteredData, {
				duration: 800,
				adjustHeight:"dynamic",
				easing: 'easeInOutQuad',
	
				}, function() {
				
				// callback functions here
				jQuery(function($){	
					$('.portfolio-item').hover(function(){
						$(this).find('.portfolio-item-overlay').stop(true, true).fadeIn(300) }, function(){
						$(this).find('.portfolio-item-overlay').stop(true, true).fadeOut(300)	
					});

				});
		  	});
		  
		  return false;
		});
	});
});