$(function () {

	$('.product-detail-slider').slick({
		fade			: true,
		infinite		: false,
		arrows 			: false,
		dots 			: true,
		dotsClass 		: 'product-detail-dots-slider',
		swipe			: false,
		customPaging	: function (slider, i) {
			return '<span><img src="'+slider.$slides[i].href+'" /></span>';
		},
	});
	$('.product-detail-dots-slider').slick({
		infinite		: false,
		arrows 			: true,
		prevArrow		: '<button type = "button" class = "slick-prev"></ button>',
		nextArrow	 	: '<button type = "button" class = "slick-next"></ button>',
		dots 			: false,
		slidesToShow 	: 5,
		slidesToScroll 	: 1,
		variableWidth	: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					arrows 			: false,
					slidesToShow 	: 4
	      		}
	      	}
		]
	});
	$('.product-detail-slider').on('afterChange', function (event, slick, currentSlide) {
	    $('.product-detail-dots-slider .slick-slide[data-slick-index="'+currentSlide+'"]').addClass('slick-current').siblings().removeClass('slick-current');
	});
	var $element = $('.product-detail'),
		$currentStore = $('.select-store .current-store', $element);

	$('.js-buy-btn', $element).on('click', function () {
		var data = elementData,
			quantity = $('.counter__input', $element).val();

		data.quantity = quantity;
		data.image    = $('.product-detail-image img', $element);

		SP.Catalog.buyProduct(data, null, function (data) {
			SP.Catalog.showBuyError($('.product-detail-buy'), data);
		});
	});

	$('.counter__minus, .counter__plus', $element).on('click', function () {
		var $this = $(this),
			maxAmount = $(this).parents('.product-detail').find('.js-buy-btn').data('max-amount'),
			quantity;

	  	quantity = parseInt($('.counter__input', $element).val());

		if (isNaN(quantity)) {
			return;
		}

		if ($this.hasClass('counter__plus')) {
			++quantity;
			if (quantity > maxAmount) {
				return;
			}
		} else if ($this.hasClass('counter__minus')) {
			--quantity;
			if (quantity < 1) {
				return;
			}
		}
		$('.counter__input', $element).val(quantity);
	});

	$('.counter__input', $element).on('blur', function () {
		var quantity = parseInt(this.value),
			maxAmount = $(this).parents('.product-detail').find('.js-buy-btn').data('max-amount'),
			newValue;

		if (isNaN(quantity)) {
		  newValue = $(this).data('originalValue');
		} else if (quantity < 1) {
		  newValue = 1;
		} else if (quantity > maxAmount) {
		  newValue = maxAmount;
		} else {
		  newValue = quantity;
		}
		this.value = newValue;
	});
});


//description buttons focus
const descriptionButton = document.querySelectorAll('.description-button');
descriptionButton.forEach(btn => {
	btn.addEventListener('click', () => {
		removeFocus();
		btn.classList.add('active');
	})

	removeFocus = () => {
		descriptionButton.forEach(btn => {
			btn.classList.remove('active');
		})
	}
})

//characteristic container active
const charcterBtn = document.querySelector('#characteristics-button');
const reviewBtn = document.querySelector('#review-button');
const videoBtn = document.querySelector('#video-button');
const charcterContainer = document.querySelector('.characteristics-container');
const reviewContainer = document.querySelector('.review-container');
const videoContainer = document.querySelector('.video-container');

charcterBtn.addEventListener('click', () => {
	charcterContainer.style.display = 'block';
	reviewContainer.style.display = 'none';
	videoContainer.style.display = 'none';
})
reviewBtn.addEventListener('click', () => {
	charcterContainer.style.display = 'none';
	reviewContainer.style.display = 'block';
	videoContainer.style.display = 'none';
})
videoBtn.addEventListener('click', () => {
	charcterContainer.style.display = 'none';
	reviewContainer.style.display = 'none';
	videoContainer.style.display = 'block';
})