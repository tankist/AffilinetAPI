<?php

class Adsense_Model_Product extends Model_Finder_Product
{

    /**
     * @static
     * @param DOMDocument $oItem
     * @return Shoppingcom_Model_Product
     */
    public static function convertAdsenseItem($oItem)
    {
        $aParams = array(
        );


        $oProduct = new self($aParams);
/*
        if (!empty($oItem->imageurl)) {
            $oProduct->addImage((string)$oItem->imageurl);
        }
*/
        return $oProduct;
    }

}