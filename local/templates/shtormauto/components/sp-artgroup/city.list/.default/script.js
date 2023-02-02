(function () {

function init() {
        $(document).on("click", ".city_ip", 
                function () {
                    if ($(".morecity").css("display")=="none"){
                        $(".morecity").show();
                    }else{
                        $(".morecity").hide();
                    }
                }
        );


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