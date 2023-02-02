(function () {

function init() {

  var morecity;

  $(".city_ip").hover(
    function () {
      if ($('#geo_confirm').length <= 0)
        $(".morecity").show();
    },
    function () {
      if($('#geo_confirm').length <= 0)
        $(".morecity").hide();
    }
  );

  $(".morecity").hover(
    function(){$(this).show();},
    function(){$(this).hide();}
  );
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