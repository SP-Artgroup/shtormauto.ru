<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$stores  = $arResult['STORES'];
$amounts = $arResult['AMOUNTS'];
?>
<?php if (!empty($amounts)): ?>
<div class="store-list">
    <div class="select-store">
        <div class="current-store-wrapper" tabindex="-1">
            <div class="current-store">Магазин</div>
        </div>
        <div class="store-options">
            <?php foreach ($amounts as $storeId => $amount): ?>
                <div
                    class="store-option"
                    data-store-id="<?=$storeId?>"
                    data-store-amount="<?=$amount?>"
                ><?=$stores[$storeId]['NAME']?></div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endif ?>