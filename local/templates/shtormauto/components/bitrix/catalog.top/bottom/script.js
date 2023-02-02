
function SliderItem (data) {
  this.data = data;
}

;(function () {

function init() {
  $('#slider').lightSlider({
    slideMargin: 20,
    speed: 500,
    autoWidth: true,
    loop: false,
    item: 4
  });

  $('.js-buy-btn')
}

if (window.frameCacheVars !== undefined) {
  BX.addCustomEvent("onFrameDataReceived" , function() {
    init();
  });
} else {
  BX.ready(function() {
    init();
  });
}

}());