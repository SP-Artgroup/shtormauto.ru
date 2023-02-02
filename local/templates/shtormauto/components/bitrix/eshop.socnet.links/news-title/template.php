<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);

if (is_array($arResult['SOCSERV']) && !empty($arResult['SOCSERV'])) {

    $map = [
        'FACEBOOK'  => 'facebook',
        'TWITTER'   => 'twitter',
        'VKONTAKTE' => 'vk',
        'INSTAGRAM' => 'instagram',
		'TELEGRAM'  => 'telegram',
    ];
    ?>

<div class="social">
    <div class="social__text d-none d-md-block">Мы в соцсетях</div>
    <div class="social__list">
        <?foreach ($arResult['SOCSERV'] as $key => $socserv): ?>

            <?php
            $link = htmlspecialcharsbx($socserv['LINK']);
            ?>

            <div class="social__item">
                <a href="<?= $link ?>" rel="nofollow">
                    <?php if (isset($map[$key])): ?>
                        <i class="icon i-<?= $map[$key] ?>"></i>
                    <?php endif ?>
                </a>
            </div>

        <? endforeach ?>
    </div>
</div>

<?}?>