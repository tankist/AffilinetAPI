<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * abstract class for findShopProduct
 *
 * @author Alex
 */
abstract class Model_FindShopProduct
{
    /**
     * Current config
     * @var array
     */
    protected $_options;

    /**
     * Rest Client
     * @var Zend_Rest_Client
     */
    protected $_client;

    /**
     * Sourse data of Request result
     * @var array
     */
    protected $_sourceData = array();

    /**
     * Adjusted data of products
     * @var array
     */
    protected $_adjustedData = array();

    /**
     * Add filters
     * @var array
     */
    protected $_filters = array();

    /**
     * @param array $options
     */
    function __construct($options = array()) {
        $this->_options = $options;

        $this->resetFilter();
    }

    /**
     * @abstract
     * @param string $sKeyword
     * @param int $nPage
     * @param array $aOptions
     * @return void
     */
    abstract public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = array());

    /**
     * Reset Filter
     * @return void
     */
    public function resetFilter()
    {
        $this->_filters = array(
            'minPrice' => 0,
            'maxPrice' => 0,
        );
    } // function resetFilter

    /**
     * Set Filter by Min Price
     * @param numeric $nMinPrice
     */
    public function setMinPriceFilter($nMinPrice)
    {
        $this->_filters['minPrice'] = (float)$nMinPrice;
    } // function setMinPriceFilter

    /**
     * Set Filter by Max Price
     * @param numeric $nMaxPrice
     */
    public function setMaxPriceFilter($nMaxPrice)
    {
        $this->_filters['maxPrice'] = (float)$nMaxPrice;
    } // function setMaxPriceFilter

    /**
     * Get Sourse Data
     * @return array
     */
    public function getSourseData()
    {
        return $this->_sourceData;
    } // function getSourseData

    /**
     * Get Adjusted data
     * @return array
     */
    public function getAdjustedData()
    {
        return $this->_adjustedData;
    }

    /**
     * Get Config data
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @return Zend_Rest_Client
     */
    public function getClient()
    {
        if (!$this->_client instanceof Zend_Rest_Client) {
            require_once 'Zend/Rest/Client.php';
            $this->_client = new Zend_Rest_Client();
        }
        return $this->_client;
    }
} // class findShoppingCom
?>