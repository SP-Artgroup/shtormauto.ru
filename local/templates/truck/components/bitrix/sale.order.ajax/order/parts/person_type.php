<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
<div class="form-block person-type">

    <div class="form-block__title">Вы оформляете товар как</div>

    <div class="form-block__content">

        <?
        $person_type_checked_id = 0;

        foreach($arResult["PERSON_TYPE"] as $personType): ?>

            <?
            $personTypeClass = isset($personType['CHECKED']) && $personType['CHECKED'] === 'Y'
                ? 'btn-red'
                : 'btn-black';
            ?>

            <button
                class="btn1 <?= $personTypeClass ?>"
                onclick="BX('PERSON_TYPE_ID').value=<?=$personType['ID']?>;submitForm();"
            ><?= $personType['NAME'] ?></button>

        <? endforeach ?>

        <input type="hidden" name="PERSON_TYPE" id="PERSON_TYPE_ID" value="<?= $arResult['USER_VALS']['PERSON_TYPE_ID'] ?>">

    </div>

</div>