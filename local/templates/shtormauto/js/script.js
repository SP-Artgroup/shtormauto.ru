$(function () {
    $('.header .btn-search').click(function () {
        $('#title-search').show();
    });
    $('#menu-toggle').click(function () {
        var menu = $('#main-menu');
        $('#sticky-search').removeClass('active').hide();
        $('#search-toggle').removeClass('over');
        $('.section-menu-mobile').removeClass('active').hide();
        $('.section-toggle').removeClass('over');
        if (menu.hasClass('active')) {
            menu.fadeOut(100);
            menu.removeClass('active');
            $('#nav-toggle').removeClass('open');
            $(this).removeClass('over')
        } else {
            menu.fadeIn(100);
            menu.addClass('active');
            $('#nav-toggle').addClass('open');
            $(this).addClass('over')
        }
    });

    $('body').on('click', '.section-toggle', function (e) {
        var sections = $('.section-menu-mobile');
        $('#sticky-search').removeClass('active').hide();
        $('#search-toggle').removeClass('over');
        $('#main-menu').removeClass('active').hide();
        $('#nav-toggle').removeClass('open');
        $('#menu-toggle').removeClass('over');
        if (sections.hasClass('active')) {
            sections.fadeOut(100);
            sections.removeClass('active');
            $(this).removeClass('over')
        } else {
            sections.fadeIn(100);
            sections.addClass('active');
            $(this).addClass('over')
        }
    });

    // $(".fancybox").fancybox();

//  $('a.big-img').fancybox({
//    'transitionIn': 'elastic',
//    'transitionOut': 'elastic',
//    'speedIn': 600,
//    'speedOut': 400,
//    'overlayShow': false,
//    'cyclic': true,
//    'padding': 20,
//    'titlePosition': 'over',
//    'onComplete': function () {
//      $("#fancybox-title").css({
//        'top': '100%',
//        'bottom': 'auto'
//      });
//    }
//  });

    $(".phone").mask("+7 (999) 999-9999");

    $('.privacy_policy_link').click(function () {

        $('.privacy_policy_text').slideToggle();

        return false;
    });

    /*$('[data-tooltip!=""]').qtip({ // Grab all elements with a non-blank data-tooltip attr.
     content: {
     attr: 'data-tooltip' // Tell qTip2 to look inside this attr for its content
     }
     });*/

//  $("#banner_slider_on_main").owlCarousel({
//    navigation: true, // Show next and prev buttons
//    pagination: false,
//    slideSpeed: 300,
//    paginationSpeed: 400,
//    singleItem: true,
//    autoPlay: 5000,
//  });

    $('#geo_confirm .close').click(function () {
        $('#geo_confirm').remove();
        return false;
    });

//    $('.js-minus').click(function () {
//        var idform = $(this).attr('rel');
//        var kol_tov = parseInt($('#quan_' + idform).val());
//        if (kol_tov > 1) {
//            $('#quan_' + idform).val(kol_tov - 1);
//        }
//    });
//
//    $('.js-plus').click(function () {
//        $.fancybox.showLoading();
//
//        var idform = $(this).attr('rel');
//        var kol_tov = parseInt($('#quan_' + idform).val());
//        $('#quan_' + idform).val(kol_tov + 1);
//
//        $.fancybox.hideLoading();
//    });

    //Ф-ия обработки событий клика по купить
//    $(document).on('click', '.action_ajax', function () {
//
//        var this_object = this;
//        var this_href = $(this).attr('href');
//
//        var id = parseInt(this_href.replace(/\D+/g, ""));
//        var name = $(this).parents('.catalog-item').find('img').attr('alt');
//        var price = $(this).parents('.catalog-item').find('.catalog-price').text();
//        price = parseInt(price.replace(/\D+/g, ""));
//
//        if ((id === undefined) || (name === undefined) || (price === NaN)) {
//            var name = $(this).parents('.properties').find('h1').text();
//            var price = $(this).parents('.properties').find('.catalog-price').text();
//
//            price = parseInt(price.replace(/\D+/g, ""));
//
//            if ((id === undefined) || (name === '') || (price === NaN)) {
//                var name = $(this).parents('.tires').find('a').text();
//                var price = $(this).parents('.tires').find('.catalog-price').text();
//                price = parseInt(price.replace(/\D+/g, ""));
//            }
//        }
//
//        if ($(this).hasClass('quantity_enable')) {
//            if ($('#quan_' + $(this).attr('rel')).length > 0) {
//                var quantity = $('#quan_' + $(this).attr('rel')).val();
//
//                this_href += '&quantity=' + quantity;
//            }
//        }
//
//        if ((id !== undefined) && (name !== undefined) && (price === NaN)) {
//
//            window.dataLayer.push({
//                "ecommerce": {
//                    "add": {
//                        "products": [{
//                                "id": id,
//                                "name": name,
//                                "price": price,
//                                "quantity": quantity
//                            }]
//                    }
//                }
//            });
//
//        }
//
//        $.ajax({
//            type: "GET",
//            url: this_href,
//            dataType: "json",
//            success: function (in_data) {
//
//                if (in_data.basket_count !== undefined) {
//                    $('.top_cart .basket_small_count').html(in_data.basket_count);
//                }
//                if (in_data.basket_price !== undefined) {
//                    $('.top_cart .basket_small_price').html(in_data.basket_price);
//                }
//            }
//        });
//
//        return false;
//    });
});

/*
 **  Author: Vladimir Shevchenko
 **  URI: http://www.howtomake.com.ua/2012/stilizaciya-vsex-elementov-form-s-pomoshhyu-css-i-jquery.html
 */

jQuery(document).ready(function () {
    //Reset form
    // Вешаем событие клика по кнопке сброса
    jQuery('.reset-form').click(function () {
        // Устанавливаем пустое значение в атрибут value для всех инпутов
        jQuery('.customForm').find('input').val('');

        // Убираем атрибут checked и класс активности у чекбоксов
        jQuery('.customForm').find('input:checked').removeAttr('checked');
        jQuery('.customForm').find('.check').removeClass('active');

        // Убираем класс активности у радио переключателей
        jQuery('.customForm').find('.radio').removeClass('active');

        // Устанавливаем пустое значение в атрибут value для всех textarea
        jQuery('.customForm').find('textarea').val('');

        // И для открывалки селекта возвращаем начальное значение
        jQuery('.customForm').find('.slct').html('Выберите Ваше лучшее качество:');
    });

    // = Load
    // отслеживаем изменение инпута file
    jQuery('#file').change(function () {
        // Если файл прикрепили то заносим значение value в переменную
        var fileResult = jQuery(this).val();
        // И дальше передаем значение в инпут который под загрузчиком
        jQuery(this).parent().find('.fileLoad').find('input').val(fileResult);
    });

    /* Добавляем новый класс кнопке если инпут файл получил фокус */
    jQuery('#file').hover(function () {
        jQuery(this).parent().find('button').addClass('button-hover');
    }, function () {
        jQuery(this).parent().find('button').removeClass('button-hover');
    });

    // Checkbox
    // Отслеживаем событие клика по диву с классом check
    jQuery('.checkboxes').find('.check').click(function () {
        // Пишем условие: если вложенный в див чекбокс отмечен
        if (jQuery(this).find('input').is(':checked')) {
            // то снимаем активность с дива
            jQuery(this).removeClass('active');
            // и удаляем атрибут checked (делаем чекбокс не отмеченным)
            jQuery(this).find('input').removeAttr('checked');

            // если же чекбокс не отмечен, то
        } else {
            // добавляем класс активности диву
            jQuery(this).addClass('active');
            // добавляем атрибут checked чекбоксу
            jQuery(this).find('input').attr('checked', true);
        }
    });

    (function () {
        var dropBlock;
        // Select
        //jQuery('.slct').click(function(){
        $(document).on('click', '.slct', function () {
            /* Заносим выпадающий список в переменную */
            dropBlock = jQuery(this).parent().find('.drop');

            /* Делаем проверку: Если выпадающий блок скрыт то делаем его видимым*/
            if (dropBlock.is(':hidden')) {
                dropBlock.slideDown();

                /* Выделяем ссылку открывающую select */
                jQuery(this).addClass('active');

                /* Продолжаем проверку: Если выпадающий блок не скрыт то скрываем его */
            } else {
                jQuery(this).removeClass('active');
                dropBlock.slideUp();
            }

            /* Предотвращаем обычное поведение ссылки при клике */
            return false;
        });

        /* Работаем с событием клика по элементам выпадающего списка */
        //jQuery('.drop').find('li').click(function(){
        $(document).on('click', '.drop li', function () {

            /* Заносим в переменную HTML код элемента
             списка по которому кликнули */
            var selectResult = jQuery(this).html();

            $('.city_wrap').hide();
            $('.city_wrap[rel="' + $(this).attr('rel') + '"]').show();

            $('.city_wrap[rel="' + $(this).attr('rel') + '"] .radio').eq(0).trigger('click');

            /* Находим наш скрытый инпут и передаем в него
             значение из переменной selectResult */
            jQuery(this).parent().parent().find('input').val(selectResult);

            /* Передаем значение переменной selectResult в ссылку которая
             открывает наш выпадающий список и удаляем активность */
            jQuery('.slct').removeClass('active').html(selectResult);

            /* Скрываем выпадающий блок */
            dropBlock.slideUp();
        });
    })();

    // RadioButton
    //jQuery('.radioblock').find('.radio').click(function(){
    $(document).on('click', '.radioblock .radio', function () {
        var valueRadio = jQuery(this).html();

        if (jQuery(this).attr('value') != undefined)
            valueRadio = jQuery(this).attr('value');

        jQuery(this).parents('.radioblock').find('.radio').removeClass('active');
        jQuery(this).addClass('active');
        //jQuery(this).parent().find('input').val(valueRadio);
    });

});

//function send_in_cart(x) {
//
//    $element = $('#' + x + ' img');
//    var $picture = $element.clone();
//    var pictureOffsetOriginal = $element.offset();
//
//    $picture.css({
//        'position': 'absolute',
//        'z-index': '1000',
//        'top': pictureOffsetOriginal.top,
//        'left': pictureOffsetOriginal.left,
//        'right': 'auto',
//        'bottom': 'auto'
//    });
//
//    var cartBlockOffset = $('.top_cart').offset();
//
//    $picture.appendTo('body');
//
//    $picture
//            .animate({
//                'width': $element.attr('width') * 0.20,
//                'height': $element.attr('height') * 0.20,
//                'opacity': 0.2,
//                'top': cartBlockOffset.top + 0,
//                'left': cartBlockOffset.left - 50
//            }, 1000)
//            .fadeOut(100, function () {
//                /*тут процедура обновления корзины + добавление товара*/
//            });
//}

//function animate_this_to_basket(x) {
//    $element = $(x);
//
//    var cartBlockOffset = $('.top_cart').offset();
//
//    $('<img src="/local/templates/adaptive/images_new/button_pokupka.png" id="temp_cart_animate" style="z-index: 2000; position: absolute; top:' + Math.ceil($element.offset().top) + 'px; left:' + Math.ceil($element.offset().left) + 'px;">').prependTo('body');
//
//    $('#temp_cart_animate').animate({
//        'width': $element.attr('width') * 0.20,
//        'height': $element.attr('height') * 0.20,
//        'opacity': 0.2,
//        'top': cartBlockOffset.top + 0,
//        'left': cartBlockOffset.left - 50
//    },
//            1000,
//            function () {
//                $('#temp_cart_animate').remove();
//            }
//    );
//}


/*new*/


function ajaxpostshow(urlres, datares, wherecontent) {
    $.ajax({
        type: "POST",
        url: urlres,
        data: datares,
        dataType: "html",
        success: function (fillter) {
            $(wherecontent).html(fillter);
        }
    });
}
function AddToBasketAjaxNew() {
    ajaxpostshow("/ajax/basket.php", '', ".new-basket-small");
    return false;
}
$('.product-item__buy-btn').on("click", AddToBasketAjaxNew);
$('.js-buy-btn').on("click", AddToBasketAjaxNew);
/* Изменить количество товара */
$(".header-basket .basket-item__info  .counter__input").on("input", function () {
    var countbasketid = $(this).attr('data-id');
    var countbasketcount = $(this).val();
    var ajaxcount = 'ajaxbasketcountid=' + countbasketid + '&ajaxbasketcount=' + countbasketcount + '&ajaxaction=update'+ '&productID='+ $(this).attr('data-productID') + '&storeID='+ $(this).attr('data-store');
    ajaxpostshow("/ajax/basket.php", ajaxcount, ".new-basket-small");
    return false;
});

function refreshSmallBasket(data) {
  data = data || '';
  ajaxpostshow("/ajax/basket.php", data, ".new-basket-small");
}
