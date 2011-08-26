<?php

class Ebay_Model_Product extends Model_Finder_Product
{

    /**
     * @static
     * @param Zend_Service_Ebay_Finding_Search_Item $oItem
     * @return Ebay_Model_Product
     */
    public static function convertEbayItem($oItem)
    {
        $aAttr = $oItem->listingInfo->attributes('buyItNowPrice');
        $aParams = array(
            // ----- Main property ----- \\
            'id'            => $oItem->itemId,
            'title'         => $oItem->title,
            //'description'   => $oItem->, // ToDo it
            'currency'      => empty($aAttr['currencyId']) ? null : $aAttr['currencyId'],
            'shippingPrice' => $oItem->shippingInfo->shippingServiceCost,
            'url'           => $oItem->viewItemURL,

            // ----- Extra property ----- \\
            'country'           => $oItem->country,
            'subtitle'          => $oItem->subtitle,
            'globalId'          => $oItem->globalId,
            'productId'         => $oItem->productId,
            'buyItNowPrice'     => $oItem->listingInfo->buyItNowPrice,
            'buyItNowAvailable' => $oItem->listingInfo->buyItNowAvailable,
            'location'          => $oItem->location,
            'startTime'         => $oItem->listingInfo->startTime,
            'expireTime'        => $oItem->listingInfo->endTime,
        );

        $aParams['price'] = ($oItem->sellingStatus->currentPrice)
                                ? $oItem->sellingStatus->currentPrice
                                : $aParams['buyItNowPrice'];

        if (!empty($aAttr['currencyId'])) {
            $aParams['currency'] = $aAttr['currencyId'];
        }

        $oProduct = new self($aParams);

        if (!empty($oItem->galleryPlusPictureURL) && is_array($oItem->galleryPlusPictureURL)) {
            $oProduct->setImages($oItem->galleryPlusPictureURL);
        }
        elseif (!empty($oItem->galleryURL)) {
            $oProduct->addImage($oItem->galleryURL);
        }

        return $oProduct;
    }

}