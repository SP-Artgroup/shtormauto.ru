$(document).ready(function() {
	var a = $(".header-search__input"),
		e = $(".header-search__button-close");

	function n() {
		a.attr("placeholder", 768 <= $(window).width() ? "Поиск в ШтормАвто" : "Поиск по сайту")
	}
	if ($(window).width() > '767'){
		$(window).resize(n), n(), a.on("input", function() {
			$(this).val() ? e.show() : e.hide()
		}), e.on("click", function() {
			a.val("").focus(), e.hide()
		});
	}
	else{
		e.on("click", function() {
			$('#title-search').hide();
		});
	}
});