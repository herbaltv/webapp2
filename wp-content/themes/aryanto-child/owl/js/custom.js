jQuery(function($) {
  "use strict";

  $(".featured-slider").owlCarousel({
	loop:true,
	autoplay:false,
	autoplayHoverPause:true,
	nav:false,
	margin:0,
	loop:false,
	dots:true,
	mouseDrag:true,
	touchDrag:true,
	slideSpeed:500,
	navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
	items : 1,
	responsive:{
	  0:{
			items:1
	  },
	  600:{
			items:1
	  }
	}

});

	/*======================== 
        trending topics 
   ==========================*/
   if ($('#trending-slider,#post-block-slider').length > 0) {
	$('#trending-slider,#post-block-slider').owlCarousel({
		nav: false,
		items: 3,
		margin: 30,
		reponsiveClass: true,
		dots: true,
		autoplayHoverPause: true,
		loop:true,
		responsive: {
			// breakpoint from 0 up
			0: {
				items: 1,
			},
			// breakpoint from 480 up
			480: {
				items: 2,
			},
			// breakpoint from 768 up
			768: {
				items: 2,
			},
			// breakpoint from 768 up
			1200: {
				items: 3,
			}
		}
	});

	
}


	

});