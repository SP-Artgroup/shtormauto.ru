$(function () {

var $element = $('.product-detail'),
  $currentStore = $('.select-store .current-store', $element);

$('.js-buy-btn', $element).on('click', function () {

  var data = elementData,
    storeId = getStoreId(),
    quantity = $('.counter__input', $element).val();

  if (!storeId) {
    storeSelectFocus();
    return;
  }

  data.store_id = storeId;
  data.quantity = quantity;
  data.image    = $('.product-detail-image img', $element);

  SP.Catalog.buyProduct(data, null, function (data) {
    SP.Catalog.showBuyError($('.catalog-element-store-list'), data);
  });
});

$('.counter__minus, .counter__plus', $element).on('click', function () {

  var $this = $(this),
    storeId = getStoreId(),
    quantity;

  if (!storeId) {
    storeSelectFocus();
    return;
  }

  quantity = parseInt($('.counter__input', $element).val());

  if (isNaN(quantity)) {
    return;
  }

  if ($this.hasClass('counter__plus')) {
    ++quantity;

    if (quantity > $currentStore.data('storeAmount')) {
      return;
    }

  } else if ($this.hasClass('counter__minus')) {
    --quantity;

    if (quantity < 1) {
      return;
    }
  }

  $('.counter__input', $element).val(quantity);

});

$('.counter__input', $element)
  .on('focus', function () {

    if (!getStoreId()) {
      storeSelectFocus();
      return;
    }

    $(this).data('originalValue', this.value);
  })
  .on('blur', function () {

    var quantity = parseInt(this.value),
      storeAmount = $currentStore.data('storeAmount'),
      newValue;

    if (isNaN(quantity)) {
      newValue = $(this).data('originalValue');
    } else if (quantity < 1) {
      newValue = 1;
    } else if (quantity > storeAmount) {
      newValue = storeAmount;
    } else {
      newValue = quantity;
    }

    this.value = newValue;
  });

$('.select-store .store-option', $element).on('click', function () {

  if ($(this).data('storeId') !== getStoreId()) {
    $('.counter__input', $element).val(1);
  }

});

function storeSelectFocus() {
  $('.select-store .current-store-wrapper', $element)
    .addClass('focused')
    .focus()
    .focusout(function () {
      $(this).removeClass('focused');
    });
}

function getStoreId() {
  return parseInt($currentStore.data('storeId'));
}

});