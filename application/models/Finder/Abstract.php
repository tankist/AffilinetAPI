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
     * 0 - nothing serching
     * 1 - search by keyword only
     * 2 - search by category only
     * 3 - search by keyword and category
     * @var integer
     */
    protected $_searchType;

    /**
     * @param array $options
     */
    public function __construct($options = array()) {
        $this->setOptions($options);
    }

    /**
     * Get Source Data
     * @return mixed
     */
    public function getSourseData()
    {
        return $this->_sourceData;
    }

    /**
     * Get Adjusted data
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param array $options
     * @return Model_Finder_Abstract
     */
    public function setOptions($options = array())
    {
        $this->_options = array();
        if (array_key_exists('criteria', $options)) {
            $this->getCriteria()->setOptions($options['criteria']);
            unset($options['criteria']);
        }
        foreach($options as $name => $value) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($this, $setter)) {
                call_user_func(array($this, $setter), $value);
            }
            else {
                $this->_options[$name] = $value;
            }
        }
        return $this;
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
     * @return Model_Criteria
     */
    public function getCriteria()
    {
        if (empty($this->_criteria)) {
            $this->_criteria = new Model_Criteria();
        }
        return $this->_criteria;
    }

    /**
     * Set Search Type
     * @param string $sKeyword
     * @return integer
     */
    public function setSearchType($sKeyword)
    {
        $this->_searchType = empty($sKeyword) ? 0 : 1;
        if ($this->_criteria->getCategories()) {
            $this->_searchType += 2;
        }
        return $this->_searchType;
    }

    /**
     * @abstract
     * @param string $sKeyword
     * @param Model_Criteria $criteria
     * @return void
     */
    abstract public function findProducts($sKeyword, Model_Criteria $criteria = null);

}