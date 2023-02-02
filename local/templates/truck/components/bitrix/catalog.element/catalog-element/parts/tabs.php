<div class="col-sm-8 col-md-9">
    <div class="row" id="<?=$itemIds['TABS_ID']?>">
        <div class="col-xs-12">
            <div class="product-item-detail-tabs-container">
                <ul class="product-item-detail-tabs-list">
                    <?
                    if ($showDescription)
                    {
                        ?>
                        <li class="product-item-detail-tab active" data-entity="tab" data-value="description">
                            <a href="javascript:void(0);" class="product-item-detail-tab-link">
                                <span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
                            </a>
                        </li>
                        <?
                    }

                    if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
                    {
                        ?>
                        <li class="product-item-detail-tab" data-entity="tab" data-value="properties">
                            <a href="javascript:void(0);" class="product-item-detail-tab-link">
                                <span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
                            </a>
                        </li>
                        <?
                    }

                    if ($arParams['USE_COMMENTS'] === 'Y')
                    {
                        ?>
                        <li class="product-item-detail-tab" data-entity="tab" data-value="comments">
                            <a href="javascript:void(0);" class="product-item-detail-tab-link">
                                <span><?=$arParams['MESS_COMMENTS_TAB']?></span>
                            </a>
                        </li>
                        <?
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row" id="<?=$itemIds['TAB_CONTAINERS_ID']?>">
        <div class="col-xs-12">
            <?
            if ($showDescription)
            {
                ?>
                <div class="product-item-detail-tab-content active" data-entity="tab-container" data-value="description"
                    itemprop="description">
                    <?
                    if (
                        $arResult['PREVIEW_TEXT'] != ''
                        && (
                            $arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
                            || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
                        )
                    )
                    {
                        echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
                    }

                    if ($arResult['DETAIL_TEXT'] != '')
                    {
                        echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
                    }
                    ?>
                </div>
                <?
            }

            if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
            {
                ?>
                <div class="product-item-detail-tab-content" data-entity="tab-container" data-value="properties">
                    <?
                    if (!empty($arResult['DISPLAY_PROPERTIES']))
                    {
                        ?>
                        <dl class="product-item-detail-properties">
                            <?
                            foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
                            {
                                ?>
                                <dt><?=$property['NAME']?></dt>
                                <dd><?=(
                                    is_array($property['DISPLAY_VALUE'])
                                        ? implode(' / ', $property['DISPLAY_VALUE'])
                                        : $property['DISPLAY_VALUE']
                                    )?>
                                </dd>
                                <?
                            }
                            unset($property);
                            ?>
                        </dl>
                        <?
                    }

                    if ($arResult['SHOW_OFFERS_PROPS'])
                    {
                        ?>
                        <dl class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_PROP_DIV']?>"></dl>
                        <?
                    }
                    ?>
                </div>
                <?
            }

            if ($arParams['USE_COMMENTS'] === 'Y')
            {
                ?>
                <div class="product-item-detail-tab-content" data-entity="tab-container" data-value="comments" style="display: none;">
                    <?
                    $componentCommentsParams = array(
                        'ELEMENT_ID' => $arResult['ID'],
                        'ELEMENT_CODE' => '',
                        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                        'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
                        'URL_TO_COMMENT' => '',
                        'WIDTH' => '',
                        'COMMENTS_COUNT' => '5',
                        'BLOG_USE' => $arParams['BLOG_USE'],
                        'FB_USE' => $arParams['FB_USE'],
                        'FB_APP_ID' => $arParams['FB_APP_ID'],
                        'VK_USE' => $arParams['VK_USE'],
                        'VK_API_ID' => $arParams['VK_API_ID'],
                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                        'BLOG_TITLE' => '',
                        'BLOG_URL' => $arParams['BLOG_URL'],
                        'PATH_TO_SMILE' => '',
                        'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
                        'AJAX_POST' => 'Y',
                        'SHOW_SPAM' => 'Y',
                        'SHOW_RATING' => 'N',
                        'FB_TITLE' => '',
                        'FB_USER_ADMIN_ID' => '',
                        'FB_COLORSCHEME' => 'light',
                        'FB_ORDER_BY' => 'reverse_time',
                        'VK_TITLE' => '',
                        'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
                    );
                    if(isset($arParams["USER_CONSENT"]))
                        $componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
                    if(isset($arParams["USER_CONSENT_ID"]))
                        $componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
                    if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
                        $componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
                    if(isset($arParams["USER_CONSENT_IS_LOADED"]))
                        $componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
                    $APPLICATION->IncludeComponent(
                        'bitrix:catalog.comments',
                        '',
                        $componentCommentsParams,
                        $component,
                        array('HIDE_ICONS' => 'Y')
                    );
                    ?>
                </div>
                <?
            }
            ?>
        </div>
    </div>
</div>