<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of findShoppingCom
 *
 * @author Alex
 */
class Shoppingcom_Model_Find extends Model_FindShopProduct
{
    /**
     * find Shopping.Com constructor
     */
    function __construct($options = array())
    {
        parent::__construct($options);
    } // function __construct

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param array  $aOptions
     * @return array
     */
    public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions);
        $aOptions['keyword'] = $sKeyword;
        $this->_sourseResult = $this->_findItems('GeneralSearch', $nPage, $aOptions);

        $aRet = array();
        $oSXML = @simplexml_import_dom($this->_sourseResult)->categories->category->items;
//return $oSXML;
        if ($oSXML && !empty($oSXML->product)) {
            foreach ($oSXML->product as $oItem) {
                $oNewItem = new Model_ShopProduct();

                $oNewItem->setMainProrepty(array(
                    'originalId'     => (string)$oItem['id'],
                    'title'          => (string)$oItem->name,
                    //'subtitle'       => '',
                    'description'    => (string)$oItem->fullDescription,
                    //'currency'       => '',
                    'price'          => (string)$oItem->minPrice,
                    //'shipping_price' => '',
                    'originalURL'    => (string)$oItem->productOffersURL,
                    'pictureURL'     => isset($oItem->images->image[0]->sourceURL) ? (string)$oItem->images->image[0]->sourceURL : null,
                    //'country'        => '',
                    //'expireTime'     => '',
                ));
                $oNewItem->setExtraProrepty(array(
                    'maxPrice'         => (string)$oItem->maxPrice,
                    'categoryId'       => (string)$oItem->categoryId,
                    'shortDescription' => (string)$oItem->shortDescription,
                    'reviewCount'      => (string)$oItem->rating->reviewCount,
                ));
                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    } // function findProductsByKeywords

    /**
     * @param  array  $aOptions
     * @param  string $sOperation
     * @return DOMNode
     */
    protected function _findItems($sOperation, $nPage, array $aOptions)
    {
        if (!isset($aOptions['numItems'])) {
            $aOptions['numItems'] = $this->_options['item_qtt'];
        }
        if (!isset($aOptions['pageNumber'])) {
            $aOptions['pageNumber'] = $nPage;
        }

        // do request
        $oDom = $this->_request($sOperation, $aOptions);
        return $oDom;
    }

    /**
     * @param mixed $mOptions
     */
    protected function _modifyOption(&$mOptions)
    {
        if (!is_array($mOptions)) {
            $mOptions = is_null($mOptions) ? array() : array($mOptions);
        }

        $mOptions['apiKey']     = $this->_options['apiKey'];
        $mOptions['trackingId'] = $this->_options['trackingId'];

        return $mOptions;
    } // function _modifyOption
} // class Shoppingcom_Model_Find
?>