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
    protected $_service;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        parent::__construct($options);

        $aOptions = array(
            Zend_Service_Ebay_Abstract::OPTION_APP_ID => $this->_options['APP_ID'],
        );
        $this->_service = new Zend_Service_Ebay_Finding($aOptions);
    } // function __construct

    /**
     * @param string $sKeyword
     * @param Model_Criteria $criteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $criteria)
    {
        $aOptions = $this->_modifyOption($criteria);
        $this->_sourceData = $this->_service->findItemsByKeywords($sKeyword, $aOptions);
        return $this->_processResponse();
    } // function findProducts

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
        $this->_sourceData = $this->_service->findItemsAdvanced($sKeyword, $descriptionSearch, $categoryId, $aOptions);
        return $this->_processResponse();
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
        $this->_sourceData = $this->_service->findItemsByCategory($iCategoryId, $aOptions);
        return $this->_processResponse();
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
        $this->_sourceData = $this->_service->findItemsInEbayStores($sStoreName, $aOptions);
        return $this->_processResponse();
    } // function findProductsInEbayStores

    /**
     * Find Products In Ebay Stores
     * @param integer $iProductId
     * @param string $sProductIdType
     * @param array $aOptions
     * @return array
     */
    public function getProductById($iProductId, $sProductIdType = null, $aOptions = array())
    {
        $this->_modifyOption($aOptions);
        $this->_sourceData = $this->_service->findItemsByProduct($iProductId, $sProductIdType, $aOptions);
        return $this->_processResponse();
    } // function findProductsInEbayStores

    /**
     * @param Model_Criteria $criteria
     * @return array
     */
    protected function _modifyOption(Model_Criteria $criteria)
    {
        $aOptions = array();
        if ($itemsPerPage = $criteria->getItemsPerPage()) {
            $aOptions['paginationInput']['entriesPerPage'] = $itemsPerPage;
        }
        if ($page = $criteria->getPage()) {
            $aOptions['paginationInput']['pageNumber'] = $page;
        }

        if ($minPrice = $criteria->getMinPrice()) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MinPrice',
                'value' => $minPrice
            );
        }
        if ($maxPrice = $criteria->getMaxPrice()) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MaxPrice',
                'value' => $maxPrice
            );
        }
        return $aOptions;
    }

    /**
     * @return array
     */
    protected function _processResponse()
    {
        $this->_data = array();
        if (!empty($this->_sourceData->searchResult)) {
            foreach ($this->_sourceData->searchResult->item as $oItem) {
                $this->_data[] = Ebay_Model_Product::convertEbayItem($oItem);
            }
        }
        return $this->_data;
    }

}