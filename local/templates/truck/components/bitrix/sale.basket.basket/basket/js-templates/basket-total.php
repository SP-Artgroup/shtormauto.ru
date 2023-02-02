<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */

$showCoupon  = $arParams['HIDE_COUPON'] !== 'Y';
$couponClass = $showCoupon ? 'coupon' : '';
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-total" data-entity="basket-checkout-aligner">
		<div class="col-xs-12 col-sm-6 <?= $couponClass ?>">

			<?php if ($showCoupon): ?>

				<div class="coupon__input-box">
					<div class="coupon__input-wrapper">
						<input
							class="coupon__input"
							type="text"
							placeholder="<?= Loc::getMessage('SBB_COUPON_INPUT') ?>"
							data-entity="basket-coupon-input"
						>
						<span class="coupon__btn"></span>
					</div>
					<a class="coupon__label" href=""><?= Loc::getMessage('SBB_COUPON_LABEL') ?></a>
				</div>

				<div class="coupon__alert">
					<div class="basket-coupon-alert-inner">
						{{#COUPON_LIST}}
						<div class="basket-coupon-alert text-{{CLASS}}">
							<span class="basket-coupon-text">
								<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
								{{#DISCOUNT_NAME}}({{{DISCOUNT_NAME}}}){{/DISCOUNT_NAME}}
							</span>
							<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
								<?=Loc::getMessage('SBB_DELETE')?>
							</span>
						</div>
						{{/COUPON_LIST}}
					</div>
				</div>

			<?php endif ?>
		</div>

		<div class="col-xs-12 col-sm-6 basket-total__checkout">

			<div class="basket-total__sum-title"><?= Loc::getMessage('SBB_TOTAL_TITLE') ?></div>

			<div class="basket-total__sum-box">

				{{#DISCOUNT_PRICE_FORMATED}}
					<div class="price price_old basket-total__old-sum">
						{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}
					</div>
				{{/DISCOUNT_PRICE_FORMATED}}

				<div class="price basket-total__sum" data-entity="basket-total-price">
					{{{PRICE_FORMATED}}}
				</div>

			</div>

			{{^ORDER_INTEGRATED}}
				<button
					class="btn1 btn-red {{#DISABLE_CHECKOUT}}disabled{{/DISABLE_CHECKOUT}}"
					data-entity="basket-checkout-button"
				><?=Loc::getMessage('SBB_ORDER')?></button>
			{{/ORDER_INTEGRATED}}

		</div>

	</div>
</script>