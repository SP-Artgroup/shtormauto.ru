$(function () {

    $(document).on('click', function (e) {
        var $select = $('.store-list .select-store');

        if (!$select.is(e.target) && $select.has(e.target).length === 0) {
            $select.removeClass('open');
        }
    });

    $('.store-list .current-store-wrapper').on('click', function () {
        $(this).parents('.select-store').toggleClass('open');
    });

    $('.store-list .store-option').on('click', function () {
        var $select = $(this).parents('.select-store');

        $('.current-store', $select)
            .text(this.innerText)
            .data('storeId', this.dataset.storeId)
            .data('storeAmount', this.dataset.storeAmount);

        $select.removeClass('open');
    });

});