$(document).ready(function(){
	$("a.slow-scroll").click(function() {
		var elementClick = $(this).attr("href")
		var destination = $(elementClick).offset().top;
		jQuery("html:not(:animated),body:not(:animated)").animate({
			scrollTop: destination
		}, 800);
		return false;
	});
  $('.js-showby-select').on('change', function () {

	var loc = window.location;
	var str = 'showby=' + this.value;
	var search;
	var params;

	if (loc.search && loc.search.indexOf('?') === 0) {

	  var search = loc.search
		.slice(1)
		.split('&')
		.filter(function (el) {
		  return el.indexOf('showby') !== 0;
		});

	  search.push(str);
	  params = search.join('&');
	} else {
	  params = str;
	}

	loc.href = loc.pathname + '?' + params;
  });

$('.selectcustom').each(function(){
	var $this = $(this), numberOfOptions = $(this).children('option').length;

	$this.addClass('select-hidden');
	$this.wrap('<div class="select"></div>');
	$this.after('<div class="select-styled"></div>');

	var $styledSelect = $this.next('div.select-styled');
	$styledSelect.text(
	  $this.children('option')
		.filter(function (i, el) {return el.selected})
		.eq(0)
		.text()
	  );

	var $list = $('<ul />', {
		'class': 'select-options'
	}).insertAfter($styledSelect);

	for (var i = 0; i < numberOfOptions; i++) {
		$('<li />', {
			text: $this.children('option').eq(i).text(),
			rel: $this.children('option').eq(i).val()
		}).appendTo($list);
	}

	var $listItems = $list.children('li');

	$styledSelect.click(function(e) {
		e.stopPropagation();
		$('div.select-styled.active').not(this).each(function(){
			$(this).removeClass('active').next('ul.select-options').hide();
		});
		$(this).toggleClass('active').next('ul.select-options').toggle();
	});

	$listItems.click(function(e) {
		e.stopPropagation();
		$styledSelect.text($(this).text()).removeClass('active');
		$this.val($(this).attr('rel'));
		$this.trigger('change');
		$list.hide();
		//console.log($this.val());
	});

	$(document).click(function() {
		$styledSelect.removeClass('active');
		$list.hide();
	});

});

$('.selectcustom1').each(function(){
	var $this = $(this), numberOfOptions = $(this).children('option').length;

	$this.addClass('select-hidden');
	$this.wrap('<div class="select"></div>');
	$this.after('<div class="select-styled"></div>');

	var $styledSelect = $this.next('div.select-styled');
	$styledSelect.text($this.children('option').eq(0).text());

	var $list = $('<ul />', {
		'class': 'select-options'
	}).insertAfter($styledSelect);

	for (var i = 0; i < numberOfOptions; i++) {
		$('<li />', {
			text: $this.children('option').eq(i).text(),
			rel: $this.children('option').eq(i).val()
		}).appendTo($list);
	}

	var $listItems = $list.children('li');

	$styledSelect.click(function(e) {
		e.stopPropagation();
		$('div.select-styled.active').not(this).each(function(){
			$(this).removeClass('active').next('ul.select-options').hide();
		});
		$(this).toggleClass('active').next('ul.select-options').toggle();
	});

	$listItems.click(function(e) {
		e.stopPropagation();
		$styledSelect.text($(this).text()).removeClass('active');
		$this.val($(this).attr('rel'));
		$list.hide();
		//console.log($this.val());
	});

	$(document).click(function() {
		$styledSelect.removeClass('active');
		$list.hide();
	});

});


// HEADER-SLIDER
$('.header-slider').slick({
  dots: false,
	infinite: true,
	arrows: true,
	nextArrow: '<div class="container-btn"><button type="button" class="slick-next"><img src="' + path.headerSlideNext + '"></button><div/>',
	prevArrow: '<div class="container-btn"><button type="button" class="slick-prev"><img src="' + path.headerSlidePrev + '"></button><div/>'
});

$('.catalog-section-slider').slick({
  dots: false,
  infinite: true,
  arrows: true,
  // centerMode: true,
  // centerPadding: '0px',
  nextArrow: '<div class="container-btn"><button type="button" class="slick-next"><img src="' + path.headerSlideNext + '"></button><div/>',
  prevArrow: '<div class="container-btn"><button type="button" class="slick-prev"><img src="' + path.headerSlidePrev + '"></button><div/>'
});

// PRODUCT-SLIDER

$('.product-slider-akum, .related-products-slider').slick({
	slidesToShow: 4,
	slidesToScroll: 1,
	infinite: false,
	dots: false,
	arrows: true,
	nextArrow: '<button type="button" class="slick-next"><img src="' + path.productSlideNext + '"></button>',
	prevArrow: '<button type="button" class="slick-prev"><img src="' + path.productSlidePrev + '"></button>',
	  responsive: [
	{
	  breakpoint: 1200,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 1
	  }
	},
	{
	  breakpoint: 992,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 1
	  }
	},

	{
	  breakpoint: 768,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 1
	  }
	},

	{
	  breakpoint: 531,
	  settings: {
		slidesToShow: 1,
		slidesToScroll: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});

// SHOP-SLIDER
$('.shop-detailed-slider').slick({
  dots: false,
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: false,
  arrows: true,
  nextArrow: '<button type="button" class="slick-next"><i class="fas fa-caret-right"></i></button>',
  prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-caret-left"></i></button>',
	responsive: [
	{
	  breakpoint: 571,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});

// DOUBLESLIDER
 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  arrows: true,
  nextArrow: '<button type="button" class="slick-next"><i class="fas fa-caret-right"></i></button>',
  prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-caret-left"></i></button>',
  focusOnSelect: true,
  vertical: true,
  responsive: [
	{
	  breakpoint: 769,
	  settings: {
		slidesToShow: 2
	  }
	}
  ]
});


// SEARCH
$('#text1, #text2').on('keyup',function(){
  var $this = $(this),
	  val = $this.val();

  if(val.length >= 1){
	$('.show-find').addClass('active').show(100);
  }else {
	$('.show-find').removeClass('active').hide(100);
  }
});


// datetimepicker
$(function () {
	$('#datetimepicker, .datetimepicker-group').datetimepicker({
	  format: 'DD.MM.YY HH:mm',
			locale: 'ru'
	});
});

$(document).on('click', '.custom-input-number .cin-increment', function (e) {
	var $input = $(this).siblings('.cin-input'),
		val = parseInt($input.val()),
		max = parseInt($input.attr('max')),
		step = parseInt($input.attr('step'));

	var temp = val + step;
	$input.val(temp <= max ? temp : max);
	console.log(temp);
});
$(document).on('click', '.custom-input-number .cin-decrement', function (e) {
	var $input = $(this).siblings('.cin-input'),
		val = parseInt($input.val()),
		min = parseInt($input.attr('min')),
		step = parseInt($input.attr('step'));

	var temp = val - step;
	$input.val(temp >= min ? temp : min);

	// console.log(temp);
});

$(function () {
  $('.search-tires-mob .caption i').click(function(){
	var tires = $(this).parents().find('.search-tires-mob');
	$(tires).toggleClass('active');

  });

	$('.search-disc-mob .caption i').click(function(){
	var tires = $(this).parents().find('.search-disc-mob');
	$(tires).toggleClass('active');

  });
});

// OPEN-MOBILE
$(function () {
$('.nav-container-mobile .fa-bars').click(function(){
  var mobileMenu = $('.nav-menu-mobile');
  $(mobileMenu).addClass('active');
});

// CLOSE-MOBILE
$('.close-mobile').click(function(){
  var mobileMenu = $('.nav-menu-mobile');
  $(mobileMenu).removeClass('active');
});
});

// CATALOG-MOBILE-OPEN
$(function () {
  $('.nav-menu-mobile-catalog ul').fadeOut();
$('.nav-menu-mobile-catalog .caption').click(function(){
  var mobileMenu = $(this).next('ul');
  $(mobileMenu).fadeToggle();
});
});

// SHTORM-AVTO-MOR
$(function () {
$('.show-text').click(function(){
  var showtext = $(this).closest('.container').find('.open-text');
  $(showtext).toggleClass('active');
  $(this).fadeOut();

});
});

// FILTER-OPEN
$(function () {
$('.filter-item .name').click(function(){
  var filter = $(this).next('.filter-check');
  var arrow = $(this).find('i');
  $(filter).toggleClass('active');
  $(arrow).toggleClass('active');

});
});

// FILTER-OPEN-MOBILE
$(function () {
$('.filter-container h2 i').click(function(){
  var filter = $('.filter-container');
  if ($(this).is(':visible')) {
  $(filter).toggleClass('active');
}
});
});

// ENROLL-CONTAINER
$('.close-enroll').click(function(){
  var enrolResult = $('.enroll-item .enroll-result');
  var enrolContainer = $('.enroll-container');
  var quantityEnroll = $('.quantity-enroll')
  if (enrolResult.is(':visible')) {
	enrolResult.fadeOut(500);
	enrolContainer.removeClass('active');
  }
	if (quantityEnroll.is(':hidden')) {
	quantityEnroll.addClass('active');
  }
});

$('.open-enroll').click(function(){
  var enrolResult = $('.enroll-item .enroll-result');
  var enrolContainer = $('.enroll-container');
  var quantityEnroll = $('.quantity-enroll')
  if (enrolResult.is(':hidden')) {
	enrolResult.fadeIn(500);
	enrolContainer.addClass('active');
  }
	if (quantityEnroll.is(':visible')) {
	quantityEnroll.removeClass('active');
  }
});

}); //end

