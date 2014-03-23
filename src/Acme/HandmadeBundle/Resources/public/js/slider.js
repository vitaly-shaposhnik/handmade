//;(function($) {
$(document).ready(function() {
	var
		slider = $('#slider'),
		data = slider.data('slides'),// Params: imgUrl, linkUrl, title;

		slideCount = data.length,// количество слайдов
		scrollingDuration = 1000,
		waitingTime = 5000,

		activeMoveSlideBtns = false,// флаг, активны ли кнопки для пролистывания слайдов
		isLink = false,// флаг, является ли слайд ссылкой

		slider_SlideW,// ширина одного слайда
		slider_WrapW,// установка ширины обертки
		nowSlide = 0;// текущий слайд
	// end of vars

	var
		init = function() {
			var
				slide,
				slideTmpl;
			// end of vars

			var
				/**
				 * Шаблонизация слайда
				 *
				 * @param {Object} slide 			Данные слайда
				 * @param {Object} slide.imgUrl 	src изображения
				 * @param {Object} slide.linkUrl 	href для ссылки
				 * @param {Object} slide.title 		alt изображения
				 *
				 * @return {Object} Шаблонизированый слайд
				 */
				template = function( slide ) {
					var
						wrap_eSlide = $('<div class="Wrap_eSlide">'),
						wrap_eSlideLink = $('<a class="Wrap_eSlideLink"></a>'),
						image = $('<img />'),
						clear = '<div class="clearfix">';
					// end of vars

					if ( !slide || !slide.imgUrl || !slide.linkUrl || !slide.title ) {
						return;
					}

					//wrap_eSlideLink.attr('href', slide.linkUrl);
					image.attr('src', 'bundles/acmehandmade/' + slide.imgUrl);
					image.attr('alt', slide.title);

					wrap_eSlideLink.append(image);
					wrap_eSlide.append(wrap_eSlideLink);
					wrap_eSlide.append(clear);

					return wrap_eSlide;
				};
			// end of functions

			if ( !$('.sliderWrap').length ) {
				slider.append('<div class="sliderWrap"></div>');
			}

			if ( !activeMoveSlideBtns ) {
				$('.slider_eArrow').hide();
			}

			for ( slide in data ) {
				slideTmpl = template(data[slide]);

				$('.sliderWrap').append(slideTmpl);

				if ( $('.Wrap_eSlideLink').eq(slide).attr('href') === '' ) {
					$('.Wrap_eSlideLink').eq(slide).removeAttr('href');
				}
			}
		},

		/**
		 * Задаем интервал для пролистывания слайдов
		 */
		setScrollInterval = function setScrollInterval( slide ) {
			var
				time,
				additionalTime = 0;
			// end of vars

			if ( slide == undefined ) {
				slide = 0;
			}
			else {
				additionalTime = scrollingDuration;
			}

			time = waitingTime + additionalTime;

			interval = setTimeout(function(){
				slide++;

				if ( slideCount <= slide ) {
					slide = 0;
				}

				moveSlide(slide);
				setScrollInterval(slide);
			}, time);
		},

		/**
		 * Убираем интервал для пролистывания слайдов
		 */
		removeScrollInterval = function removeScrollInterval() {
			clearTimeout(interval);
		},

		/**
		 * листание стрелками
		 */
		sliderArrowClick = function() {
			var
				pos = ( $(this).hasClass('mArLeft') ) ? '-1' : '1',
				slide = nowSlide + pos * 1;
			// end of vars

			removeScrollInterval();
			moveSlide(slide);
			setScrollInterval(slide);

			return false;
		},

		/**
		 * Перемещение слайдов на указанный слайд
		 */
		moveSlide = function moveSlide( slide ) {
			if ( activeMoveSlideBtns ) {
				if ( slide === 0 ) {
					$('.slider_eArrow.mArLeft').hide();
				}
				else{
					$('.slider_eArrow.mArLeft').show();
				}

				if ( slide === slideCount - 1 ) {
					$('.slider_eArrow.mArRight').hide();
				}
				else {
					$('.slider_eArrow.mArRight').show();
				}
			}

			$('.sliderWrap').animate({'left': -(slider_SlideW * slide)}, scrollingDuration, function() {
				nowSlide = slide;
			});
		};
	// end of functions

	init();
	slider_SlideW = $('.Wrap_eSlide').width();
	slider_WrapW = $('.sliderWrap').width( slider_SlideW * slideCount + (940/2 - slider_SlideW/2));

	$('.slider_eArrow').bind('click', sliderArrowClick);

	moveSlide(0);
	setScrollInterval();
});