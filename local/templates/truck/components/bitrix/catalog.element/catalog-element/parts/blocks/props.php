<div class="options-container">

    <?php if ($tplData['mainBlockPropsCodes']): ?>

        <?php

        $propCodes     = $tplData['mainBlockPropsCodes'];
        $propsQuantity = count($propCodes);
        $border        = (int) ($propsQuantity / 2);

        if ($propsQuantity % 2 !== 0) {
            ++$border;
        }

        ?>

        <div class="left">
            <?php for ($i = 0; $i <= $border - 1; ++$i): ?>
                <?php
                $propCode = $propCodes[$i];

                $property = $arResult['DISPLAY_PROPERTIES'][$propCode];
                $value = is_array($property['DISPLAY_VALUE'])
                    ? implode(' / ', $property['DISPLAY_VALUE'])
                    : $property['DISPLAY_VALUE'];
                ?>
                <p><?= $property['NAME'] ?>: <span><?= $value ?></span></p>

            <?php endfor ?>
        </div>

        <div class="right">

            <?php for ($i = $border; $i <= $propsQuantity - 1; ++$i): ?>
                <?php
                $propCode = $propCodes[$i];

                $property = $arResult['DISPLAY_PROPERTIES'][$propCode];
                $value = is_array($property['DISPLAY_VALUE'])
                    ? implode(' / ', $property['DISPLAY_VALUE'])
                    : $property['DISPLAY_VALUE'];
                ?>
                <p><?= $property['NAME'] ?>: <span><?= $value ?></span></p>

            <?php endfor ?>

        </div>

    <?php endif ?>

    <? if ($arResult['SHOW_OFFERS_PROPS'])
    {
        ?>
        <dl class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_MAIN_PROP_DIV']?>"></dl>
        <?
    }
    ?>
</div>