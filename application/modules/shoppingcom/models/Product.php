<?php

class Shoppingcom_Model_Product extends Model_Finder_Product
{

    /**
     * @static
     * @param DOMDocument $oItem
     * @return Shoppingcom_Model_Product
     */
    public static function convertShoppingcomItem($oItem)
    {
        $aParams = array(
            'id'             => (string)$oItem['id'],
            'title'          => (string)$oItem->name,
            'description'    => (string)$oItem->fullDescription,
            //'currency'       => '',
            'price'          => (string)$oItem->minPrice,
            //'shippingPrice' => '',
            'url'            => (string)$oItem->productOffersURL,
            'images'         => array(),
            // ----- Extra property ----- \\
            'maxPrice'         => (string)$oItem->maxPrice,
            'categoryId'       => (string)$oItem->categoryId,
            'shortDescription' => (string)$oItem->shortDescription,
            'reviewCount'      => (string)$oItem->rating->reviewCount,
        );

        $oProduct = new self($aParams);

        if (!empty($oItem->images->image)) {
            foreach ($oItem->images->image as $oImage) {
                $oProduct->addImage((string)$oImage->sourceURL);
            }
        }

        return $oProduct;
    }


}