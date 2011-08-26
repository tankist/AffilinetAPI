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
        $params = array(
            'id'                => $oItem->itemId,
            'title'             => $oItem->title,
            'subtitle'          => $oItem->subtitle,
            'shippingPrice'     => $oItem->shippingInfo->shippingServiceCost,
            'url'               => $oItem->viewItemURL,
            'country'           => $oItem->country,
            'expireTime'        => $oItem->listingInfo->endTime,
            'globalId'          => $oItem->globalId,
            'productId'         => $oItem->productId,
            'buyItNowAvailable' => $oItem->listingInfo->buyItNowAvailable,
            'buyItNowPrice'     => $oItem->listingInfo->buyItNowPrice,
            'startTime'         => $oItem->listingInfo->startTime,
            'location'          => $oItem->location,
        );

        $params['price'] = ($oItem->sellingStatus->currentPrice)
                                ?$oItem->sellingStatus->currentPrice
                                :$params['buyItNowPrice'];

        if (!empty($aAttr['currencyId'])) {
            $params['currency'] = $aAttr['currencyId'];
        }
        
        $product = new self($params);

        if (!empty($oItem->galleryPlusPictureURL) && is_array($oItem->galleryPlusPictureURL)) {
            $product->setImages($oItem->galleryPlusPictureURL);
        }
        elseif (!empty($oItem->galleryURL)) {
            $product->addImage($oItem->galleryURL);
        }

        return $product;
    }

}