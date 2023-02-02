<meta itemprop="name" content="<?=$name?>">
<meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>">

<?
if ($haveOffers)
{
    foreach ($arResult['JS_OFFERS'] as $offer)
    {
        $currentOffersList = array();

        if (!empty($offer['TREE']) && is_array($offer['TREE']))
        {
            foreach ($offer['TREE'] as $propName => $skuId)
            {
                $propId = (int)substr($propName, 5);

                foreach ($skuProps as $prop)
                {
                    if ($prop['ID'] == $propId)
                    {
                        foreach ($prop['VALUES'] as $propId => $propValue)
                        {
                            if ($propId == $skuId)
                            {
                                $currentOffersList[] = $propValue['NAME'];
                                break;
                            }
                        }
                    }
                }
            }
        }

        $offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
        ?>
        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
            <meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
            <meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
            <link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
        </span>
        <?
    }

    unset($offerPrice, $currentOffersList);
}
else
{
    ?>
    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
        <meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
        <link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
    </span>
    <?
}
?>