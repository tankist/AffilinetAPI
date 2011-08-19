<?php

class ZendX_Service_Affilinet_Criteria_Product extends ZendX_Service_Affilinet_Criteria_Abstract
{

    const NO_IMAGE = 'NoImage';
    const IMAGE_SIZE_30_50 = 'Image30Logo50';
    const IMAGE_SIZE_60_90 = 'Image60Logo90';
    const IMAGE_SIZE_90_120 = 'Image90Logo120';
    const IMAGE_SIZE_120_150 = 'Image120Logo150';
    const IMAGE_SIZE_180_468 = 'Image180Logo468';
    const ALL_IMAGES = 'AllImages';

    const SORT_PRICE = 'Price';
    const SORT_TITLE = 'title';
    const SORT_RANK = 'Rank';

    /**
     * @var int
     */
    protected $_publisherId = 0;

    /**
     * @var int
     */
    protected $_minPrice = 0;

    /**
     * @var int
     */
    protected $_maxPrice = 0;

    /**
     * @var bool
     */
    protected $_withImages = false;

    /**
     * @var bool
     */
    protected $_withDetails = false;

    /**
     * @var string
     */
    protected $_imageSize = '';

    /**
     * @var array
     */
    protected $_shopIds = array(0);

    /**
     * @throws ZendX_Service_Affilinet_Criteria_Exception
     * @return array
     */
    public function toArray()
    {
        $params = parent::toArray();
        if (!($publisher = $this->getPublisherId())) {
            throw new ZendX_Service_Affilinet_Criteria_Exception('Publisher not found');
        }
        $params['PublisherId'] = $publisher;
        $params['WithImageOnly'] = $this->getWithImages();
        $params['Details'] = $this->getWithDetails();
        $params['MinimumPrice'] = ($this->getMinPrice() > 0)?$this->getMinPrice():0;
        $params['MaximumPrice'] = ($this->getMaxPrice() > 0)?$this->getMaxPrice():0;
        $params['ShopIds'] = (($shops = $this->getShopIds()) && is_array($shops))?$shops:array(0);
        $params['ImageSize'] = ($imageSize = $this->getImageSize())?$imageSize:self::ALL_IMAGES;
        if (!isset($params['SortBy']) || !$params['SortBy']) {
            $params['SortBy'] = self::SORT_RANK;
        }
        return $params;
    }

    /**
     * @param int $maxPrice
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setMaxPrice($maxPrice)
    {
        $this->_maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxPrice()
    {
        return $this->_maxPrice;
    }

    /**
     * @param int $minPrice
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setMinPrice($minPrice)
    {
        $this->_minPrice = $minPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinPrice()
    {
        return $this->_minPrice;
    }

    /**
     * @param array $shopIds
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setShopIds($shopIds)
    {
        $this->_shopIds = $shopIds;
        return $this;
    }

    /**
     * @return array
     */
    public function getShopIds()
    {
        return $this->_shopIds;
    }

    /**
     * @param boolean $withImages
     * @return ZendX_Service_Affilinet_Criteria_Product
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
     * @param boolean $withDetails
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setWithDetails($withDetails)
    {
        $this->_withDetails = $withDetails;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getWithDetails()
    {
        return $this->_withDetails;
    }

    /**
     * @param string $imageSize
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setImageSize($imageSize)
    {
        $this->_imageSize = $imageSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageSize()
    {
        return $this->_imageSize;
    }

    /**
     * @param int $publisherId
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function setPublisherId($publisherId)
    {
        $this->_publisherId = $publisherId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPublisherId()
    {
        return $this->_publisherId;
    }

}