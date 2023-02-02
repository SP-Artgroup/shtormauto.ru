$(document).ready(function(){
    
    var urlAjax = document.sp_art.tyre_selection.urlAjax;

	function fLog( msg ) {
		//console.log( msg );
	} // function

	function fShowMessage( msg ) {
		alert( msg );
	} // function

    $('.filter-tabs-content').find('[name=VENDOR], [name=MODEL], [name=YEAR]').change(function(){
        var fieldName = $(this).attr('name'),
            objTab    = $(this).closest('.filter-tabs-content');

        fLog(fieldName);

        var data = {
            tyreOrWheel: objTab.find('input[name=tyreOrWheel]').val(),
            VENDOR:      objTab.find('[name=VENDOR]').val(),
        };

        if (fieldName != 'VENDOR') {
            data.MODEL = objTab.find('[name=MODEL]').val();

            if (fieldName != 'MODEL') {
                data.YEAR = objTab.find('[name=YEAR]').val();
            }
        }
        fLog(data);

        $.ajax({
            url:      urlAjax,
            type:     'POST',
            dataType: 'json',
            data:     data,
            success: function (response) {
                fLog(response);
                if (!response) {
                    fShowMessage('Ошибка 100');
                } else {
                    if (response.error_msg) {
                        fShowMessage(response.error_msg);
                    } else {
                        var arFields = ['VENDOR', 'MODEL', 'YEAR', 'MODIFICATION'],
                            i,
                            j,
                            lastIndex = response.items.length - 1,
                            str;
                        for (i=0; i<=2; i++) {
                            if (fieldName == arFields[i]) {
                                // Готовим содержимое select-а
                                str = objTab.find('[name=' + arFields[i+1] + '] option:first-child').prop('outerHTML');
                                for (j=0; j<=lastIndex; j++) {
                                    str += '<option>' + response.items[j] + '</option>';
                                }
                                objTab.find('[name=' + arFields[i+1] + ']')
                                    .html(str)
                                    .closest('.form-group').removeClass('hidden');
                                // Очищаем следующие поля
                                for (j=i+2; j<=3; j++) {
                                    str = objTab.find('[name=' + arFields[j] + '] option:first-child').prop('outerHTML');
                                    objTab.find('[name=' + arFields[j] + ']')
                                        .html(str)
                                        .closest('.form-group').addClass('hidden');
                                }
                                break;
                            }
                        }
                    }
                } //
            },
            error: function (response) {
                fLog(response);
                fShowMessage('Сбой на сервере!');
            }
        });
    });

    $('.filter-item__form input[name=set_filter]').click(function(){
        var formObj = $(this).closest('form'),
            tabId   = formObj.find('.filter-tabs-content.active').attr('data-tab-id');

        if (tabId != 'filter-car-brand') {
            // Очистим значения полей на вкладке "По марке авто"
            var arFields = ['VENDOR', 'MODEL', 'YEAR', 'MODIFICATION'],
                i;
            for (i=0; i<=3; i++) {
                str = formObj.find('[name=' + arFields[i] + ']').val(null);
            }
        }
    });
}); //
