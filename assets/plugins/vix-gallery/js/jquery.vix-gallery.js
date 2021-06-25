/**
||	@name JQuery VIX Gallery
||	@version v1.0
||	@date January 29, 2015
||	@author Zaporozhets Vladislav
||	@email zaporozhets-vlad@rambler.ru
*/
(function( $ ) {
	$.fn.gallery = function(options) {
		const settings = $.extend({
			imgWidth: 810,
			background: false,
			captionClass: 'vix-caption',
			imageArray: [],
			activeImage: 0
		}, options);

		const jQueryMatchedObj = $(this);

		$(document)
			.on('click', function(event)
			{
				if ($(event.target).closest(".vix-modal").length) return;
				removeModal();
				event.stopPropagation();
			})
			.on('keydown', function(event)
			{
				if (event.which === 27) removeModal();
			});
		
		function init()
		{
			start(this, jQueryMatchedObj);
			return false;
		}
		
		function start(click, obj) 
		{
			settings.imageArray.length = 0;
			settings.activeImage = 0;
			
			for (let i = 0; i < obj.length; i++ ) {
				settings.imageArray.push([obj.eq(i).attr('href'),
					obj.eq(i).attr('title'),
					obj.eq(i).find('.'+settings.captionClass).text(),
					obj.eq(i).attr('data-date')]);
			}
			
			while ( settings.imageArray[settings.activeImage][0] !== click.getAttribute('href') ) {
				settings.activeImage++;
			}
			
			createModal();
			setImage();
		}
		
		function setImage()
		{
			$('.vix-loader').show();
			$('.vix-image').hide();

			let objImagePreloader = new Image();

			objImagePreloader.onload = function() {
				$('.vix-image').attr('src',settings.imageArray[settings.activeImage][0]);
				_resize_container_image_box();
				objImagePreloader.onload=function(){};
			};

			objImagePreloader.src = settings.imageArray[settings.activeImage][0];
		}
		
		function _resize_container_image_box()
		{
			_show_image_data();
			setTitle();
			
			$('.vix-loader').hide();
			_show_image();
		}
		
		function _show_image()
		{
			$('.vix-image').fadeIn('fast');
			_set_navigation();
		}
		
		function _show_image_data()
		{
			$('.vix-image-caption').text(settings.imageArray[settings.activeImage][2])
		}
		
		function _set_navigation()
		{
			// Show the prev button, if not the first image in set
			$('.vix-btn-prev')
				.off('click')
				.on('click',function() {
					if ( settings.activeImage === 0 ) {
						settings.activeImage = settings.imageArray.length - 1;
					} else {
						settings.activeImage = settings.activeImage - 1;
					}
					setImage();
					return false;
				});
				
			$('.vix-btn-next, .vix-image')
				.off()
				.on('click',function() {
					if ( settings.activeImage === settings.imageArray.length - 1 ) {
						settings.activeImage = 0;
					} else {
						settings.activeImage = settings.activeImage + 1;
					}
					setImage();
					return false;
				});
		}
		
		function createModal()
		{
			// Создаем подложку
			$('body')
				.width($(document).width())
				.css('overflow', 'hidden')
				.append('<div class="vix-overlay"></div>');

			let  vixOverlay = $('.vix-overlay');

			if(settings.background)
			{
				vixOverlay.css('background-color', settings.background);
			}
			
			// Общая структура модального окна
			vixOverlay.append('<div class="vix-modal"><div class="vix-title"></div><div class="vix-close"></div><button class="vix-btn vix-btn-prev"></button><button class="vix-btn vix-btn-next"></button><div class="vix-image-wrap"><div class="vix-loader"></div><img src="" alt="" class="vix-image" /></div></div>');
			
			$('.vix-close').on('click', function(){
				removeModal();
			});
			
			// Показываем окно
			vixOverlay.fadeIn('fast');
		}
		
		function removeModal() 
		{
			$('.vix-overlay').fadeOut('fast', function(){
				$(this).remove();

				$('body')
					.css('overflow', 'auto')
					.width("auto")
			})
		}
		
		function setTitle()
		{
			$('.vix-title').text('Фотография '+ (settings.activeImage+1) +' из '+ settings.imageArray.length);
			$('.vix-image-date').text(settings.imageArray[settings.activeImage][3]);
		}

		return $(this)
			.off('click')
			.on('click', init);
	};
})(jQuery);