var btn_cart = {
    callback:function(){
        window.location.href = "/mobile_app/personal/cart/";
    },
    id: "btncart",
    badgeCode:"btncart",
    type:"cart_icon",
    bar_type: "navbar",
    position: "right"
};
//BXMobileApp.UI.Page.TopBar.addRightButton(btn_cart);

var btn_menu = {
    callback:function(){
        app.openLeft();
    },
    id: "btnmenu",
    badgeCode:"btnmenu",
    type:"menu",
    bar_type: "navbar",
    position: "left"
};

app.addButtons({
    menu: btn_menu,
    cart: btn_cart
});

$(document).ready(function () {

    var start_date = new Date();
    var today = new Date(start_date.getFullYear(), start_date.getMonth(), start_date.getDate()).valueOf();
    var start_date_str = [start_date.getDate(), start_date.getMonth()+1, start_date.getFullYear()].join(".");


    $('.top-carousel').owlCarousel({
       items:1,
        loop:true,
        margin:10,
        nav:true,
        margin:10,
        autoHeight:false,
        loop:true,
        autoplay: true,
        pagination:true,
        nav: false,
        paginationNumbers:true,
        autoplayTimeout: 3000
    });
    $('#newitems-carousel').owlCarousel({
        items:3,
        margin:12,
        autoHeight:false,
        loop:true,
        dots:false,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
    });

    //$('.phonenumber').inputmask("+7 999 999 99 99");

    //$('.postindex').inputmask("999 999");

    //$('.card-number').inputmask("9999 9999 9999 9999");

    //$('.card-date').inputmask("99 / 99");

    //$('.card-cvc').inputmask("9{3}");

    //$('.masktoupper').inputmask({
    //    mask: "X",
    //    repeat: "*",
    //    greedy: false,
    //    definitions: {
    //        "X": { casing: "upper" }
    //    }
    //});

/*    $('.datepick').on('focus', function(){
        var ob = $(this);
        app.showDatePicker({
            "format":"dd.MM.yyyy",
            "start_date":start_date_str,
            "type":'date',
            "callback": function(d){
                var dateArr = d.split(".");
                var selectedDate = new Date(dateArr[2], dateArr[1], dateArr[0]).valueOf();
                if (selectedDate > today - 86400000) {
                    ob.val(d);
                    start_date_str = d;
                } else {
                    alert("Вы выбрали неверную дату.");
                }
            }
        });
    });*/

    $('.add-to-cart').on('click', function(){
        var product_id = $(this).attr('data-id');
        if(product_id) {
            add2basket(product_id);
        }
    });

    function add2basket(id) {
        $.ajax({
            'url': '/mobile_app/ajax.php',
            'type': "POST",
            "data": {
                "action": "Add2Basket",
                "PRODUCT_ID": id
            },
            success: function(res){
                res = $.parseJSON(res);
                show_notification(res.msg, res.status);
                if(res.count) {
                    var ob = $(".add-to-cart[data-id="+id+"]");
                    if(!ob.length) {
                        ob = $(".add-to-cart-border[data-id="+id+"]");
                    }
                    ob.removeClass("adpt-btn-red").addClass("adpt-btn-red-border").text("В корзине ("+res.count+")")
                }
                if(res.status) setCartBadge(res.total);
            }
        });
    }

    function show_notification(text, status){
        status = status ? "ok" : "error";
        var note = $("<div/>").addClass("basket_notification-"+status).text(text);
        note.appendTo($("body"));
        note.fadeOut(3000);
    }
});
$(document).ready(function () {
    var d = new Date();
    var curr_date = d.getDate();
    var  curr_month = d.getMonth() + 1;
    if (curr_month<10){
        curr_month="0"+curr_month;
    }
    var curr_year = d.getFullYear();
    var minDate = curr_year + "-" + curr_month + "-" + curr_date;
    $("#minDate").attr('min', minDate);
});

function setCartBadge(number) {
    number = parseInt(number);
    if(number) {
        var existed = $(".nav-cart-icon").closest("div").find(".cart-badge");
        if(existed.length) {
            existed.text(number);
        } else {
            var badge = $("<div/>").addClass("cart-badge").attr("onclick", "window.location.href='/mobile_app/personal/cart/'").text(number);
            badge.appendTo($(".nav-cart-icon").closest("div"));
        }
    } else {
        $(".nav-cart-icon").closest("div").find(".cart-badge").remove();
    }
}

function setPageTitle(ob){
    var type = ob.type ? ob.type : "text";
    var pageTitle = $(".top-nav-bar").find(".page-title");
    if(pageTitle.length){
        pageTitle.empty();
        switch(type){
            case "image":
                var image = $("<img/>").attr("src", ob.content).addClass("page-title-image");
                image.appendTo(pageTitle);
                break;
            case "text":
                var title = $("<p/>").addClass("page-title-text").text(ob.content);
                title.appendTo(pageTitle);
                break;
        }
    }
}
