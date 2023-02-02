<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

?>
<?php foreach ($arResult['VALUE_LIST'] as $value): ?>
    <?php
    $checked = ($arResult['MULTIPLE'] == 'Y')
        ? (in_array($value['ID'], $arResult['VALUE'])) ? 'checked="checked"' : ''
        : ($value['ID'] == $arResult['VALUE']) ? 'checked="checked"' : '';
    $id = $value['PROPERTY_ID'] . '_' . $value['ID'];
    ?>
    <p>
        <input
            type="checkbox"
            name="<?= $arResult['NAME'] ?>"
            value="<?= $value['ID'] ?>"
            id="<?= $id ?>"
            <?= $checked ?>
        >
        <label for="<?= $id ?>"><?= $value['VALUE'] ?></label>
    </p>
<?php endforeach ?>