jQuery(document).ready(function($) {

	//Masonry blocks
	$blocks = $(".posts");

	$blocks.imagesLoaded(function(){
		$blocks.masonry({
			itemSelector: '.post-container'
		});

		// Fade blocks in after images are ready (prevents jumping and re-rendering)
		$(".post-container").fadeIn();
	});

	$(window).resize(function () {
		$blocks.masonry();
	});


	// Toggle navigation
	$(".nav-toggle").on("click", function(){	
		$(this).toggleClass("active");
		$(".mobile-menu-container").slideToggle();
	});
	
	
	// Show navigation > 800
	$(window).resize(function() {
		if ($(window).width() > 800) {
			$(".mobile-menu-container").hide();
			$('.nav-toggle').removeClass('active');
		}
	});


	// Display dropdown menus on focus.
	$( '.main-menu a' ).on( 'blur focus', function( e ) {
		$( this ).parents( 'li' ).toggleClass( 'focus' );
	} );
	
	
	// Post meta tabs
    $( '.tab-selector a' ).click( function() {
		$( '.tab-selector a' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
    	$( '.post-meta-tabs .tab' ).removeClass( 'active' );
		$( '.post-meta-tabs ' + $( this ).attr( 'data-target' ) ).addClass( 'active' );
		return false;
    } );
    
    
	// Load Flexslider
    $(".flexslider").flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "Previous",
        nextText: "Next",
        smoothHeight: true,
        start: $blocks.masonry(),
    });

        			
	// resize videos after container
	var vidSelector = ".post iframe, .post object, .post video, .widget-content iframe, .widget-content object, .widget-content iframe";	
	var resizeVideo = function(sSel) {
		$( sSel ).each(function() {
			var $video = $(this),
				$container = $video.parent(),
				iTargetWidth = $container.width();

			if ( !$video.attr("data-origwidth") ) {
				$video.attr("data-origwidth", $video.attr("width"));
				$video.attr("data-origheight", $video.attr("height"));
			}

			var ratio = iTargetWidth / $video.attr("data-origwidth");

			$video.css("width", iTargetWidth + "px");
			$video.css("height", ( $video.attr("data-origheight") * ratio ) + "px");
		});
	};

	resizeVideo(vidSelector);

	$(window).resize(function() {
		resizeVideo(vidSelector);
	});
    
	
	// When Jetpack Infinite scroll posts have loaded
	$( document.body ).on( 'post-load', function () {

		var $container = $('.posts');
		$container.masonry( 'reloadItems' );
		
		$blocks.imagesLoaded(function(){
			$blocks.masonry({
				itemSelector: '.post-container'
			});
	
			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$(".post-container").fadeIn();
		});
		
		
		// Rerun video resizing
		resizeVideo(vidSelector);
		
		
		// Load Flexslider
	    $(".flexslider").flexslider({
	        animation: "slide",
	        controlNav: false,
	        prevText: "Previous",
	        nextText: "Next",
	        smoothHeight: true   
	    });
		
		
		$container.masonry( 'reloadItems' );
		

	});

});