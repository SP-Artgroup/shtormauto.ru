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
    <div class="form-select product-item__buy-select">
        <select>
            <?php foreach ($amounts as $storeId => $amount): ?>
                <option 
                    data-store-id="<?=$storeId?>"
                    data-store-amount="<?=$amount?>">
                    <?=$stores[$storeId]['NAME']?>
                </option>
            <?php endforeach ?>            
        </select>
    </div>

<?php endif ?>