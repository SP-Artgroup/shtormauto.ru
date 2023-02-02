<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	
//	const DELETE_IBLOCK_ID	= 25;
	
	const DELETE_IBLOCK_ID	= array(21, 22, 23, 24, 25);
	
	$delete_count			= 0;
	$new_delete_count		= 0;
	
	use Bitrix\Main\Diag\Debug;
	
	/*
if(isset($_REQUEST['delete_count']))
		$delete_count	= $_REQUEST['delete_count'];
	
	$arSelect 	= Array("ID", "IBLOCK_ID", "NAME");
	$arFilter 	= Array("IBLOCK_ID" => DELETE_IBLOCK_ID);
	$res 		= CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 500), $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		//dump($arFields);
		
		if($arFields['IBLOCK_ID'] == DELETE_IBLOCK_ID)
		{
			//CIBlockElement::Delete($arFields['ID']);
			$new_delete_count++;
			$delete_count++;
		}
	}
	
	dump($new_delete_count, false);	
	dump($delete_count, false);
	
	if($new_delete_count > 0)
	    echo '<meta http-equiv="refresh" content="1;URL=/local/scripts/delete_elements.php?delete_count='.$delete_count.'"/><br/>';
*/
	
	/*
Debug::startTimeLabel("time");
	
	if(isset($_REQUEST['delete_count']))
		$delete_count	= $_REQUEST['delete_count'];
	
	$arSelect 	= Array("ID", "IBLOCK_ID", "NAME");
	$arFilter 	= Array("IBLOCK_ID" => DELETE_IBLOCK_ID);
	$res 		= CIBlockSection::GetList(Array($by=>$order), $arFilter, false, $arSelect, array("nTopCount" => 20));
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		
		if(in_array($arFields['IBLOCK_ID'], DELETE_IBLOCK_ID))
		{
			echo $arFields['IBLOCK_ID'].', ';
			//CIBlockSection::Delete($arFields['ID']);
			$new_delete_count++;
			$delete_count++;
		}
	}
	
	
		    	Debug::endTimeLabel("time");
//		    	echo 'readOuterXML';
		    	dump(Debug::getTimeLabels()["time"]);
	
	dump($new_delete_count, false);	
	dump($delete_count, false);
	
	if($new_delete_count > 0)
	    echo '<meta http-equiv="refresh" content="1;URL=/local/scripts/delete_elements.php?delete_count='.$delete_count.'"/><br/>';
*/