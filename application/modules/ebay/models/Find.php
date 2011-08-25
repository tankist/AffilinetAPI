<?php
/**
 * Finding in goods in eBay
 *
 * @author Alexandr Nosov
 */
require_once 'Zend/Service/Ebay/Finding.php';

class Ebay_Model_Find extends Model_FindShopProduct
{
    /**
     * Ebay Finding object
     * @var Zend_Service_Ebay_Finding
     */
    protected $_ebayFinding;

    /**
     * @param array $options
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
     * @param string $sKeyword
     * @param int $nPage
     * @param null $aOptions
     * @return array
     */
    public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsByKeywords($sKeyword, $aOptions);
        return $this->_adjustData();
    } // function findProductsByKeywords

    /**
     * @param string $sKeyword
     * @param int $nPage
     * @param bool $descriptionSearch
     * @param null $categoryId
     * @param null $aOptions
     * @return array
     */
    public function findProductsAdvanced($sKeyword, $nPage = 1, $descriptionSearch = true, $categoryId = null, $aOptions = null)
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsAdvanced($sKeyword, $descriptionSearch, $categoryId, $aOptions);
        return $this->_adjustData();
    } // function findProductsAdvanced

    /**
     * @param int $iCategoryId
     * @param int $nPage
     * @param array $aOptions
     * @return array
     */
    public function findProductsByCategory($iCategoryId, $nPage = 1, $aOptions = array())
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsByCategory($iCategoryId, $aOptions);
        return $this->_adjustData();
    } // function findProductsByCategory

    /**
     * @param string $sStoreName
     * @param int $nPage
     * @param array $aOptions
     * @return array
     */
    public function findProductsInEbayStores($sStoreName, $nPage = 1, $aOptions = array())
    {
        $this->_modifyOption($aOptions, $nPage);
        $this->_sourceData = $this->_ebayFinding->findItemsInEbayStores($sStoreName, $aOptions);
        return $this->_adjustData();
    } // function findProductsInEbayStores

    /**
     * Find Products In Ebay Stores
     * @param integer $iProductId
     * @param string $sProductIdType
     * @param array $aOptions
     * @return array
     */
    public function findProductById($iProductId, $sProductIdType = null, $aOptions = array())
    {
        $this->_modifyOption($aOptions);
        $this->_sourceData = $this->_ebayFinding->findItemsByProduct($iProductId, $sProductIdType, $aOptions);
        return $this->_adjustData();
    } // function findProductsInEbayStores

    /**
     * @param $aOptions
     * @param int $nPage
     * @return void
     */
    protected function _modifyOption(&$aOptions, $nPage = 1)
    {
        if (!isset($aOptions['paginationInput']['entriesPerPage'])) {
            $aOptions['paginationInput']['entriesPerPage'] = $this->_options['item_qtt'];
        }
        if (!isset($aOptions['paginationInput']['pageNumber'])) {
            $aOptions['paginationInput']['pageNumber'] = $nPage;
        }

        if (!@is_null($this->_addFilters['minPrice'])) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MinPrice',
                'value' => $this->_addFilters['minPrice'],
                //'paramName'  => 'Currency',
                //'paramValue' => 'USD'
            );
        }
        if (!@is_null($this->_addFilters['maxPrice'])) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MaxPrice',
                'value' => $this->_addFilters['maxPrice'],
                //'paramName'  => 'Currency',
                //'paramValue' => 'USD'
            );
        }

    } // function _modifyOption

    /**
     * @return array
     */
    protected function _adjustData()
    {
        $this->_adjustedData = array();
        if (!empty($this->_sourceData->searchResult)) {
            foreach ($this->_sourceData->searchResult->item as $oItem) {
//echo '<div>' . htmlentities($this->_sourceData->getDom()->ownerDocument->saveXML()) . '</div>';
//echo '<pre>' . htmlentities(print_r($oItem, true)) . '</pre>';
                $oNewItem = new Model_ShopProduct();

                $aAttr = $oItem->listingInfo->attributes('buyItNowPrice');
                $oNewItem->setOptions(array(
                    // ----- Main property ----- \\
                    'id'            => $oItem->itemId,
                    'title'         => $oItem->title,
                    //'description'   => $oItem->,
                    'currency'          => empty($aAttr['currencyId']) ? null : $aAttr['currencyId'],
                    'price'         => $oItem->listingInfo->buyItNowPrice,
                    'shippingPrice' => $oItem->shippingInfo->shippingServiceCost,
                    'url'           => $oItem->viewItemURL,
                    // ----- Extra property ----- \\
                    'country'           => $oItem->country,
                    'subtitle'          => $oItem->subtitle,
                    'globalId'          => $oItem->globalId,
                    'productId'         => $oItem->productId,
                    'buyItNowAvailable' => $oItem->listingInfo->buyItNowAvailable,
                    'location'          => $oItem->location,
                    'startTime'         => $oItem->listingInfo->startTime,
                    'expireTime'        => $oItem->listingInfo->endTime,
                ));
                if (!empty($oItem->galleryPlusPictureURL)) {
                    if (is_array($oItem->galleryPlusPictureURL) && 0) {
                        $oNewItem->setImages($oItem->galleryPlusPictureURL);
                    } else {
                        foreach ($oItem->galleryPlusPictureURL as $oImage) {
                            $oNewItem->addImage((string)$oImage);
                        }
                    }
                } elseif (!empty($oItem->galleryURL)) {
                    $oNewItem->addImage($oItem->galleryURL);
                }

                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    }

}
