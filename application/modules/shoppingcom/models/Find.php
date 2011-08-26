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
     * Find Products
     * @param string $sKeyword
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $oCriteria)
    {
        $aOptions = $this->_getOption($oCriteria);
        $aOptions['keyword'] = $sKeyword;
//echo '<pre>'; print_r($aOptions); echo '</pre>';
        $this->_sourseResult = $this->_requestRest('GeneralSearch', $aOptions);

        return $this->_adjustData();
    } // function findProductsByKeywords

    /**
     * Find Products By Category
     * @param string $sKeyword
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProductsByCategory($iCategoryId, Model_Criteria $oCriteria)
    {
        $aOptions = $this->_getOption($oCriteria);
        $aOptions['categoryId'] = $iCategoryId;
        $this->_sourseResult    = $this->_requestRest('GeneralSearch', $aOptions);

        return $this->_adjustData();
    } // function findProductsByCategory

    /**
     * @param mixed $mOptions
     */
    protected function _getOption(Model_Criteria $oCriteria)
    {
        $aOptions = array();

        $nItemsPerPage = $oCriteria->getItemsPerPage();
        if ($nItemsPerPage) {
            $aOptions['numItems'] = $nItemsPerPage;
        }
        $nPage = $oCriteria->getPage();
        if ($nPage) {
            $aOptions['pageNumber'] = $nPage;
        }

        $aOptions['apiKey']     = $this->_options['apiKey'];
        $aOptions['trackingId'] = $this->_options['trackingId'];

        return $aOptions;
    } // function _getOption

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

                $oNewItem->setOptions(array(
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
                ));
                if (!empty($oItem->images->image)) {
                    foreach ($oItem->images->image as $oImage) {
                        $oNewItem->addImage((string)$oImage->sourceURL);
                    }
                }

                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    }
} // class Shoppingcom_Model_Find
?>