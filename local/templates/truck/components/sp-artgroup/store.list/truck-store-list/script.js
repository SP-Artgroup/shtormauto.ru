$(function () {

    $('.select-drop').on('change', function () {
        var dataset = this.options[this.selectedIndex].dataset;

        this.dataset.storeId     = dataset.storeId || '';
        this.dataset.storeAmount = dataset.storeAmount || '';
    });
});