<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
    <header class="header-content header-content--news">
      <div class="header-content__col">
        <h1 class="header-content__heading">Новости</h1>
      </div>
      <div class="header-content__col">
        <?$APPLICATION->IncludeComponent(
                "bitrix:eshop.socnet.links",
                "news-title",
                array(
                        //"FACEBOOK" => "https://www.facebook.com/goodridetire.ru",
                        "GOOGLE" => "",
                        //"INSTAGRAM" => "https://www.instagram.com/shtormavto/",
                        "TWITTER" => "https://twitter.com/goodridetire",
                        "VKONTAKTE" => "https://vk.com/",
						"TELEGRAM" => "https://t.me/shtormauto",
                        "COMPONENT_TEMPLATE" => "news-title"
                ),
                false
        );?>
      </div>
    </header>
    <div class="news row margin-m-20">
        <?$numberPage = 1;?>
        <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                switch ($numberPage){
                    case 3:
                    if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6 col-lg-4">
                      <div class="subscription subscription--background">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
                                Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "AREA_FILE_SUFFIX" => "inc",
                                                "EDIT_TEMPLATE" => "",
                                                "PATH" => "/include/main_subscribe_mobile.php"
                                )
			);?>
                      </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                      <div class="tile-item news-item news-item--small">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <?
                    break;
                    case 4: case 7: case 8:
                    if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6 col-lg-4">
                      <div class="tile-item news-item news-item--small">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <?
                    break;
                    case 5:
                    if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6">
                      <div class="tile-item news-item">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <?
                    break;
                    case 6:
                     if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6">
                      <div class="tile-item news-item">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-none d-lg-block">
                        <div class="advert-banner-horizontal">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:advertising.banner",
                                "",
                                Array(
                                "CACHE_TIME" => "0",
                                "CACHE_TYPE" => "A",
                                "NOINDEX" => "Y",
                                "QUANTITY" => "1",
                                "TYPE" => "horizontal_banner_848"
                                )
                            );?>
                        </div>
                    </div>
                    <?
                    break;
                    case 9:
                    if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>360, 'height'=>200), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6 col-lg-4">
                      <div class="tile-item news-item news-item--small">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-none d-md-block d-lg-none">
                      <div class="advert-banner-horizontal">
                          <?$APPLICATION->IncludeComponent(
                            "bitrix:advertising.banner",
                            "",
                            Array(
                            "CACHE_TIME" => "0",
                            "CACHE_TYPE" => "A",
                            "NOINDEX" => "Y",
                            "QUANTITY" => "1",
                            "TYPE" => "horizontal_banner_848"
                            )
                          );?>
                      </div>
                    </div>
                    <div class="col-12 d-block d-md-none">
                      <div class="advert-banner-horizontal">
                          <?$APPLICATION->IncludeComponent(
                            "bitrix:advertising.banner",
                            "",
                                Array(
                                "CACHE_TIME" => "0",
                                "CACHE_TYPE" => "A",
                                "NOINDEX" => "Y",
                                "QUANTITY" => "1",
                                "TYPE" => "horizontal_banner_343"
                            )
                          );?>
                      </div>
                    </div>
                    <?
                    break;
                    default:
                   if (is_array($arItem["PREVIEW_PICTURE"])){
                        $arFile = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }elseif ($arItem["DETAIL_PICTURE"]){
                        $arFile = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array('width'=>550, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
                    }
                    ?>
                    <div class="col-sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                      <div class="tile-item news-item">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__img-link"><img src="<?=$arFile["src"]?>" alt="" class="tile-item__img"></a>
                        <div class="tile-item__info">
                          <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tile-item__title"><?=$arItem["NAME"];?></a>
                          <div class="tile-item__description"><?=$arItem["PREVIEW_TEXT"]?></div>
                          <div class="tile-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
                        </div>
                      </div>
                    </div>
                    <?
                }
                ?>
                <?$numberPage++;?>
        <?endforeach;?>
</div>
<div class="pagination_news">
    <?=$arResult["NAV_STRING"];?>
</div>