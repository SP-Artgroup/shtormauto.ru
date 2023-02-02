var template;
var map;
var shops = {};

function renderShops(data) {

  var rendered = Mustache.render(
    template,
    {
      items: data,
    }
  );

  $('.enroll-result').html(rendered);
}

function renderMap(shops) {

  var marks = [];
  var options = {
    iconLayout: "default#image",
    iconImageHref: app.tplPath + '/img/map-marker.png',
    iconImageSize: ['39', '56'],
  };

  shops.forEach(function (shop) {
    marks.push(new ymaps.Placemark(
      shop.location,
      {
        hintContent: shop.name,
        // balloonContent: shop.address
      },
      options
    ));
  });

  map.geoObjects.removeAll();

  marks.forEach(function (mark) {
    map.geoObjects.add(mark);
  });

  if (marks.length > 1) {
    map.setBounds(map.geoObjects.getBounds());
    map.setZoom(12);

    var center = map.getCenter();
    center[1] -= 0.13;
    map.setCenter(center);
  } else {
    map.setCenter(shops[0].location, 15);
  }

}

$(function () {

  template = $('#enroll-items-template').html();
  Mustache.parse(template);

  $('.js-change-enroll-service-city').on('change', function () {

    var cityId = this.value;

    if (shops[cityId]) {
      renderShops(shops[cityId]);
      renderMap(shops[cityId]);
      return;
    }

    $.ajax({
      url: '/local/ajax/components/service-enroll.php',
      dataType: 'json',
      data: {
        cityId: cityId,
      },
      success: function (data) {
        shops[cityId] = data;
        renderShops(data);
        renderMap(data);
      }
    })
  });

  $('.enroll-result').on('click', '.btn2', function () {
    $.fancybox.open({
      src: '/local/ajax/components/service-enroll-form.php',
      type: 'ajax',
      ajax: {
        settings: {
          data: {
            serviceId: this.dataset.shopId,
          }
        }
      },
      touch: false,
    });
  });

  ymaps.ready(function () {
    map = new ymaps.Map(
      'enroll-map', {
        center: [48.180528095205176, 134.84618039440966],
        zoom: 5,
        controls: {},
        margin: 300
      }, {
        searchControlProvider: 'yandex#search',
        yandexMapDisablePoiInteractivity: false,
        suppressMapOpenBlock: true,
        mapAutoFocus: true,
    });
  });

});