(function () {
    function init() {
        $(".city-change__toggle").click(
                function () {
                    if ($('#geo_confirm').length <= 0)
                        $(".morecity").toggle();
                }
        );
        $(document).mouseup(function (e) {
            var container = $(".morecity");
            
            if (container.has(e.target).length === 0){
               // container.hide();
                $(".morecity").hide();
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