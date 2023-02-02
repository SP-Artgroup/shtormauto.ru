<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<?foreach($arResult["ITEMS"] as $item):?>
    <div class="one two">
        <p class="address">
            <i class="fas fa-home"></i>г.<?=$item['NAME']?>, <?=$item['DESCRIPTION']?>
        </p>
        <p class="tel">
            <a href="tel:<?= $arParams['phone'] ?>">
                <i class="fas fa-phone"></i> <?=$item['VALUE']?>
            </a>
        </p>
    </div>
<?endforeach;?>
