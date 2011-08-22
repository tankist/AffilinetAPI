<?php
/**
 * Finding in goods in eBay
 *
 * @author Alexandr Nosov
 */
require_once 'Zend/Service/Ebay/Finding.php';

class Ebay_Model_FindEbay extends Model_FindShopProduct
{
    /**
     * Ebay Finding object
     * @var Zend_Service_Ebay_Finding
     */
    protected $_ebayFinding;

    /**
     * find ebay constructor
     */
    public function __construct($options = array())
    {
        parent::__construct($options);

        $aOptions = array(
            Zend_Service_Ebay_Abstract::OPTION_APP_ID => $this->_options['APP_ID'],
        );
        $this->_ebayFinding = new Zend_Service_Ebay_Finding($aOptions);
    } // function __construct

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param array  $aOptions
     * @return array
     */
    public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsByKeywords($sKeyword, $aOptions);
        return $this->_adjustData();
    } // function findProductsByKeywords

    /**
     * Advanced Find Products By Keywords
     * @param string  $sKeyword
     * @param boolean $descriptionSearch
     * @param integer $categoryId
     * @param array   $aOptions
     * @return array
     */
    public function findProductsAdvanced($sKeyword, $nPage = 1, $descriptionSearch = true, $categoryId = null, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsAdvanced($sKeyword, $descriptionSearch, $categoryId, $aOptions);
        return $this->_adjustData();
    } // function findProductsAdvanced

    /**
     * Find Products By Category
     * @param integer $iCategoryId
     * @param array   $aOptions
     * @return array
     */
    public function findProductsByCategory($iCategoryId, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsByCategory($iCategoryId, $aOptions);
        return $this->_adjustData();
    } // function findProductsByCategory

    /**
     * Find Products In Ebay Stores
     * @param string $sStoreName
     * @param array  $aOptions
     * @return array
     */
    public function findProductsInEbayStores($sStoreName, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsInEbayStores($sStoreName, $aOptions);
        return $this->_adjustData();
    } // function findProductsInEbayStores

    /**
     * Find Products In Ebay Stores
     * @param integer $iProductId
     * @param string  $sProductIdType
     * @param array   $aOptions
     * @return array
     */
    public function findProductById($iProductId, $sProductIdType = null, $aOptions = null)
    {
        $this->_modifyOption($aOptions);
        $this->_sourceData = $this->_ebayFinding->findItemsByProduct($iProductId, $sProductIdType, $aOptions);
        return $this->_adjustData();
    } // function findProductsInEbayStores

    /**
     * Modify Options
     * @return array
     */
    protected function _modifyOption(&$aOptions, $nPage = 1)
    {
        if (!isset($aOptions['paginationInput']['entriesPerPage'])) {
            $aOptions['paginationInput']['entriesPerPage'] = $this->_options->item_qtt;
        }
        if (!isset($aOptions['paginationInput']['pageNumber'])) {
            $aOptions['paginationInput']['pageNumber'] = $nPage;
        }

        if (!is_null($this->_addFilters['minPrice'])) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MinPrice',
                'value' => $this->_addFilters['minPrice'],
                //'paramName'  => 'Currency',
                //'paramValue' => 'USD'
            );
        }
        if (!is_null($this->_addFilters['maxPrice'])) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MaxPrice',
                'value' => $this->_addFilters['maxPrice'],
                //'paramName'  => 'Currency',
                //'paramValue' => 'USD'
            );
        }

    } // function _modifyOption

    /**
     * Get Config data
     * @return array
     */
    protected function _adjustData()
    {
        $this->_adjustedData = array();
        if (!empty($this->_sourceData->searchResult)) {
            foreach ($this->_sourceData->searchResult->item as $oItem) {
                $oNewItem = new Model_ShopProduct();

                $aAttr = $oItem->listingInfo->attributes('buyItNowPrice');
                $oNewItem->setMainProrepty(array(
                    'originalId'     => $oItem->itemId,
                    'title'          => $oItem->title,
                    'subtitle'       => $oItem->subtitle,
                    //'description'    => $oItem->,
                    'currency'       => empty($aAttr['currencyId']) ? null : $aAttr['currencyId'],
                    'price'          => $oItem->listingInfo->buyItNowPrice,
                    'shipping_price' => $oItem->shippingInfo->shippingServiceCost,
                    'originalURL'    => $oItem->viewItemURL,
                    'pictureURL'     => isset($oItem->galleryPlusPictureURL[0]) ? $oItem->galleryPlusPictureURL[0] : null,
                    'country'        => $oItem->country,
                    'expireTime'     => $oItem->listingInfo->endTime,
                ));
                $oNewItem->setExtraProrepty(array(
                    'globalId'          => $oItem->globalId,
                    'productId'         => $oItem->productId,
                    'buyItNowAvailable' => $oItem->listingInfo->buyItNowAvailable,
                    'startTime'         => $oItem->listingInfo->startTime,
                    'location'          => $oItem->location,
                ));
                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    }

}