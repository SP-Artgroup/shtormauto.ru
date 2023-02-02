<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<header class="basket-full-header">
    <div class="basket-full-header__wrapper">
        <div class="basket-full-header__step fulfilled">
            <span class="basket-full-header__step-number">1</span>
            <span class="basket-full-header__step-text">Проверка заказа</span>
        </div>
        <div class="basket-full-header__delimiter active"></div>
        <div class="basket-full-header__step active">
            <span class="basket-full-header__step-number">2</span>
            <span class="basket-full-header__step-text">Оплата и доставка</span>
        </div>
    </div>
    <div class="basket-full-header__current-step d-block d-md-none">Оплата и доставка</div>
</header>
<div class="content-form-body content-form-body--basket-step-2">
<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
	if(!empty($arResult["ERROR"]))
	{
		foreach($arResult["ERROR"] as $v)
			echo ShowError($v);
	}
	elseif(!empty($arResult["OK_MESSAGE"]))
	{
		foreach($arResult["OK_MESSAGE"] as $v)
			echo ShowNote($v);
	}

	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script type="text/javascript">
			window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
		}
	}
	else
	{
		?>
		<script type="text/javascript">
		function refreshform(){
			$("input[data-masked]").each(function() {
				$(this).mask($(this).data("masked"))
			}); 
		}
		function submitForm(val)
		{
			if(val != 'Y')
				BX('confirmorder').value = 'N';

			var orderForm = BX('ORDER_FORM');

			BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
			BX.addCustomEvent("onAjaxSuccess", refreshform);
			BX.submit(orderForm);

			return true;
		}
		function SetContact(profileId)
		{
			BX("profile_change").value = "Y";
			submitForm();
		}
           
		</script>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?><form action="" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
			<?=bitrix_sessid_post()?>
			<div id="order_form_content" class="content-form content-form--margin-bottom-72 form-container">
			<?
		}
		else
		{
			$APPLICATION->RestartBuffer();
		}
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);

			?>
			<script type="text/javascript">
				top.BX.scrollToNode(top.BX('ORDER_FORM'));
			</script>
			<?
		}

		if(count($arResult["PERSON_TYPE"]) > 1)
		{
			?>
                        <div class="content-form__row-wrapper content-form__row-wrapper--padding-32 content-form__row-wrapper--border-top">
                          <div class="content-form__row">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="basketFormTypePayer" class="form-label"><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></label>
                                  <div style="display: none;">
                                  <?

                                  foreach($arResult["PERSON_TYPE"] as $v)
                                  {

                                  ?>                                   
                                  <input type="radio" id="PERSON_TYPE_<?= $v["ID"] ?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>" <?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> >
                                  <?}?>
                                  </div>
                                  <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
                                  <div class="form-select">
                                    <select name="" id="basketFormTypePayer">
                                    <?foreach($arResult["PERSON_TYPE"] as $v)
                                    {?>                                        
                                      <option value="<?= $v["ID"] ?>" <?if ($v["CHECKED"]=="Y") echo " selected=\"selected\"";?>><?= $v["NAME"] ?></option>
                                    <?}?>                                   
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>                        
			<?
		}
		else
		{
			if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
			{
				?>
				<input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
				<input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
				<?
			}
			else
			{
				foreach($arResult["PERSON_TYPE"] as $v)
				{
					?>
					<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
					<?
				}
			}
		}

                    include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");

		?>
		<?
		if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
		?>
		<br /><br />
		<?
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");

		if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
			echo $arResult["PREPAY_ADIT_FIELDS"];
		?>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?>
				</div>
				<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
				<input type="hidden" name="profile_change" id="profile_change" value="N">
				<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
				<div class="rezerv_text">
					<div class="i-24"></div>
					Все товары в вашем заказе резервируются на 24 часа. Заказ необходимо оплатить в течение суток, по истечении 24 часов с момента заказа резерв будет снят, заказ отменен.
				</div>
				<br>
				<br>
				<div class="d-flex justify-content-between flex-column flex-md-row">
					<a href="/personal/cart/" class="btn btn-white content-form-body__button">К предыдущему шагу</a>
					<input type="button" name="submitbutton" onClick="submitForm('Y');" value="<?=GetMessage("SOA_TEMPL_BUTTON")?>" class="btn btn-dark content-form-body__button">        
				</div>


			</form>
			<?
			if($arParams["DELIVERY_NO_AJAX"] == "N")
			{
				$APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");
				$APPLICATION->AddHeadScript("/bitrix/components/bitrix/sale.ajax.delivery.calculator/templates/.default/proceed.js");
			}
		}
		else
		{
			?>
			<script type="text/javascript">
				top.BX('confirmorder').value = 'Y';
				top.BX('profile_change').value = 'N';
			</script>
			<?
			die();
		}
	}
}
?>
</div>
<script>

$(function(){
    $(document).on("change", "#basketFormTypePayer", function(){
            var inputPerson = $('input[id="PERSON_TYPE_'+this.value+'"]');
            $('input[name="PERSON_TYPE"]').prop("checked", false);
            inputPerson.prop("checked", true);
            submitForm();
            $("input[data-masked]").each(function() {
		        $(this).mask(String($(this).data("masked")));
		    });
    });
    $(document).on("change", "#basketFormService", function(){
            var inputServiceF =  $('input[id="ORDER_PROP_22_'+this.value+'"]');
            var inputServiceU = $('input[id="ORDER_PROP_23_'+this.value+'"]');
            $('input[name="ORDER_PROP_22"]').prop("checked", false);
            $('input[name="ORDER_PROP_23"]').prop("checked", false);
            inputServiceF.prop("checked", true);
            inputServiceU.prop("checked", true);
    });
    $(document).on("change", "#basketFormPaymentMethod", function(){
            var inputPaySystem = $('input[id="ID_PAY_SYSTEM_ID_'+this.value+'"]');
            $('input[name="PAY_SYSTEM_ID"]').prop("checked", false);
            inputPaySystem.prop("checked", true);   
    });
    $(document).on("change", "#basketFormCity", function(){
        var arr = <?php echo $test; ?>;
        var city = $("#basketFormCity").val();
        var inputShop = $('#basketFormShop').parents(".form-group").next(); 
        if (city!=$('input[name="oldCity"]').val()){
           $(".buy-error-message").css("display", "block");
        }else{
            $(".buy-error-message").css("display", "none");
        }
        if (city=='Другой город'){
            $("#basketFormShop").empty();
            $("#basketFormShop").parents(".form-group").toggle();
            inputShop.attr("type", "text");
            inputShop.toggle(); 
        }else{
           if ($("#basketFormShop").parents(".form-group").css("display")=="none"){ 
               $("#basketFormShop").parents(".form-group").toggle();
               inputShop.toggle();  
           }
           $("#basketFormShop").empty();
           for (var temp in arr){
               if (arr[temp]["CITY"]==city){
                      $("#basketFormShop").append('<option value="'+arr[temp]['ID']+'">'+arr[temp]['NAME']+'</option>');
               }
           }
       }
       $('#basketFormCity').parents(".form-group").next().val($("#basketFormCity option[value='"+city+"']").html());
       var shop = $("#basketFormShop").val();
       $('#basketFormShop').parents(".form-group").next().val(shop);
       var data = {
       		city_id: $("#basketFormCity").val(),
       		product_id: getProductIds(),
       };
       $.ajax({
			url: "<?=$templateFolder?>/ajax.php",
			type:     'POST',
			data:     data,
			success: function (response) {
				$('.amount_shop').html(response);
				getProductAmount(); 
			},
			error: function(response) {
				console.log('error');
			}
		});
   });
    $(".form-select").on("change", "#basketFormShop", function(){
        var shop = $("#basketFormShop").val();
        $('#basketFormShop').parents(".form-group").next().val(shop);
        getProductAmount();
    });  
     $(document).on("change", "input[required]", function(){
        var e = $(this);
        if (e.val()===""){
            e.parent().prepend('<div class="form-error">Пожалуйста, заполните это поле</div>');
        }else{
            e.parent().children(".form-error").remove();
        }
     });
     getProductAmount();
     function getProductAmount(){
     	var productId, 
     		quantity,
     		amount,
     		amountCity,
     		shopId = [$('#basketFormShop').val()];
     	$('#order_form_content .basket-item').each(function(){
     		productId = $(this).data('product-id');
     		quantity = $(this).data('product-quantity');
     		amount = $('.amount_shop div[data-product-id="'+productId+'"] span[data-id-shop="'+shopId+'"]').text();
     		amountCity = $('.amount_shop div[data-product-id="'+productId+'"] span[data-id-shop="all"]').text();
     		if(amount == 0 || quantity > amountCity){
     			$(this).find('.basket-item_out-of-stock').show();
     		}
     		else{
     			$(this).find('.basket-item_out-of-stock').hide();
     		}
     	});
     }
     function getProductIds(){
     	var product_ids = [];
     	$('#order_form_content .basket-item').each(function(){
     		product_ids.push($(this).data('product-id'));
     	});
     	return product_ids;
     }
});   

</script>