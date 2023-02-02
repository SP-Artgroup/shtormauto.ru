<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
$arResult['TOTAL_PRICE'] = str_replace('руб.', '', $arResult['TOTAL_PRICE']);
$arResult['TOTAL_PRICE'] = str_replace(' ', '', $arResult['TOTAL_PRICE']);
?>
    <div class="basket-preview">
      <div class="basket-preview__top">
        <div class="basket-preview__total-price">
          <i class="icon i-basket"></i>
          <span class="basket-preview__total-price-value">&#8381;<?= $arResult['TOTAL_PRICE'] ?></span>
        </div>
        <div class="basket-preview__count-products">
          Товаров: <?=$arResult['NUM_PRODUCTS']?>
        </div>
      </div>
	<div data-role="basket-item-list" class="basket-preview__list">
		<div id="<?=$cartId?>products">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>
				<?foreach ($items as $key=>$v):?>
					<div class="basket-item">
            <? echo '<pre style="display:none">'; print_r($arResult["MAX_QUANTITY_CITY"]); echo '</pre>';?>
                                            <div class="basket-item__img-wrapper">
                                            <?if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]):?>       
                                                <a href="<?=$v["DETAIL_PAGE_URL"]?>" tabindex="-1"><img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>"></a>
                                            <?endif?>
                                            </div>                                            
                                            <div class="basket-item__info">
                                              <div class="basket-item__info-top">
                                                <?/*маркер сезона у товара*/
                                                $sezon = "";
                                                switch ($v["SEZON"]){
                                                    case "cd21ed25-58af-11e4-ae29-002191f46f07": $sezon = "i-winter"; break;
                                                    case "8f7f0dc2-59a2-11e4-ae29-002191f46f07": $sezon = "i-summer"; break;
                                                    case "b9101ce9-1945-11e5-b446-902b3473375a": $sezon = "i-all"; break;
                                                }
                                                ?>
                                                <a href="<?=$v["DETAIL_PAGE_URL"]?>" class="basket-item__name"><?=$v["NAME"]?><i class="icon <?=$sezon;?>"></i></a>                                                
                                                <a href="javascript:void(0)" class="basket-item__delete" data-id="<?=$v['ID']?>"><i class="icon i-delete"></i></a>
                                              </div>
                                              <div class="basket-item__small-description"><?=$v["DESCRIPTION"]?></div>
                                              <? if((int)$arResult["MAX_QUANTITY_CITY"][$v["PRODUCT_ID"]] < (int)$v['QUANTITY']):?>
                                                <div class="scarlet"><strong>Доставка от 3-х дней</strong></div>
                                              <? endif;?>
                                              <div class="basket-item__info-bottom">
                                                  <div class="basket-item__price">
                                                      <?if ($arParams["SHOW_PRICE"] == "Y"):?>
                                                        
                                                        <?if ($v["DISCOUNT_PRICE"] >0):?>
                                                          &#8381;<?= (int)$v["DISCOUNT_PRICE"] ?>
                                                        <?else:?>
                                                        &#8381;<?= (int)$v["BASE_PRICE"] ?>
                                                        <?endif?>
                                                      <?endif?>                                                      
                                                  </div>
                                                <div class="counter">
                                                  <button type="button" class="btn counter__minus">-</button>
                                                  <input type="number" value="<?=$v['QUANTITY']?>" data-id="<?=$v['ID']?>" data-productID = "<?=$v["PRODUCT_ID"]?>" data-store="<?=$arResult['JS_DATA'][$key]['props']['store_id'];?>" class="counter__input">
                                                  <button type="button" class="btn counter__plus">+</button>
                                                </div>
                                              </div>
                                            </div>

					</div>
				<?endforeach?>
			<?endforeach?>
		</div>
	</div>
		<?if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
                        <div class="basket-preview__buttons">
                            <a href="javascript:void(0)" class="btn btn-white" onclick="basketPopupHandler();">Продолжить покупки</a>
                          <a href="<?=$arParams["PATH_TO_BASKET"]?>" class="btn btn-dark"><?=GetMessage("TSB1_2ORDER")?></a>                          
                        </div>                
		<?endif?>
    </div>
	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}