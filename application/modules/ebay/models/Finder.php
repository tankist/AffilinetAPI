<?php
/**
 * Finding in goods in eBay
 *
 * @author Alexandr Nosov
 */
require_once 'Zend/Service/Ebay/Finding.php';

class Ebay_Model_Finder extends Model_Finder_Rest
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
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $criteria = null)
    {
        $aOptions = $this->_getOption($oCriteria);
        $this->_sourceData = $this->_service->findItemsByKeywords($sKeyword, $aOptions);
        return $this->_parseRestResponse();
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
        $this->_getOption($aOptions, $nPage);
        $this->_sourceData = $this->_service->findItemsAdvanced($sKeyword, $descriptionSearch, $categoryId, $aOptions);
        return $this->_parseRestResponse();
    } // function findProductsAdvanced

    /**
     * @param int $iCategoryId
     * @param int $nPage
     * @param array $aOptions
     * @return array
     */
    public function findProductsByCategory($iCategoryId, $nPage = 1, $aOptions = array())
    {
        $this->_getOption($aOptions, $nPage);
        $this->_sourceData = $this->_service->findItemsByCategory($iCategoryId, $aOptions);
        return $this->_parseRestResponse();
    } // function findProductsByCategory

    /**
     * @param string $sStoreName
     * @param int $nPage
     * @param array $aOptions
     * @return array
     */
    public function findProductsInEbayStores($sStoreName, $nPage = 1, $aOptions = array())
    {
        $this->_getOption($aOptions, $nPage);
        $this->_sourceData = $this->_service->findItemsInEbayStores($sStoreName, $aOptions);
        return $this->_parseRestResponse();
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
        $this->_getOption($aOptions);
        $this->_sourceData = $this->_service->findItemsByProduct($iProductId, $sProductIdType, $aOptions);
        return $this->_parseRestResponse();
    } // function findProductsInEbayStores

    /**
     * @param Model_Criteria $oCriteria
     * @return array
     */
    protected function _getOption(Model_Criteria $oCriteria)
    {
        if (is_null($oCriteria)) {
            $oCriteria = $this->getCriteria();
        }
        $aOptions = array();

        $nItemsPerPage = $oCriteria->getItemsPerPage();
        if ($nItemsPerPage) {
            $aOptions['paginationInput']['entriesPerPage'] = $nItemsPerPage;
        }
        $nPage = $oCriteria->getPage();
        if ($nPage) {
            $aOptions['paginationInput']['pageNumber'] = $nPage;
        }

        $nMinPrice = $oCriteria->getMinPrice();
        if ($nMinPrice) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MinPrice',
                'value' => $nMinPrice
            );
        }
        $nMaxPrice = $oCriteria->getMaxPrice();
        if ($nMaxPrice) {
            $aOptions['itemFilter'][] = array(
                'name'  => 'MaxPrice',
                'value' => $nMaxPrice
            );
        }
        return $aOptions;
    } // function _getOption

    /**
     * @return array
     */
    protected function _parseRestResponse()
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