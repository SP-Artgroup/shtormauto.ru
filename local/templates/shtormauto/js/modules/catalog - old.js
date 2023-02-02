(function () {

'use strict';

var catalogModule = {

  ajaxPath: '/local/ajax/action.php?action=add_to_basket',


  /**
   * @param  {object} data
   * @param  {function} successCallback
   * @param  {function} failureCallback
   * @return {[type]}
   */
  buyProduct: function (data, successCallback, failureCallback) {

    var that = this,
      basketFields = ['product_id', 'price_id', 'store_id', 'quantity'],
      gtmFields = ['name', 'price', 'quantity'],
      gtmPush = false,
      basketData = {},
      maxQuantityError = {
        error: 'max_quantity',
        message: 'Невозможно добавить данное количество',
      },
      basketUrl,
      basketProduct;

    var
      useSuccessCallback = typeof successCallback === 'function',
      useFailureCallback = typeof failureCallback === 'function';

    if (typeof data !== 'object' || $.isEmptyObject(data)) {
      return false;
    }

    for (var i = 0; i < basketFields.length; i++) {

      var field = basketFields[i];

      if (data[field]) {
        basketData[field] = parseInt(data[field]);
      } else {
        console.log('Недостаточно данных для добавления в корзину');
        return false;
      }

    }

    if (data.store_amount) {

      basketProduct = SP.Basket.getProduct({
        productId: basketData.product_id,
        props: {
          store_id: basketData.store_id
        }
      });

      if (basketProduct) {

        var futureQuantity = basketProduct.quantity + basketData.quantity;

        if (futureQuantity > data.store_amount) {

          if (useFailureCallback) {
            failureCallback(maxQuantityError);
          }

          return;
        }

      } else if (basketData.quantity > data.store_amount) {

        if (useFailureCallback) {
          failureCallback(maxQuantityError);
        }

        return;
      }
    }

    basketUrl = this.ajaxPath;// + '&' + $.param(basketData);

    gtmPush = gtmFields.every(function (field) {
      return data[field];
    });

    if (gtmPush) {
      window.dataLayer.push({
        "ecommerce": {
          "add": {
            "products": [{
              "id": data.product_id,
              "name": data.name,
              "price": data.price,
              "quantity": data.quantity
            }]
          }
        }
      });
    }

    var ajaxCallback = function (answer) {

      if (!(answer.ERRORS instanceof Array)) {

        if (answer.ERRORS.store_amount) {

          if (useFailureCallback) {
            failureCallback(maxQuantityError);
          }
        }

        return;
      }

      if (useSuccessCallback) {
        successCallback();
      }

      if (data.defaultCallback !== false) {

        if (data.image) {
         // that.animateBasketImg(data.image);
        }

/*        if (answer.basket_count !== undefined) {
          $('.top_cart .basket_small_count').html(answer.basket_count);
        }

        if (answer.basket_price !== undefined) {
          $('.top_cart .basket_small_price').html(answer.basket_price);
        }*/
      }

    };

    $.ajax({
      type: 'POST',
      url: basketUrl,
      dataType: 'json',
      data: basketData,
      success: ajaxCallback
    });
  },

/*  animateBasketImg: function (selector) {

    var $element = $(selector);

    if (!$element || !$element.length) {
      return;
    }

    var $picture = $element.clone();
    var pictureOffsetOriginal = $element.offset();

    $picture.css({
      'position': 'absolute',
      'z-index': '1000',
      'top': pictureOffsetOriginal.top,
      'left': pictureOffsetOriginal.left,
      'right': 'auto',
      'bottom': 'auto'
    });

    // var pictureOffset = $picture.offset();
    var cartBlockOffset = $('.top_cart').offset();

    $picture.appendTo('body');

    $picture
      .animate({
        'width': $element.attr('width') * 0.20,
        'height': $element.attr('height') * 0.20,
        'opacity': 0.2,
        'top': cartBlockOffset.top + 0,
        'left': cartBlockOffset.left - 50
      }, 1000)
      .fadeOut(100, function () {
        
      });
  },*/

  showBuyError: function (container, error, settings) {

    var className = 'buy-error-message',
      $container;

    if (!container) {
      return;
    }

    $container = $(container);

    if (!$container || !$container.length) {
      return;
    }

    if (typeof settings === 'object') {
      className = settings.className;
    }

    var errorBox = $('<div>', {
      'class': className,
      'text': error.message,
    });

    if (!$container.find('.' + className).length) {

      $container.append(errorBox);

      $(errorBox).fadeIn();

      setTimeout(function () {
        $(errorBox).fadeOut(function () {
          $(this).remove();
        });
      }, 1500);
    }
  }

};

window.SP = window.SP || {};

window.SP.Catalog = catalogModule;

}());