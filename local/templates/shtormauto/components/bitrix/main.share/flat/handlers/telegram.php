<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

__IncludeLang(dirname(__FILE__)."/lang/".LANGUAGE_ID."/vk.php");
$name = "telegram";
$title = GetMessage("BOOKMARK_HANDLER_TELEGRAM");
$icon_url_template = "
<a
	href=\"https://t.me/share/url?url=#PAGE_URL_ENCODED#&text=#PAGE_TITLE_UTF_ENCODED#\"
	onclick=\"window.open(this.href,'','toolbar=0,status=0,width=626,height=436');return false;\"
	target=\"_blank\"
	style=\"background: #446690\"
	class=\"telegram\"
	title=\"".$title."\"
><i class=\"fa fa-telegram\"></i></a>\n";
$sort = 100;
?>