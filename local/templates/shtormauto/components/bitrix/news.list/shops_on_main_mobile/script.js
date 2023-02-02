$(document).ready(function() {
	$(".gps_link").click(function(e){
		e.preventDefault();
		var those = $(this);
		var address_view = $("#address_view");
		address_view.addClass("open");
		var coordinat = those.attr("data");
		var arr_coordinat = coordinat.split(",");
		var lat = arr_coordinat[0];
		var lot = arr_coordinat[1];

		var yandex_link = "https://yandex.ru/maps/?rtext=~"+lat+"%2C"+lot+"";
		var google_link = "http://maps.apple.com/?daddr="+lat+","+lot+"&dirflg=d";
		var twoGis_link = "dgis://2gis.ru/routeSearch/rsType/car/to/"+lot+","+lat;

		address_view.find("#y_link").attr("href", yandex_link);
		address_view.find("#g_link").attr("href", google_link);
		address_view.find("#two_link").attr("href", twoGis_link);

		var addres = those.parent().find(".detail_link").html();
		address_view.find(".select-navigation__address").html(addres);
	});
	$(".modal_view > .cancel").click(function(e){
		e.preventDefault();
		var modal_view = $(this).parent();
		modal_view.removeClass("open");
	});
});