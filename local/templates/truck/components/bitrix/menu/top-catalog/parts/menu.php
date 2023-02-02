<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$isTopLvl       = isset($params['is_top_level']);
$listAddlClass  = $isTopLvl ? 'clearfix' : 'col-lg-12 col-md-12 col-sm-12';
?>
<ul class="<?= $listAddlClass ?>">
    <?php foreach ($menu as $item): ?>

        <?
        $hasChildren   = !empty($item['ITEMS']);
        $itemAddlClass = $item['SELECTED'] ? 'selected' : '';
        ?>

        <li>
            <a href="<?= $item['LINK'] ?>"><?= $item['TEXT'] ?></a>

            <?php if ($hasChildren): ?>
                <div class="submenu">
                    <? showMenu($item['ITEMS'], []) ?>
                </div>
            <?php endif ?>

        </li>

    <?php endforeach ?>
</ul>