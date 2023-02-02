;(function () {

'use strict';

var Basket = (function () {

  var instance;

  return function BasketConstructor(products) {

    if (instance) {
      return instance;
    }

    if (this && this.constructor === BasketConstructor) {
      this.products = products;
      instance = this;
    } else {
      return new BasketConstructor(products);
    }
  }

}());

Basket.prototype.getProduct = function (data) {

  var product, found;

  if (!data || !data.productId && !data.basketId) {
    return false;
  }

  for (var i = 0; i < this.products.length; i++) {

    product = this.products[i];

    if (product.basketId === data.basketId) {
      return product;
    }

    if (product.productId === data.productId) {

      if (!product.props && !data.props) {
        return product;
      }

      if (product.props && data.props) {

        found = true;

        for (var propName in product.props) {

          if (product.props[propName] !== data.props[propName]) {
            found = false;
            break;
          }
        }

        if (found) {
          return product;
        }
      }
    }
  }

  return false;

};

window.SP = window.SP || {};
window.SP.BasketConstructor = Basket;

}());