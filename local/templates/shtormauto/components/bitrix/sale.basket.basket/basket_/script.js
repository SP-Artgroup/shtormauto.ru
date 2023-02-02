BX.ready(function () {

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
      store_id : shopId,
      quantity : quantity,
    };

    BX.ajax({
        url      : '/local/ajax/action.php?action=basket_change_quantity',
        method   : 'POST',
        data     : postData,
        dataType : 'json',
        onsuccess: function (result) {

          var quantity, originalValue;

          if (result.ERRORS.length !== 0) {

            if (result.ERRORS.quantity) {

              if (originalValue = $localQuantityInput.data('originalValue')) {
                $localQuantityInput.val(originalValue);
                $localQuantityInput.data('originalValue', '');
              }
              SP.Catalog.showBuyError($localQuantityInput.parent(), {message: result.ERRORS.quantity});
            }

            return;
          }

          if (result.added_product) {
            quantity = parseInt(result.added_product.quantity);
            $localQuantityInput.val(quantity);
            $localQuantityInput.parents('.nt_table_item').find('.sum').text(result.added_product.formatSum);
          }

          if (result.basket_price) {
            $('.itogo_price').text('ИТОГО: ' + result.basket_price);
          }

          if (result.basket_count !== undefined) {
            $('.top_cart .basket_small_count').html(result.basket_count);
          }

          if (result.basket_price !== undefined) {
            $('.top_cart .basket_small_price').html(result.basket_price);
          }
        }
    });
  }

  function getQuantityInput(element) {
    return $(element).parents('.quan_form').find('.quan');
  }

  var $quantityInput;

  $('.quan_form .change_quantity_del').on('click', function () {

    $quantityInput = $(getQuantityInput(this));

    var quantity = parseInt($quantityInput.val());

    $quantityInput.data('originalValue', quantity);

    updateQuantity(
      $quantityInput.data('id'),
      $quantityInput.data('shopId'),
      quantity,
      $(this).data('mode')
    );
  });

  $('.quan_form .quan')
    .on('focus', function() {
      $(this).data('originalValue', this.value);
    })
    .on('blur', function () {

      var $this = $(this);

      $quantityInput = $this;

      if (isNaN(this.value) || this.value < 1) {
        this.value = $this.data('originalValue');
        $this.data('originalValue', '');
        return;
      }

      updateQuantity(
        $this.data('id'),
        $this.data('shopId'),
        parseInt($this.val())
      );

    });
});