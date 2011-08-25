<?php

class Model_Criteria extends Model_ShopProduct
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
}