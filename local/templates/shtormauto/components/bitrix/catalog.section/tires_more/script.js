BX.ready(function () {

  $('.similar-products-list .js-buy-btn').on('click', function (argument) {

    var $this = $(this),
      $tableRow      = $this.parents('.tires'),
      $selectedStore = $('.select-store .current-store', $tableRow),
      storeId        = $selectedStore.data('storeId'),
      storeAmount    = $selectedStore.data('storeAmount');

    var data = {
      product_id  : $this.data('productId'),
      price_id    : $this.data('priceId'),
      image       : $this,
      // price       : this.currentPrices[0].PRICE,
      // name        : this.product.name,
      quantity    : 1,
      store_amount: storeAmount,
    };

    if (!storeId) {
      $('.select-store .current-store-wrapper', $tableRow)
        .addClass('focused')
        .focus()
        .focusout(function () {
          $(this).removeClass('focused');
        });
      return;
    }

    data.store_id = storeId;

    SP.Catalog.buyProduct(data, null, function (data) {
      SP.Catalog.showBuyError($('.similar-products-store-list', $tableRow), data);
    });

  });

});