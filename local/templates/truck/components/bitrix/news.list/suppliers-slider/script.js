$(function () {

$('.suppliers-slider').slick({
  slidesToShow: 7,
  slidesToScroll: 1,
  infinite: true,
  dots: false,
  arrows: true,
  nextArrow: '<button type="button" class="slick-next"><img src="' + path.productSlideNext + '"></button>',
  prevArrow: '<button type="button" class="slick-prev"><img src="' + path.productSlidePrev + '"></button>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 6,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 678,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
  ]
});

});