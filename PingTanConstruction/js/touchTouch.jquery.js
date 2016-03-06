/**
 * @name		jQuery touchTouch plugin
 * @author		Martin Angelov
 * @version 	1.0
 * @url			http://tutorialzine.com/2012/04/mobile-touch-gallery/
 * @license		MIT License
 */


(function(){

	/* Private variables */
	
	var overlay = $('<div id="galleryOverlay">'),
		slider = $('<div id="gallerySlider">'),
		prevArrow = $('<a id="prevArrow"></a>'),
		nextArrow = $('<a id="nextArrow"></a>'),
		currentContract,
		currentValue,
		currentScope,
		currentClient,
		currentPeriod,
		overlayVisible = false,
		photoList;
		
		
	/* Creating the plugin */
	
	$.fn.touchTouch = function(){

		var placeholders = $([]),
			index = 0,
			allitems = this,
			items = allitems;
		// set allitems to all picture of this project
		
		// Appending the markup to the page
		overlay.hide().appendTo('body');
		slider.appendTo(overlay);
	
		
		
		// Listen for touch events on the body and check if they
		// originated in #gallerySlider img - the images in the slider.
		$('body').on('touchstart', '#gallerySlider img', function(e){
			
			var touch = e.originalEvent,
				startX = touch.changedTouches[0].pageX;
	
			slider.on('touchmove',function(e){
				
				e.preventDefault();
				
				touch = e.originalEvent.touches[0] ||
						e.originalEvent.changedTouches[0];
				
				if(touch.pageX - startX > 10){

					slider.off('touchmove');
					showPrevious();
				}

				else if (touch.pageX - startX < -10){

					slider.off('touchmove');
					showNext();
				}
			});

			// Return false to prevent image 
			// highlighting on Android
			return false;
			
		}).on('touchend',function(){

			slider.off('touchmove');

		});
		
		// Listening for clicks on the thumbnails
		items.on('click', function(e){

			e.preventDefault();

			var $this = $(this),
				imgIndex = 0,
				photoListJson = $.parseJSON($this.parents('.grid_4').data('imgList'));

				
			// convert the json object into array with all values
			photoList = $.map(photoListJson, function(value, key) { 
								return value;
							});
			currentContract = $this.parents('.grid_4').data('contract');
			currentScope = $this.parents('.grid_4').data('scope');
			currentPeriod = $this.parents('.grid_4').data('period');
			currentValue = $this.parents('.grid_4').data('value');
			currentClient = $this.parents('.grid_4').data('client');
			// Creating a placeholder for each image
			for(var i = 0; i < photoList.length; i++){

				placeholders = placeholders.add($('<div class="placeholder">'));
			}

			// Hide the gallery if the background is touched / clicked
			slider.append(placeholders).on('click',function(e){

				if(!$(e.target).is('img')){
					hideOverlay();
				}
			});

			index = imgIndex;
			// Find the position of this image
			// in the collection
			showOverlay(imgIndex);

			showImage(imgIndex);
			
			// Preload the next image
			preload(imgIndex+1);
			
			// Preload the previous
			preload(imgIndex-1);
			
		});
		
		// If the browser does not have support 
		// for touch, display the arrows
		if ( !("ontouchstart" in window) ){
			overlay.append(prevArrow).append(nextArrow);
			
			prevArrow.click(function(e){
				e.preventDefault();
				showPrevious();
			});
			
			nextArrow.click(function(e){
				e.preventDefault();
				showNext();
			});
		}
		
		// Listen for arrow keys
		$(window).bind('keydown', function(e){
		
			if (e.keyCode == 37) {
				showPrevious();
			}

			else if (e.keyCode==39) {
				showNext();
			}
	
		});
		
		
		/* Private functions */
		
	
		function showOverlay(index){
			// If the overlay is already shown, exit
			if (overlayVisible){
				return false;
			}
			
			// Show the overlay
			overlay.show();
			
			setTimeout(function(){
				// Trigger the opacity CSS transition
				overlay.addClass('visible');
			}, 100);
	
			// Move the slider to the correct image
			offsetSlider(index);
			
			// Raise the visible flag
			overlayVisible = true;
		}
	
		function hideOverlay(){

			// If the overlay is not shown, exit
			if(!overlayVisible){
				return false;
			}
			
			// Hide the overlay
			overlay.hide().removeClass('visible');
			overlayVisible = false;

			//Clear preloaded items
			$('#gallerySlider').remove(".placeholder");
			//placeholders = $([]);
			/*$('.placeholder').each(function(){
				console.log($(this));
				$(this).remove();
			});*/
			//Reset possibly filtered items
			items = allitems;
		}
	
		function offsetSlider(index){

			// This will trigger a smooth css transition
			slider.css('left',(-index*100)+'%');
		}
	
		// Preload an image by its index in the items array
		function preload(index){

			setTimeout(function(){
				showImage(index);
			}, 1000);
		}
		
		// Show image in the slider
		function showImage(index){
	
			// If the index is outside the bonds of the array
			if(index < 0 || index >= items.length){
				return false;
			}
			
			// Call the load function with the href attribute of the item
			loadImage(photoList[index], function(){
				placeholders.eq(index).html(this);
				var overlay = $('.project-detail-template').clone(true, true);
				overlay.removeClass('project-detail-template');
				overlay.addClass('project-detail');
				overlay.find('.detail-contract').text(currentContract);
				overlay.find('.detail-value').text(currentValue);
				overlay.find('.detail-period').text(currentPeriod);
				overlay.find('.detail-scope').text(currentScope);
				overlay.find('.detail-client').text(currentClient);
				overlayHeight = $('.project-detail').height();
				overlayWidth = $(this).width();
				overlay.css('width', overlayWidth);
				overlay.css('margin-top', -overlayHeight);
				placeholders.eq(index).append(overlay);
			});
		}
		
		// Load the image and execute a callback function.
		// Returns a jQuery object
		
		function loadImage(src, callback){

			var img = $('<img>').on('load', function(){
				callback.call(img);
			});
			
			img.attr('src',src);
		}
		
		function showNext(){
			
			// If this is not the last image
			console.log('placeholder length: ' + photoList.length);
			if(index+1 < photoList.length){
				index++;
				offsetSlider(index);
				preload(index+1);
			}

			else{
				// Trigger the spring animation
				slider.addClass('rightSpring');
				setTimeout(function(){
					slider.removeClass('rightSpring');
				},500);
			}
		}
		
		function showPrevious(){
			
			// If this is not the first image
			if(index>0){
				index--;
				offsetSlider(index);
				preload(index-1);
			}

			else{
				// Trigger the spring animation
				slider.addClass('leftSpring');
				setTimeout(function(){
					slider.removeClass('leftSpring');
				},500);
			}
		}
	};
	
})(jQuery);