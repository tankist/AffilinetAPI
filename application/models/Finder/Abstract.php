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
abstract class Model_Finder_Abstract
{
    /**
     * Current config
     * @var array
     */
    protected $_options;

    /**
     * Sourse data of Request result
     * @var mixed
     */
    protected $_sourceData;

    /**
     * Adjusted data of products
     * @var array
     */
    protected $_data = array();

    /**
     * @var Model_Criteria
     */
    protected $_criteria;

    /**
     * @param array $options
     */
    public function __construct($options = array()) {
        $this->_options = $options;
    }

    /**
     * Get Source Data
     * @return mixed
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
     * @param Model_Criteria $criteria
     * @return Model_Finder_Abstract
     */
    public function setCriteria($criteria)
    {
        $this->_criteria = $criteria;
        return $this;
    }

    /**
     * @return \Model_Criteria
     */
    public function getCriteria()
    {
        if (empty($this->_criteria)) {
            $this->_criteria = new Model_Criteria();
        }
        return $this->_criteria;
    }

    /**
     * @abstract
     * @param string $sKeyword
     * @param Model_Criteria $criteria
     * @return void
     */
    abstract public function findProducts($sKeyword, Model_Criteria $criteria = null);

}