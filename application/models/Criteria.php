<?php

class Model_Criteria
{

    /**
     * @var float
     */
    protected $_minPrice;

    /**
     * @var float
     */
    protected $_maxPrice;

    /**
     * @var boolean
     */
    protected $_withImages = true;

    /**
     * @var int
     */
    protected $_page;

    /**
     * @var int
     */
    protected $_itemsPerPage;

    /**
     * @var string
     */
    protected $_sortBy;

    /**
     * @var string
     */
    protected $_sortOrder;

    /**
     * @var array
     */
    protected $_categories = array();

    /**
     * Extra property
     * @var array()
     */
    protected $_attribs = array();

    /**
     * @param array $options
     */
    function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param array $options
     * @return Model_Finder_Product
     */
    public function setOptions($options = array())
    {
        foreach($options as $name => $value) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($this, $setter)) {
                call_user_func(array($this, $setter), $value);
            }
            else {
                $this->setAttrib($name, $value);
            }
        }
        return $this;
    }

    /**
     * @param int $itemsPerPage
     * @return Model_Criteria
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->_itemsPerPage = $itemsPerPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->_itemsPerPage;
    }

    /**
     * @param float $maxPrice
     * @return Model_Criteria
     */
    public function setMaxPrice($maxPrice)
    {
        $this->_maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPrice()
    {
        return $this->_maxPrice;
    }

    /**
     * @param float $minPrice
     * @return Model_Criteria
     */
    public function setMinPrice($minPrice)
    {
        $this->_minPrice = $minPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinPrice()
    {
        return $this->_minPrice;
    }

    /**
     * @param int $page
     * @return Model_Criteria
     */
    public function setPage($page)
    {
        $this->_page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->_page;
    }

    /**
     * @param boolean $withImages
     * @return Model_Criteria
     */
    public function setWithImages($withImages)
    {
        $this->_withImages = $withImages;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getWithImages()
    {
        return $this->_withImages;
    }

    /**
     * @param string $sortBy
     * @return Model_Criteria
     */
    public function setSortBy($sortBy)
    {
        $this->_sortBy = $sortBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortBy()
    {
        return $this->_sortBy;
    }

    /**
     * @param string $sortOrder
     * @return Model_Criteria
     */
    public function setSortOrder($sortOrder)
    {
        $this->_sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->_sortOrder;
    }

    /**
     * @param array $categories
     * @return Model_Criteria
     */
    public function setCategories($categories)
    {
        $this->_categories = $categories;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->_categories;
    }

    /**
     * @param array $aData
     * @return Model_Finder_Product
     */
    public function setAttribs($aData)
    {
        $this->_attribs = array_merge($this->_attribs, (array)$aData);
        return $this;
    }

    /**
     * Get Extra Prorepty
     * @return array
     */
    public function getAttribs()
    {
        return $this->_attribs;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return Model_Finder_Product
     */
    public function setAttrib($name, $value)
    {
        $this->_attribs[$name] = $value;
        return $this;
    }

    /**
     * @throws Model_Exception
     * @param string $name
     * @return mixed
     */
    public function getAttrib($name)
    {
        if (!$this->hasAttrib($name)) {
            throw new Model_Exception('Attribute named ' . $name . ' not found');
        }
        return $this->_attribs[$name];
    }

    /**
     * @throws Model_Exception
     * @param string $name
     * @return Model_Finder_Product
     */
    public function removeAttrib($name)
    {
        if (!$this->hasAttrib($name)) {
            throw new Model_Exception('Attribute named ' . $name . ' not found');
        }
        unset($this->_attribs[$name]);
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAttrib($name)
    {
        return array_key_exists($name, $this->_attribs);
    }
    
}