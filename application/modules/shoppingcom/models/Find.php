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

        return $this->_adjustData();
    } // function findProductsByKeywords

    /**
     * Find Products By Category
     * @param integer $iCategoryId
     * @param array  $aOptions
     * @return array
     */
    public function findProductsByCategory($iCategoryId, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions);
        $aOptions['categoryId'] = $iCategoryId;
        $this->_sourseResult = $this->_findItems('GeneralSearch', $nPage, $aOptions);

        return $this->_adjustData();
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

    /**
     * Get Config data
     * @return array
     */
    protected function _adjustData()
    {
        $this->_adjustedData = array();

        $oSXML = @simplexml_import_dom($this->_sourseResult);
//return $oSXML;
        foreach (array('categories', 'category', 'items') as $prop) {
            if (empty($oSXML->$prop)) {
                break;
                // ToDo: throw exception there
            } else {
                $oSXML = $oSXML->$prop;
            }
        }


        if ($oSXML && !empty($oSXML->product)) {
            foreach ($oSXML->product as $oItem) {
                $oNewItem = new Model_ShopProduct();

                // Set Main property
                $aMainProp = array(
                    'id'             => (string)$oItem['id'],
                    'title'          => (string)$oItem->name,
                    'description'    => (string)$oItem->fullDescription,
                    //'currency'       => '',
                    'price'          => (string)$oItem->minPrice,
                    //'shippingPrice' => '',
                    'url'            => (string)$oItem->productOffersURL,
                    'images'         => array(),
                );
                if (!empty($oItem->images->image)) {
                    foreach ($oItem->images->image as $oImage) {
                        $aMainProp['images'][] = (string)$oImage->sourceURL;
                    }
                }
                $oNewItem->setMainProrepty($aMainProp);

                // Set Extra property
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
    }
} // class Shoppingcom_Model_Find
?>