(function () {

function init() {

  $('.js-cityselect').on('change', function () {

    var cityId = $(this).val();

    if (cityId) {
      window.location = '?chcity=' + cityId;
    }

  });
}

if (window.frameCacheVars !== undefined) {
  BX.addCustomEvent('onFrameDataReceived', function() {
    init();
  });
} else {
  BX.ready(function() {
    init();
  });
}

}());