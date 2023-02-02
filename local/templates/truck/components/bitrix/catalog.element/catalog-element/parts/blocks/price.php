<div class="price">

    <?php if ($arParams['SHOW_OLD_PRICE'] === 'Y'): ?>

        <div class="old-price" id="<?=$itemIds['OLD_PRICE_ID']?>">
            <?= $price['PRINT_RATIO_BASE_PRICE'] ?>
        </div>

    <?php endif ?>

    <div class="new-price" id="<?= $itemIds['PRICE_ID'] ?>">
        <?= $price['PRINT_RATIO_PRICE'] ?>
    </div>
</div>