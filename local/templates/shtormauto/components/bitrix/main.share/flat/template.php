<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="social">
    <div class="social__text">Поделиться новостью</div>
    <div class="social__list">
        <?
        if ($arResult["PAGE_URL"])
        {
      
				
        if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0) {
            foreach (array_reverse($arResult["BOOKMARKS"]) as $name => $arBookmark) {
                $str = str_replace('fa fa-vk', 'icon i-vk', $arBookmark["ICON"]);
                $str = str_replace('fa fa-twitter', 'icon i-twitter', $str);
                // $str = str_replace('fa fa-facebook', 'icon i-facebook', $str);
                $str = str_replace('fa fa-telegram', 'icon i-telegram', $str);
                ?>
                <div class="social__item">
                    <?= $str; ?>
                </div>
                <?
                }
            }
            ?>
            <?
        }
        else{
            ?><?= GetMessage("SHARE_ERROR_EMPTY_SERVER") ?><?
        }
        ?>
    </div>
</div>