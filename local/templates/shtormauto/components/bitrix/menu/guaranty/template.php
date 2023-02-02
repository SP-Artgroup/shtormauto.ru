<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

      <div class="header-content__col">
        <nav class="header-content-nav">
          <ul class="header-content-nav__list">
				<?
				foreach($arResult as $arItem):
					if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
						continue;
				?>
					<?if($arItem["SELECTED"]):?>
						<li class="header-content-nav__item"><a href="<?=$arItem["LINK"]?>" class="header-content-nav__link active"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="header-content-nav__item"><a href="<?=$arItem["LINK"]?>" class="header-content-nav__link"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				
					<?endforeach?>
          </ul>
        </nav>
      </div>
<?endif?>