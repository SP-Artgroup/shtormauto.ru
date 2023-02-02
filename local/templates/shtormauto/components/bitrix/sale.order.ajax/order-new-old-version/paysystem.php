<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
        <div class="content-form__row-wrapper content-form__row-wrapper--border-top">
          <div class="content-form__row">
            <div class="row">
            <?/*Платежные системы*/
                /*если включена опция - оплата с внутреннего счета*/
            	if ($arResult["PAY_FROM_ACCOUNT"]=="Y")
                {
                        ?>
                        <input type="hidden" name="PAY_CURRENT_ACCOUNT" value="N">
                        <input type="checkbox" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT" value="Y"<?if($arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y") echo " checked=\"checked\"";?> onChange="submitForm()">
                        <label for="PAY_CURRENT_ACCOUNT"><b><?=GetMessage("SOA_TEMPL_PAY_ACCOUNT")?></b></label><br />
                        <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT1")?> <b><?=$arResult["CURRENT_BUDGET_FORMATED"]?></b>
                        <? if ($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y"): ?>
                        . <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT3")?>
                        <? else: ?>
                        , <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT2")?>
                        <? endif; ?>
                        <?
                }

            foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
            {?>
                <input type="radio" id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>" name="PAY_SYSTEM_ID" value="<?= $arPaySystem["ID"] ?>"<?if ($arPaySystem["CHECKED"]=="Y") echo " checked=\"checked\"";?> style="display: none;"/>
            <?}
            ?>    
              <div class="col-sm-12">
                <div class="form-group">
                    
                  <label for="basketFormPaymentMethod" class="form-label" style="color:#000;font-size:17px;"><strong>Способы оплаты</strong></label>
                  <div class="form-select">
                    <select name="" id="basketFormPaymentMethod">
                      <?foreach($arResult["PAY_SYSTEM"] as $arPaySystem){?>  
                        <option value="<?= $arPaySystem["ID"] ?>" <?if ($arPaySystem["CHECKED"]=="Y") echo " selected=\"selected\"";?>><?= $arPaySystem["PSA_NAME"] ?></option>
                      <?}?>
                    </select>
                  </div>
                </div>
              </div>
                
            <?
            /*Бонус, сервис, комментарии*/
            foreach($arResult["ORDER_PROP"]["ORDER_PROPS_ALL"] as $arProp){
           
            if ($arProp["PROPS_GROUP_ID"]==5 || $arProp["PROPS_GROUP_ID"]==6){
            switch ($arProp["ID"]){
                case 22: case 23:?>
                
                        <div class="col-sm-8">
                          <div class="form-group">
                            <label for="basketFormService" class="form-label">Сервис</label>
                            <div class="form-select">
                              <?foreach($arProp["VARIANTS"] as $arVar){?>  
                                <input type="<?=$arProp['TYPE']?>" name="<?= $arProp["FIELD_NAME"] ?>" id="<?= $arProp["FIELD_NAME"].'_'.$arVar["VALUE"] ?>" value="<?= $arVar["VALUE"] ?>" <?if ($arVar["CHECKED"]=="Y") echo " checked=\"checked\"";?> style="display:none;"> 
                               <?}?>       
                              <select id="basketFormService">
                                <?foreach($arProp["VARIANTS"] as $arVar){?>
                                <option value="<?=$arVar["VALUE"]?>" <?if ($arVar["CHECKED"]=="Y") echo " selected=\"selected\"";?>><?=$arVar["NAME"]?></option>
                                <?}?>
                              </select>
                            </div>
                          </div>
                        </div>                
                        <? break;
                case 32: case 33: $col_size="col-sm-12"; ?>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <textarea type="<?=$arProp['TYPE']?>" class="form-input"  placeholder="Если требуется" name="<?= $arProp["FIELD_NAME"] ?>" id="<?= $arProp["FIELD_NAME"] ?>"></textarea>
                            <label for="basketFormComment" class="form-label"><?=$arProp['NAME']?></label>
                          </div>
                        </div>                
                        <?break;
                default: ?>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <input type="<?=$arProp['TYPE']?>" class="form-input" data-masked="9999999999999" placeholder="XXXXXXXXXXXXX" name="<?= $arProp["FIELD_NAME"] ?>" id="<?= $arProp["FIELD_NAME"] ?>" >
                        <label class="form-label"><?=$arProp['NAME']?></label>
                      </div>
                    </div>                
                <?
            }
          }   
    }?>
            </div>
          </div>
        </div>
