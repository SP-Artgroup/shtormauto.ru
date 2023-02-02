(function () {
    function init() {
        $(".city-change__toggle2").click(
                function () {
                    if ($('#geo_confirm2').length <= 0)
                        $(".morecity2").toggle();
                }
        );
        $(document).mouseup(function (e) {
            var container = $(".morecity2");
            
            if (container.has(e.target).length === 0){
               // container.hide();
                $(".morecity2").hide();
            }
        });
    }

    if (window.frameCacheVars !== undefined) {
        BX.addCustomEvent('onFrameDataReceived', function () {
            init();
        });
    } else {
        BX.ready(function () {
            init();
        });
    }
}());