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
    protected $_data = array();

    /**
     * @param array $options
     */
    function __construct($options = array()) {
        $this->_options = $options;
    }

    /**
     * @abstract
     * @param string $sKeyword
     * @param Model_Criteria $criteria
     * @return void
     */
    abstract public function findProducts($sKeyword, Model_Criteria $criteria);

    /**
     * Get Source Data
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
    public function getData()
    {
        return $this->_data;
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