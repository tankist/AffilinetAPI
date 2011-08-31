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
    public function findProducts($sKeyword, Model_Criteria $oCriteria = null)
    {
        if (!$oCriteria) {
            $oCriteria = $this->getCriteria();
        }

        $iSearchType = $this->setSearchType($sKeyword);
        if (empty($iSearchType)) {
            // ToDo: MayBe make exception there
            return array();
        }

        $aCategories = $oCriteria->getCategories();
        $aOptions    = $this->_getOptions($oCriteria);

        if ($iSearchType & 1) {
            $this->_sourceData = $this->_service->findItemsAdvanced($sKeyword, true, empty($aCategories) ? null : $aCategories[0], $aOptions);
        } else {
            $this->_sourceData = $this->_service->findItemsByCategory($aCategories[0], $aOptions);
        }
        return $this->_parseResponse();
    } // function findProducts

    /**
     * @param Model_Criteria $oCriteria
     * @return array
     */
    protected function _getOptions(Model_Criteria $oCriteria)
    {
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
    protected function _parseResponse()
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
