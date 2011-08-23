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
     * @var Zend_Config_Ini
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
    protected $_addFilters = array();

    /**
     *
     * @param string $sShopName
     */
    function __construct($options = array()) {
        $this->_options = $options;

        $this->resetFilter();
    } // function __construct

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param array  $aOptions
     * @return array
     */
    abstract public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = array());

    /**
     * Reset Filter
     */
    public function resetFilter()
    {
        $this->_addFilters = array(
            'minPrice' => null,
            'maxPrice' => null,
        );
    } // function resetFilter

    /**
     * Set Filter by Min Price
     * @param numeric $nMinPrice
     */
    public function setMinPriceFilter($nMinPrice)
    {
        $this->_addFilters['minPrice'] = $nMinPrice;
    } // function setMinPriceFilter

    /**
     * Set Filter by Max Price
     * @param numeric $nMaxPrice
     */
    public function setMaxPriceFilter($nMaxPrice)
    {
        $this->_addFilters['maxPrice'] = $nMaxPrice;
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
     * @return Zend_Config_Ini
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