$(document).ready(function () {
  var SelectCar = function () {
    var apiUrl = '/api/get-car'

    var $grzNumberInput = $('.grz_number');
    var $grzRegionInput = $('.grz_region');
    var $getCarButton = $('.send_grz_button');

    var $carNameBlock = $('.js-car-name');
    var $carEngineBlock = $('.js-car-engine');
    var $carDriveBlock = $('.js-car-drive');
    
    var $carResultBlock = $('.js-car-select-result').first();

    var $toggleParamsButton = $('.toggle.switch-on');
    var $selectOtherButton = $('.js-select-other-car');

    var selectTabSelector = '.select-car-type__item';
    var selectContentSelector = '.select-car-content';
    var formGroupSelector = '.form-group';
    var loaderSelector = '.auto-loader';
    var wrapperSelector = '.filter-item';
    var selectOtherButtonSelector = '.js-select-other-car';
    var formButtonSelector = '.js-form-button';
    var getCarButtonSelector = '.send_grz_button';
    var errorBlockSelector = '.grz-error';
    var carSelectBlockSelector = '.js-car-select-form';
    var carResultBlockSelector = '.js-car-select-result';
    var grzNumberInputSelector = '.grz_number';
    var grzRegionInputSelector = '.grz_region';
    var carBodySelectSelector = '.js-car-body-select';
    var selectCarFieldSelector = '.select-car-field';

    var $carVendorInput = $('input[name="VENDOR"]');
    var $carModelInput = $('input[name="MODEL"]');
    var $carYearInput = $('input[name="YEAR"]');
    var $modificationInput = $('input[name="MODIFICATION"]');

    var modelSelectGroup;
    var yearSelectGroup;
    var modificationSelectGroup;

    var results = {
      'vendor': $carVendorInput.val(),
      'model': $carModelInput.val(),
      'year': $carYearInput.val(),
      'body': $modificationInput.val(),
    };

    function setResults() {
      if (results.vendor && results.model && results.year) {
        var name = results.vendor + ' ' + results.model + ' (' + results.year + ' г.в.)';

        $carNameBlock.text(name)

        if (results.power && results.weight && results.fuel) {
          $carEngineBlock.text(results.weight + 'cc, ' + results.power + ' л.с., ' + results.fuel)
        }

        if (results.drive) {
          $carDriveBlock.text(results.drive)
        }
      }
    }

    function addInputs() {
      $carResultBlock.append('<input type="hidden" name="VENDOR" value="' + results.vendor + '" />');
      $carResultBlock.append('<input type="hidden" name="MODEL" value="' + results.model + '" />');
      $carResultBlock.append('<input type="hidden" name="YEAR" value="' + results.year + '" />');

      if (results.body) {
        $carResultBlock.append('<input type="hidden" name="MODIFICATION" value="' + results.body + '" />');
      }

      if (results.modifications && results.modifications.length) {
        var options = '';

        results.modifications.forEach(function (item) {
          options += '<option>' + item + '</option>';
        });

        var select = '<select type="hidden" name="MODIFICATION">' + options + '</select>';

        if ($carResultBlock.find(selectCarFieldSelector).length && $carResultBlock.find(carBodySelectSelector).length) {
          $carResultBlock.find(carBodySelectSelector).append(select);
        } else {
          var selectField = '<div class="form-group select-car-field"><label class="select-car-description form-label">Выберите модификацию:</label>' +
            '<div class="form-select js-car-body-select">' + select + '</div></div>';

          $carResultBlock.append(selectField);
        }
      }
    }

    function removeInputs() {
      $(carResultBlockSelector).find('input[name="VENDOR"]').remove();
      $(carResultBlockSelector).find('input[name="MODEL"]').remove();
      $(carResultBlockSelector).find('input[name="YEAR"]').remove();
      $(carResultBlockSelector).find('input[name="MODIFICATION"]').remove();
      $(carResultBlockSelector).find('select[name="MODIFICATION"]').remove();
    }

    function showBlock($block) {
      $block.removeClass('hidden');
    }

    function hideBlock($block) {
      $block.addClass('hidden');
    }

    function bindTabClick() {
      $(selectTabSelector).click(function (e) {
        e.stopPropagation()
        var $wrapper = $(this).closest(wrapperSelector);

        $wrapper.find(selectTabSelector).removeClass('active');
        $(this).toggleClass('active');
        var selectId = $(this).data('id');

        if (selectId === 'car-select') {
          hideBlock($wrapper.find(selectOtherButtonSelector).parent())
          removeInputs();

          hideBlock($wrapper.find(getCarButtonSelector).closest(formGroupSelector))
          showBlock($wrapper.find(formButtonSelector))

        } else {
          showBlock($wrapper.find(selectOtherButtonSelector).parent())

          if (!$wrapper.find(carResultBlockSelector).hasClass('hidden')) {
            showBlock($wrapper.find(formButtonSelector))
            addInputs();
          } else {
            hideBlock($wrapper.find(formButtonSelector));
            showBlock($wrapper.find(getCarButtonSelector).closest(formGroupSelector));
          }
        }

        $wrapper.find(selectContentSelector).removeClass('active')
        $wrapper.find(selectContentSelector + '.' + selectId).addClass('active')
      });
    }

    function removeSelects($form) {
      var $carSelect = $form.find('.select-car-content.car-select');

      $carSelect.each(function () {
        $(this).find('select[name="VENDOR"]').val('');
        modelSelectGroup = $(this).find('select[name="MODEL"]').closest('.form-group ');
        yearSelectGroup = $(this).find('select[name="YEAR"]').closest('.form-group ');
        modificationSelectGroup = $(this).find('select[name="MODIFICATION"]').closest('.form-group ');

        modelSelectGroup.remove();
        yearSelectGroup.remove();
        modificationSelectGroup.remove();
      })
    }

    function bindSubmit() {
      $('form.smartfilter').submit(function(e) {
        var $paramsFilter = $(this).find('.filter-tabs-content[data-tab-id="filter-params"]');
        var $carFilter = $(this).find('.filter-tabs-content[data-tab-id="filter-car-brand"]');

        if ($paramsFilter.hasClass('active')) {
          removeSelects($(this));
          removeInputs()
        } else if ($carFilter.hasClass('active')) {
          if ($(this).find('.select-car-content.grz').hasClass('active')) {
            removeSelects($(this));
          } else {
            removeInputs()
          }
        }
      });
    }

    function bindGetCarClick() {
      $getCarButton.click(function (e) {
        var $wrapper = $(this).closest(wrapperSelector);
        var $errorBlock = $wrapper.find(errorBlockSelector);
        var $carSelectBlock = $wrapper.find(carSelectBlockSelector);
        var $getCarButton = $wrapper.find(getCarButtonSelector);
        var $carResultBlock = $wrapper.find(carResultBlockSelector);
        var $formButton = $wrapper.find(formButtonSelector);
        var $selectOtherButton = $wrapper.find(selectOtherButtonSelector);
        var $loader = $wrapper.find(loaderSelector)
        var $grzNumberInput = $wrapper.find(grzNumberInputSelector)
        var $grzRegionInput = $wrapper.find(grzRegionInputSelector)

        e.preventDefault();

        if (!$loader.hasClass('hidden')) {
          return
        }

        hideBlock($errorBlock)
        showBlock($loader);

        var grz = $grzNumberInput.val() + $grzRegionInput.val();

        $.ajax({
          url: apiUrl,
          type: 'get',
          dataType: 'json',
          data: {
            'grz': grz
          },
          success: function (response) {
            if (response.result) {
              results = response.result
              setResults()
              hideBlock($carSelectBlock)
              hideBlock($getCarButton.closest(formGroupSelector))
              addInputs()
              showBlock($carResultBlock)
              showBlock($formButton)
              showBlock($selectOtherButton.parent())
            } else if (response.error) {
              $errorBlock.text(response.error)
              showBlock($errorBlock)
            }
          },
          error: function (response) {
            console.log(response);
          },
          complete: function () {
            hideBlock($loader);
          }
        });
      });
    }

    function bindMaskNumber() {
      $.mask.definitions['Z'] = "[АВЕКМНОРСТУХавекмнорстух]";

      $grzNumberInput.mask("Z999ZZ", {
        placeholder: ' ',
        completed: function () {
          $grzRegionInput.focus()
        }
      });
    }

    function bindMaskRegion() {
      //$.mask.definitions['~'] = "[0-9]";

      $grzRegionInput.mask("99?9", {
        placeholder: ' ',
      });
    }
    
    function bindWrapperClick() {
      $(".filter-item__select-type input[name='filter-item']").on("change", function() {
        var value = $(this).val();
        if (value === 'tire' || value === 'disk') {
          showBlock($selectOtherButton)
        } else {
          hideBlock($selectOtherButton)
        }
      })
    }
    
    function bindSelectOtherClick() {
      $selectOtherButton.click(function () {
        var $wrapper = $(this).closest(wrapperSelector);
        var $carResultBlock = $wrapper.find(carResultBlockSelector);
        var $carSelectBlock = $wrapper.find(carSelectBlockSelector);
        var $selectOtherButton = $wrapper.find(selectOtherButtonSelector);
        var $formButton = $wrapper.find(formButtonSelector);
        var $getCarButton = $wrapper.find(getCarButtonSelector);

        hideBlock($carResultBlock);
        removeInputs()
        showBlock($carSelectBlock);
        hideBlock($selectOtherButton.parent())
        hideBlock($formButton)
        showBlock($getCarButton.closest(formGroupSelector))
        //removeSelects()
      });
    }

    function bindChangeModificationSelect() {
      $(document).on('change', '.select-car-content.grz select[name="MODIFICATION"]', function () {
        var val = $(this).val();
        $(this).parent().find('input[name="BODY"]').val(val);
      });
    }

    function init() {
      bindGetCarClick()
      bindTabClick()
      bindMaskNumber()
      bindMaskRegion()
      bindSelectOtherClick()
      bindWrapperClick()
      bindSubmit()
      bindChangeModificationSelect()

      /*if ($carResultBlock.hasClass('hidden')) {
        hideBlock($formButton)
      } else {
        showAutoBlock()
      }*/
    }

    return Object.freeze({
      init: init
    })
  }

  var selectCar = SelectCar()

  selectCar.init()

});
