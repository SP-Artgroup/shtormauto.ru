(function () {

    function init() {

        //var morecity;
        $(".city_ip").click(
                function () {
                    if ($('#geo_confirm').length <= 0)
                        $(".morecity").toggle();
                }
        );
        $(document).mouseup(function (e) {
            var container = $(".morecity");
            console.log(e);
            if (container.has(e.target).length === 0){
                container.hide();
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