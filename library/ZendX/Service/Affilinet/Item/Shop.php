<?php

class ZendX_Service_Affilinet_Item_Shop extends ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var int
     */
    protected $_shopId;

    /**
     * @var Zend_Date
     */
    protected $_lastUpdate;

    /**
     * @var string
     */
    protected $_logoUrl = '';

    /**
     * @var int
     */
    protected $_products;

    /**
     * @var int
     */
    protected $_programId;

    /**
     * @var string
     */
    protected $_title = '';

    /**
     * @param string|Zend_Date $lastUpdate
     * @return self
     */
    public function setLastUpdate($lastUpdate)
    {
        if (is_string($lastUpdate)) {
            $lastUpdate = ZendX_Service_Affilinet_Abstract::getServerDateObject($lastUpdate);
        }
        $this->_lastUpdate = $lastUpdate;
        return $this;
    }

    /**
     * @return Zend_Date
     */
    public function getLastUpdate()
    {
        return $this->_lastUpdate;
    }

    /**
     * @param string $logoUrl
     * @return self
     */
    public function setLogoUrl($logoUrl)
    {
        $this->_logoUrl = $logoUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->_logoUrl;
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
     * @param int $programId
     * @return self
     */
    public function setProgramId($programId)
    {
        $this->_programId = $programId;
        return $this;
    }

    /**
     * @return int
     */
    public function getProgramId()
    {
        return $this->_programId;
    }

    /**
     * @param int $shopId
     * @return self
     */
    public function setShopId($shopId)
    {
        $this->_shopId = $shopId;
        return $this;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->_shopId;
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