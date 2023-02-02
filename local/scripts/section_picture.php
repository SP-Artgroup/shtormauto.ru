<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/*
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);

// Открываем файл с помощью установленных выше HTTP-заголовков
$file = file_get_contents('http://www.example.com/', false, $context);

*/

$section_picture	= file_get_contents('section_picture.txt');

$section_picture	= json_decode($section_picture);
//dump($section_picture);
foreach($section_picture as $section_import)
{
	if(empty($section_import->CODE))
		continue;
		
	//if($section_import->CODE != '_diski')
	//	continue;

	$sections	= array();
	
	$arSelect	= array('ID', 'NAME', 'CODE', 'PICTURE');
	$arFilter 	= Array('IBLOCK_ID' => 26, 'CODE' => $section_import->CODE);
	$db_res 	= CIBlockSection::GetList(Array($by=>$order), $arFilter, true, $arSelect, array('nTopCount' => 10));
	
	while($section = $db_res->GetNext())
	{
		if(empty($section['PICTURE']))
		{
			//dump($section);
			//echo 'http://shtormauto.ru'.$section_import->PICTURE_SRC;
			//$arFile = CFile::MakeFileArray('http://shtormauto.ru'.$section_import->PICTURE_SRC);

			if(sizeof($arFile) > 1)
			{
				dump($section);
				//dump($arFile);
				$bs 	= new CIBlockSection;
				$res 	= $bs->Update($section['ID'], array("PICTURE" => $arFile));
				//dump($res);
				
				$i++;
			}
			else
			{
			?>
				<a href="http://31.31.192.244/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=26&type=catalog&ID=<?=$section['ID']?>"><?=$section['NAME']?></a>
				<br/>
				<img src="<?='http://shtormauto.ru'.$section_import->PICTURE_SRC?>" />
				<br/><br/>
			<?
				//echo 'http://shtormauto.ru'.$section_import->PICTURE_SRC;
				//dump($section);
			}
		}
		

	
	}
//	if($i > 2)
//		break;

}
echo $i;
//echo $section_picture;