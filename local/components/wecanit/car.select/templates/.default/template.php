<?php use Bitrix\Main\Localization\Loc;
use Wecanit\Car\UserCar;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest();

$requestModification = $request->get('MODIFICATION');

?>
<div class="select-car-wrapper">
  <div class="select-car-type">
    <div class="select-car-type__item active grz" data-id="grz"><?= Loc::getMessage('CAR_SELECT_BY_GRZ') ?></div>
    <div class="select-car-type__item car-select" data-id="car-select"><?= Loc::getMessage('CAR_SELECT_SELF') ?></div>
  </div>

  <div class="select-car-content active grz">
    <div class="select-by-grz-wrapper">

      <div class="js-car-select-form select-by-grz-block <?= (!empty($arResult) ? 'hidden' : '') ?>">
        <span class="select-car-description"><?= Loc::getMessage('CAR_SELECT_WRITE_NUMBER') ?></span>
        <div class="grz-input-block">
          <div class="grz-input-left">
            <input type="text" placeholder="A000AA"
              class="grz-input number grz_number" name="car_number"/>
          </div>
          <div class="grz-input-right">
            <input type="text" placeholder="000" class="grz-input region grz_region" data-masked="999" name="region_number"/>
            <div class="grz-input-region"><span>RUS</span>
              <svg xmlns="http://www.w3.org/2000/svg" height="8px" width="9px" viewBox="0 0 9 6">
                <rect data-v-19107b76="" fill="#fff" width="9" height="3"></rect>
                <rect data-v-19107b76="" fill="#d52b1e" y="3" width="9" height="3"></rect>
                <rect data-v-19107b76="" fill="#0039a6" y="2" width="9" height="2"></rect>
                <rect data-v-19107b76="" fill="none" width="9" height="6" stroke="#000" stroke-width="1"></rect>
              </svg>
            </div>
          </div>
        </div>

        <span class="grz-error hidden"></span>
      </div>

      <div class="js-car-select-result car-select-result-block <?= (empty($arResult) ? 'hidden' : '') ?>">
        <?php if ($arResult[UserCar::VENDOR_KEY]): ?>
          <input type="hidden" name="VENDOR" value="<?= $arResult[UserCar::VENDOR_KEY] ?>" />
        <?php endif ?>

        <?php if ($arResult[UserCar::MODEL_KEY]): ?>
          <input type="hidden" name="MODEL" value="<?= $arResult[UserCar::MODEL_KEY] ?>" />
        <?php endif ?>

        <?php if ($arResult[UserCar::YEAR_KEY]): ?>
          <input type="hidden" name="YEAR" value="<?= $arResult[UserCar::YEAR_KEY] ?>" />
        <?php endif ?>

        <?php if ($arResult[UserCar::BODY_KEY]): ?>
          <input type="hidden" name="MODIFICATION" value="<?= $arResult[UserCar::BODY_KEY] ?>" />
        <?php endif ?>

        <span class="select-car-description"><?= Loc::getMessage('CAR_SELECT_DATA_BY_GRZ') ?></span>
        <div class="js-car-name select-car-name"><?= ($arResult['NAME'] ?: '') ?></div>

        <div class="select-car-field">
          <span class="select-car-description"><?= Loc::getMessage('CAR_SELECT_ENGINE') ?></span>
          <div class="js-car-engine select-car-description__text"><?= ($arResult['ENGINE'] ?: '') ?></div>
        </div>

        <div class="select-car-field">
          <span class="select-car-description"><?= Loc::getMessage('CAR_SELECT_DRIVE') ?></span>
          <div class="js-car-drive select-car-description__text"><?= ($arResult['drive'] ?: '-') ?></div>
        </div>

          <?php if ($arResult['modifications']): ?>
            <div class="form-group select-car-field">
              <label
                class="select-car-description form-label"><?= Loc::getMessage('CAR_SELECT_MODIFICATIONS') ?></label>
              <div class="form-select js-car-body-select">

                <select name="MODIFICATION">
                  <?php foreach ($arResult['modifications'] as $modification): ?>
                    <option value="<?= $modification ?>" <?php if ($modification === $requestModification):?> selected <?php endif?>><?= $modification ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="hidden" name="BODY" >
              </div>
            </div>
          <?php endif ?>

      </div>

      <div class="form-group form-group--btn d-flex justify-content-center <?= (!empty($arResult) ? 'hidden' : '') ?>">
        <button class="btn btn-scarlet send_grz_button"><?= Loc::getMessage('CAR_SELECT_FIND') ?></button>
        <div class="auto-loader hidden">
          <img class="loading-image" src="<?=$templateFolder?>/images/loader.gif" alt="Loading..." />
        </div>
      </div>

    </div>
  </div>

    <?php // По марке авто ?>
  <div class="select-car-content car-select">
      <? $APPLICATION->IncludeComponent(
          "sp-artgroup:tyre.selection",
          "",
          [
              'TYRE_OR_WHEEL'         => $arParams['TYRE_OR_WHEEL'],
              'TYRE_SELECTION_FILTER' => $arParams['TYRE_SELECTION_FILTER'],
          ],
          $component
      ); ?>
  </div>
</div>