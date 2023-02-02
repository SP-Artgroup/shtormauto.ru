<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table cellpadding="0" cellspacing="10" border="0" style="width:100%">
<?
foreach($arResult["IBLOCKS"] as $arIBlock):
	if(count($arIBlock["ITEMS"]) > 0):
?>
	<tr><td><h1><?=$arIBlock['NAME']?></h1></td></tr>
<?
	foreach($arIBlock["ITEMS"] as $arItem):

		if($arItem["PREVIEW_PICTURE"])
		{
			if(COption::GetOptionString("subscribe", "attach_images")==="Y")
			{
				$sImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
			}
			elseif(strpos($arItem["PREVIEW_PICTURE"]["SRC"], "http") !== 0)
			{
				$sImagePath = "http://".$arResult["SERVER_NAME"].$arItem["PREVIEW_PICTURE"]["SRC"];
			}
			else
			{
				$sImagePath = $arItem["PREVIEW_PICTURE"]["SRC"];
			}

			$width = 100;
			$height = 100;

			$width_orig = $arItem["PREVIEW_PICTURE"]["WIDTH"];
			$height_orig = $arItem["PREVIEW_PICTURE"]["HEIGHT"];

			if(($width_orig > $width) || ($height_orig > $height))
			{
				if($width_orig > $width)
					$height_new = ($width / $width_orig) * $height_orig;
				else
					$height_new = $height_orig;

				if($height_new > $height)
					$width = ($height / $height_orig) * $width_orig;
				else
					$height = $height_new;
			}
		}
?>
	<tr><td>
		<font class="text">
			<?if($arItem["PREVIEW_PICTURE"]):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" style="float:left; display:inline-block; margin-right:10px;">
					<img align='left' src="<?echo $sImagePath?>" alt="<?echo $arItem["PREVIEW_PICTURE"]["ALT"]?>" width="180" title="<?echo $arItem["NAME"]?>">
				</a>
			<?endif;?>
			<span>
				<?if(strlen($arItem["DATE_ACTIVE_FROM"])>0):?>
					<font class="newsdata"><?echo $arItem["DATE_ACTIVE_FROM"]?></font><br>
				<?endif;?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br>
				<?echo $arItem["PREVIEW_TEXT"];?>
			</span>	
		</font>
	</td></tr>
<?
	endforeach;
	endif;
?>
<?endforeach?>
</table>
