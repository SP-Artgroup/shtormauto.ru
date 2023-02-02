<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
?>

<?php if (!empty($arResult['LABEL'])): ?>
    <label><?= $arResult['LABEL'] ?></label>
<?php endif ?>
<textarea
    <?php
    if (!empty($arResult['ATTRS'])) {
        foreach ($arResult['ATTRS'] as $name => $value) {
            echo " $name=\"$value\"";
        }
    }
    ?>
><?= $arResult['VALUE'] ?></textarea>