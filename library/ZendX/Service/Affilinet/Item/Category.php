<?php

class ZendX_Service_Affilinet_Item_Category extends ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var int
     */
    protected $_categoryId = 0;

    /**
     * @var int
     */
    protected $_parentCategoryId = 0;

    /**
     * @var string
     */
    protected $_categoryPath = '';

    /**
     * @var int
     */
    protected $_products = 0;

    /**
     * @var string
     */
    protected $_title = '';

    /**
     * @param int $categoryId
     * @return self
     */
    public function setCategoryId($categoryId)
    {
        $this->_categoryId = $categoryId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->_categoryId;
    }

    /**
     * @param string $categoryPath
     * @return self
     */
    public function setCategoryPath($categoryPath)
    {
        $this->_categoryPath = $categoryPath;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryPath()
    {
        return $this->_categoryPath;
    }

    /**
     * @param int $parentCategoryId
     * @return self
     */
    public function setParentCategoryId($parentCategoryId)
    {
        $this->_parentCategoryId = $parentCategoryId;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentCategoryId()
    {
        return $this->_parentCategoryId;
    }

    /**
     * @param int $products
     * @return self
     */
    public function setProducts($products)
    {
        $this->_products = $products;
        return $this;
    }

    /**
     * @return int
     */
    public function getProducts()
    {
        return $this->_products;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }
}