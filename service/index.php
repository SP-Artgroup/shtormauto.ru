<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<script type="text/javascript" src="https://w125297.yclients.com/widgetJS" charset="UTF-8"></script>
<script>
	var yWidgetSettings = {
		buttonColor : '#1c84c6',
		buttonPosition : 'bottom right',
		buttonAutoShow : true,
		buttonText : 'Онлайн запись',
		formPosition : 'right'
	};
</script>
<?$APPLICATION->SetTitle("Записаться на сервис");?><?$APPLICATION->IncludeComponent(
	"bitrix:form", 
	".default", 
	array(
		"AJAX_MODE" => "N",
		"SEF_MODE" => "Y",
		"WEB_FORM_ID" => "1",
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"START_PAGE" => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL" => "/service/ready.php",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_STATUS" => "Y",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"NOT_SHOW_FILTER" => array(
			0 => "",
			1 => "",
		),
		"NOT_SHOW_TABLE" => array(
			0 => "",
			1 => "",
		),
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SEF_FOLDER" => "/storm/",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SEF_URL_TEMPLATES" => array(
			"new" => "#WEB_FORM_ID#/",
			"list" => "#WEB_FORM_ID#/list/",
			"edit" => "#WEB_FORM_ID#/edit/#RESULT_ID#/",
			"view" => "#WEB_FORM_ID#/view/#RESULT_ID#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>