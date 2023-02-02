BX.ready(function () {

  var $quantityInput;
  var isCouponActionSend = false;

var checkDiscount = document.querySelectorAll('.js-add-discount');

   for(let i = 0; i < checkDiscount.length; i ++)  {

       if(localStorage.getItem('item-'+checkDiscount[i].getAttribute("data-id"))){
        checkDiscount[i].setAttribute('checked', 'true');
       }
    }

  function updateQuantity(basketId, shopId, quantity, mode) {

    var $localQuantityInput = $quantityInput;
    if (isNaN(quantity)) {
      return;
    }
    switch (mode) {
    case 'up':
      ++quantity;
      break;
    case 'down':
      if (quantity <= 1) {
        return;
      }
      --quantity;
      break;
    default:
      if (quantity < 1) {
        return;
      }
      break;
    }

    var postData = {
      basket_id: basketId,
      store_id: shopId,
      quantity: quantity,
    };
  
    BX.ajax({
      url: '/local/ajax/action.php?action=basket_change_quantity',
      method: 'POST',
      data: postData,
      dataType: 'json',
      onsuccess: function (result) {
        var quantity, originalValue;
        if (result.ERRORS.length !== 0) {
          if (result.ERRORS.quantity) {
            SP.Catalog.showBuyError($localQuantityInput.parent(), {
              message: result.ERRORS.quantity
            });
          }
          return;
        }
        if (result.added_product) {
          
          quantity = parseInt(result.added_product.quantity);
          $localQuantityInput.val(quantity);
          $localQuantityInput.parents('.rowItem').find('.table-total-price-value .table__price-current').html(result.added_product.formatSum);
        }
        if (result.basket_price) {
          $('.table-total-price-value-itog').html(result.basket_price);
        }

        $.ajax({
          url: '/ajax/full_basket.php?',
          method: 'GET',
          dataType: 'html',
          success: function (html) {
            $('.basket-full').html($(html).html());
            refreshSmallBasket({showOpenList: 'N'});
          }
        });

        refreshSmallBasket({showOpenList: 'N'});
      }
    });
  }

  function addCoupon(coupon) {
     localStorage.setItem('item'+idProduct, idProduct);
    couponAction({
      action: 'addCoupon',
      coupon: coupon,
    });
  }

  function removeCoupon() {
    couponAction({
      action: 'removeCoupon',
    });
  }

  function couponAction(data) {
    $.ajax({
      url: '/ajax/full_basket.php?' + $.param(data),
      method: 'GET',
      dataType: 'html',
      success: function (html) {
        $('.basket-full').html($(html).html());
        refreshSmallBasket({showOpenList: 'N'});
      }
    });
  }

  function applyDiscount(idProduct) {
    let nameSt = 'item-'+idProduct;

    data = {idProduct: idProduct};
    $.ajax({
      url: '/local/ajax/discount.php?' + $.param(data),
      method: 'GET',
      dataType: 'html',
      success: function (html) {
        $('.basket-full').html($(html).html());
        refreshSmallBasket({showOpenList: 'N'});

        let checkDiscount = document.querySelectorAll('.js-add-discount');

           for(let i = 0; i < checkDiscount.length; i ++)  {

               if(localStorage.getItem('item-'+checkDiscount[i].getAttribute("data-id"))){
                checkDiscount[i].setAttribute('checked', 'true');
               }
            }
      }
    });
  }

  $('.basket-full')
    .on('input', '.counter__input', function () {
      $quantityInput = $(this);
      updateQuantity(
        $(this).attr('data-id'),
        $(this).attr('data-shopId'),
        $quantityInput.val(),
        $(this).attr('data-mode')
      );
    })
    .on('click', '.counter__plus', function () {
      $quantityInput = $(this).prev();
      updateQuantity(
        $quantityInput.attr('data-id'),
        $quantityInput.attr('data-shopId'),
        $quantityInput.val(),
        'up'
      );
    })
    .on('click', '.counter__minus', function () {
      $quantityInput = $(this).next();
      updateQuantity(
        $quantityInput.attr('data-id'),
        $quantityInput.attr('data-shopId'),
        $quantityInput.val(),
        'down'
      );
    })


    .on('click', '.js-remove-coupon', function () {
      removeCoupon();
    })
    .on('keyup paste', '.js-coupon', function (e) {
      var coupon;

      if (e.type === 'paste') {
        coupon = e.originalEvent.clipboardData.getData('text');
      } else if (e.keyCode == 13) {
        coupon = this.value;
      }

      if (coupon) {
        addCoupon(coupon);
      }
    })
    .on('click', '.js-add-coupon', function () {
      addCoupon($('.js-coupon').val());
    })


    .on('click', '.js-add-discount', function () {
      let idProduct = $(this).siblings(".js-id-product").val();

      let nameSt = 'item-'+idProduct;
      if (localStorage.getItem(nameSt) == null) {
 
      localStorage.setItem(nameSt, idProduct);
        
      } else {

      localStorage.removeItem(nameSt);
      
      }

      applyDiscount(idProduct);
    })


});
