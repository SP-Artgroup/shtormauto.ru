"use strict";

function _toConsumableArray(e) {
    if (Array.isArray(e)) {
        for (var a = 0, t = Array(e.length); a < e.length; a++) t[a] = e[a];
        return t
    }
    return Array.from(e)
}

$(document).ready(function() {
    $(".carousel-main").slick({
        arrows: !1,
        dots: !0,
        autoplay: true,
        autoplaySpeed: 3000
    }), $(".about-page-slider").slick(), $(".form-slider-old").each(function() {
        var e = {
                start: [parseInt($(this).attr("data-start-min")), parseInt($(this).attr("data-start-max"))],
                range: {
                    min: parseInt($(this).attr("data-range-min")),
                    max: parseInt($(this).attr("data-range-max"))
                }
            },
            a = $(this).find("[data-range-slider]")[0],
            t = $(this).find("[data-range-min-input]"),
            n = $(this).find("[data-range-max-input]");
        noUiSlider.create(a, {
            start: e.start,
            connect: !0,
            range: e.range,
            format: wNumb({
                decimals: 0,
                thousand: "",
                prefix: ""
            })
        }), a.noUiSlider.on("update", function(e, a) {
            t.val(e[0]), n.val(e[1])
        }), $(this).find("[data-range-min-input],[data-range-max-input]").on("change", function() {
            var e = [t.val(), n.val()];
            a.noUiSlider.updateOptions({
                start: [].concat(e)
            })
        })
    })
}), $(document).ready(function() {
    $(".form-radio__input").on("change", function() {
        $(this).closest(".form-radio__list").find(".form-radio__item").removeClass("active"), $(this).closest(".form-radio__item").addClass("active")
    })
}), $(document).ready(function() {
    $(".categories-sidebar__link.parent").on("click", function(e) {
        e.preventDefault(), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active")
    }), $(".categories-sidebar__more-link").on("click", function(e) {
        e.preventDefault();
        var a = $(".categories-sidebar__list");
        a.hasClass("opened") ? (a.removeClass("opened"), $(this).text("Развернуть")) : (a.addClass("opened"), $(this).text("Свернуть"))
    })
}), $(document).ready(function() {
    $(".arrow-up").on("click", function() {
        $("body,html").animate({
            scrollTop: 0
        }, 400)
    }), $(window).on("scroll", function() {
        var e = $(".arrow-up");
        400 < $(window).scrollTop() ? e.addClass("visible") : e.removeClass("visible")
    })
}), /*$(document).ready(function() {
    var e = $(".counter"),
        n = function(e) {
            var a = e.action,
                t = e.$counterInput,
                n = e.currentValue;
            "minus" == a ? 0 < n && t.val(n - 1) : "plus" == a && n < 99 && t.val(n + 1);
        };
    e.each(function() {
        var a = $(this).find(".counter__input"),
            e = $(this).find(".counter__minus"),
            t = $(this).find(".counter__plus");
        a.on("blur", function() {
            var e = parseInt(a.val());
            e ? 99 < e ? a.val(99) : a.val(e) : a.val("0")
        }), e.on("click", function() {
            var e = parseInt(a.val());
            n({
                action: "minus",
                currentValue: e,
                $counterInput: a
            })
        }), t.on("click", function() {
            var e = parseInt(a.val());
            n({
                action: "plus",
                currentValue: e,
                $counterInput: a
            })
        })
    })
}),*/ $(document).ready(function() {
    $("[data-change-filter-type]").on("change", function() {
        var e = $(this).val();
        $(".filter-item").hide(), $(".filter-item--" + e).show();
        $(".filter-item--" + e + " option").prop('selected', false);
        $(".filter-item--" + e + " option[value='"+e+"']").prop('selected', true);
    })

    $(".filter-item__select-type input[name='filter-item']").on("change", function() {
        var e = $(this).val();
        $(".filter-item").hide(), $(".filter-item--" + e).show();
    })

    $(".filter-tabs-nav .toggle").on("click", function(){
        var block = $(this).parents('.filter-tabs-nav');
        block.find('.filter-tabs-nav__item:not(.active)').click();
    })

    $("[data-tab-item]").click(function() {
        if (!$(this).hasClass('active')) {
            var switchBtn = $(this).parents('.filter-tabs-nav').find('.toggle');
            if (switchBtn.hasClass('switch-on')) {
                switchBtn.removeClass('switch-on').addClass('switch-off');
            } else {
                switchBtn.removeClass('switch-off').addClass('switch-on');
            }
            var tabsObj = $(this).closest("[data-tabs]"),
              tabId = $(this).attr("data-tab-id");

            tabsObj.find("[data-tab-item]").removeClass("active");
            $(this).addClass("active");

            tabsObj.find("[data-tab-content]").removeClass("active");
            tabsObj.find('[data-tab-content][data-tab-id="' + tabId + '"]').addClass("active");
        }
    })
}),
/*$(document).ready(function() {
    $(".header-basket").on("click", basketPopupHandler), $(".basket-preview, .header-basket").on("click", function(e) {
        e.stopPropagation()
    }), $("body").on("click", function() {
        $(".header-basket").hasClass("active") && basketPopupHandler()
    })
}),*/ $(document).ready(function() {
    $("input[data-masked]").each(function() {
        $(this).mask(String($(this).data("masked")));
    })
}), $(document).ready(function() {
    MicroModal.init({
        awaitCloseAnimation: !0,
        onClose: function(modal){console.log(modal.id); if(modal.id=="modal-registration-ok") location.reload(true);}
    })
}), $(document).ready(function() {
    ymaps.ready(function() {
        $("[data-ymap]").each(function(e, a) {
            var t = $(this).data("ymap"),
                n = new ymaps.Map(this, {
                    center: [].concat(_toConsumableArray(t.coords)),
                    zoom: 15
                }, {
                    searchControlProvider: "yandex#search"
                }),
                i = new ymaps.Placemark(n.getCenter(), {
                    hintContent: t.address,
                    balloonContent: t.address
                }, {
                    iconLayout: "default#image",
                    iconImageHref: "/local/templates/shtormauto/images/icons/i-logo.png",
                    iconImageSize: [].concat(_toConsumableArray(t.placemarkSizes))
                });
            n.geoObjects.add(i)
        })
    })
}), $(document).ready(function() {
    function e() {
        $(".advert-banner-vertical").css("height", $(".product-item").height())
    }
    $(window).resize(e), e()
}), $(document).ready(function() {
    var e = $(".responsive-menu"),
        a = $(".burger__button"),
        t = $(".responsive-menu__close"),
        n = $(".responsive-menu-auth-basket__auth"),
        i = $(".responsive-menu-auth-basket__basket");

    function o() {
        $("html").removeClass("overflow-hidden"), e.removeClass("active")
    }
    a.on("click", function() {
        $("html").addClass("overflow-hidden"), e.addClass("active")
    }), t.on("click", o), n.on("click", function(e) {
        e.preventDefault(), o(), MicroModal.show("modal-auth")
    }), i.on("click", function(e) {
        e.preventDefault(), o(), setTimeout(function() {
            basketPopupHandler()
        }, 0)
    })
}), $(document).ready(function() {
    $(".header");
    var e = $(".top-panel"),
        t = e.outerHeight();

    function a() {
        var e = $(".header"),
            a = $(window).scrollTop();
        t <= a ? (e.addClass("fixed"), $(".wrapper").css("paddingTop", e.height())) : (e.removeClass("fixed"), $(".wrapper").css("paddingTop", 0))
    }
    $(window).on("resize", function() {
        t = e.outerHeight()
    }), $(window).on("scroll", a), a()
}), $(document).ready(function() {
    var e = $("[data-feedback-form]"),
        a = $(".feedback-sidebar__initial"),
        t = $(".feedback-sidebar__sended"),
        n = $(".feedback-sidebar__link-more");
    e.on("submit", function(e) {
        e.preventDefault(), $(this).find("input, textarea").val(""), a.removeClass("visible"), t.addClass("visible")
    }), n.on("click", function(e) {
        e.preventDefault(), a.addClass("visible"), t.removeClass("visible")
    })
}), $(document).ready(function() {
    $("[data-subscription-form]").on("submit", function(e) {
        e.preventDefault(), $("input").val(""), $(".subscription__form").addClass("hide"), $(".subscription__done").removeClass("hide")
    })
});
//# sourceMappingURL=../maps/main.js.map