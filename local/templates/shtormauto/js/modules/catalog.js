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
      basketFields = ['product_id', 'price_id', 'quantity'],
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
        }
      }

    };
    console.log(basketData);

    $.ajax({
      type: 'POST',
      url: basketUrl,
      dataType: 'json',
      data: basketData,
      success: ajaxCallback
    });
  },

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