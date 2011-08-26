<?php

class Linkshare_Model_Product extends Model_Finder_Product
{

    /**
     * @static
     * @param DOMDocument $oItem
     * @return Shoppingcom_Model_Product
     */
    public static function convertLinkshareItem($oItem)
    {
        $aParams = array(
            // ----- Main property ----- \\
            'id'            => (string)$oItem['linkid'],
            'title'         => (string)$oItem->productname,
            'description'   => (string)$oItem->description->long,
            //'currency'      => '',
            'price'         => (string)$oItem->price,
            //'shippingPrice' => '',
            'url'           => (string)$oItem->linkurl,
            // ----- Extra property ----- \\
            'mid'              => (string)$oItem->mid,
            'merchantname'     => (string)$oItem->merchantname,
            'createdon'        => (string)$oItem->createdon,
            'shortDescription' => (string)$oItem->description->short,
            'sku'              => (string)$oItem->sku,
        );


        $oProduct = new self($aParams);

        if (!empty($oItem->imageurl)) {
            $oProduct->addImage((string)$oItem->imageurl);
        }

        return $oProduct;
    }

}