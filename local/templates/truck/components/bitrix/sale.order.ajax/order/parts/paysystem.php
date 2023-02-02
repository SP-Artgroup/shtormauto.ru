<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>
<div class="form-block paysystems">

    <div class="form-block__title">Способ оплаты</div>

    <div class="form-block__content">

        <script type="text/javascript">
            function changePaySystem(param)
            {
                if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
                {
                    if (param == 'account')
                    {
                        if (BX("PAY_CURRENT_ACCOUNT"))
                        {
                            BX("PAY_CURRENT_ACCOUNT").checked = true;
                            BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                            BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

                            // deselect all other
                            var el = document.getElementsByName("PAY_SYSTEM_ID");
                            for(var i=0; i<el.length; i++)
                                el[i].checked = false;
                        }
                    }
                    else
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = false;
                        BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                        BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                    }
                }
                else if (BX("account_only") && BX("account_only").value == 'N')
                {
                    if (param == 'account')
                    {
                        if (BX("PAY_CURRENT_ACCOUNT"))
                        {
                            BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

                            if (BX("PAY_CURRENT_ACCOUNT").checked)
                            {
                                BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                                BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                            }
                            else
                            {
                                BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                                BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                            }
                        }
                    }
                }

                submitForm();
            }
        </script>

        <div class="paysystems">

            <?
            $pay_system_checked_id = 0;

            foreach ($arResult["PAY_SYSTEM"] as $arPaySystem) {

                $desc = $arPaySystem['DESCRIPTION']
                    ? '(' . $arPaySystem['DESCRIPTION'] . ')'
                    : '';

                $isActive = $arPaySystem["CHECKED"] === "Y"
                    && !(
                        $arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y"
                        && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y"
                    );

                $name = str_replace('(Физическое лицо)', '', $arPaySystem['PSA_NAME']);

                if ($arPaySystem["CHECKED"] == 'Y' || $pay_system_checked_id == 0) {
                    $pay_system_checked_id  = $arPaySystem["ID"];
                }
                ?>

                <div
                    class="paysystem <?= $isActive ? 'active' : '' ?>"
                    onclick="BX('ID_PAY_SYSTEM_ID').value=<?=$arPaySystem["ID"]?>;changePaySystem();"
                >
                    <span class="paysystem__name"><?= $name ?></span>
                    <span class="paysystem__desc"><?= $desc ?></span>
                </div>

                <?
            }
            ?>

            <input id="ID_PAY_SYSTEM_ID" type="hidden" value="<?=$pay_system_checked_id?>" name="PAY_SYSTEM_ID">
        </div>
    </div>
</div>