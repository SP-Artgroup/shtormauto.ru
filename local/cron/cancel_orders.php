<?
$_SERVER["DOCUMENT_ROOT"] = "/var/www/vhosts/shtormauto.ru/shtormauto.ru/";
require("/var/www/vhosts/shtormauto.ru/shtormauto.ru/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader; 
use Bitrix\Main\Entity;


if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")){
	$now = new DateTime(); // сегодня
	$DatePoint = new DateTime("2022-02-24T00:00:00Z"); 
	// находим заказы не раньше вчерашнего дня создания, неоплаченные, неотмененные и со статусами Принят или Оформлен
	$arFilter = Array(
		'STATUS_ID' => array('N', 'A'),//статусы 
		'CANCELED' => 'N',// не отменен
		'DATE_PAYED' => false,//не оплачен
		'>DATE_INSERT' => $DatePoint->format('d.m.Y H:i:s'),
		'<DATE_INSERT' => $now->modify('-24 hours')->format('d.m.Y H:i:s')
	);
	$rsSales = CSaleOrder::GetList(
		array("DATE_INSERT" => "asc"),
		$arFilter, 
		false, 
		array('nPageSize' => 50), 
		array('ID', 'DATE_INSERT')
	);
	
	while ($arSales = $rsSales->Fetch())
	{
		$idOrders[$arSales['ID']] = $arSales['DATE_INSERT'];
		$ids[] = $arSales['ID'];
	}


	$nowDate = $now->modify('+24 hours')->format('d.m.Y H:i:s');
	foreach ($idOrders as $id => $value) {
		$order = \Bitrix\Sale\Order::load($id);
		$r = $order->setField('CANCELED', 'Y');
		$r = $order->setField('STATUS_ID', 'DA');
		$order->save();
	}
}

require("/var/www/vhosts/shtormauto.ru/shtormauto.ru/bitrix/modules/main/include/epilog_after.php");?>
