<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

?>
<div class="footer-question">
    <?php if (!empty($arParams['question'])): ?>
        <p class="caption"><?= $arParams['question'] ?></p>
    <?php endif ?>
    <?php if (!empty($arParams['question_desc'])): ?>
        <p class="text"><?= $arParams['question_desc'] ?></p>
        <span class="sprite sprite-footer-arrow"></span>
    <?php endif ?>
    <?php if (!empty($arParams['question_btn'])): ?>
        <button class="btn1 js-ask-question-call"><?= $arParams['question_btn'] ?></button>
    <?php endif ?>
</div>