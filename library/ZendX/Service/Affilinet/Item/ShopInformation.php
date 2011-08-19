<?php

class ZendX_Service_Affilinet_Item_ShopInformation extends ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_logo120;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_logo150;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_logo468;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_logo50;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_logo90;

    /**
     * @var int
     */
    protected $_programId;

    /**
     * @var int
     */
    protected $_shopId;

    /**
     * @var string
     */
    protected $_shopListName;

    /**
     * @var string
     */
    protected $_shopName;

    /**
     * @var string
     */
    protected $_shopUrl;

    public function __construct($options = array())
    {
        foreach (array(
            'logo50' => 'ZendX_Service_Affilinet_Item_Image',
            'logo90' => 'ZendX_Service_Affilinet_Item_Image',
            'logo120' => 'ZendX_Service_Affilinet_Item_Image',
            'logo150' => 'ZendX_Service_Affilinet_Item_Image',
            'logo468' => 'ZendX_Service_Affilinet_Item_Image'
        ) as $name => $class) {
            if (array_key_exists($name, $options)) {
                $options[$name] = new $class($options[$name]);
            }
        }
        parent::__construct($options);
    }


    /**
     * @param ZendX_Service_Affilinet_Item_Image $logo120
     * @return self
     */
    public function setLogo120($logo120)
    {
        $this->_logo120 = $logo120;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getLogo120()
    {
        return $this->_logo120;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $logo150
     * @return self
     */
    public function setLogo150($logo150)
    {
        $this->_logo150 = $logo150;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getLogo150()
    {
        return $this->_logo150;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $logo468
     * @return self
     */
    public function setLogo468($logo468)
    {
        $this->_logo468 = $logo468;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getLogo468()
    {
        return $this->_logo468;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $logo50
     * @return self
     */
    public function setLogo50($logo50)
    {
        $this->_logo50 = $logo50;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getLogo50()
    {
        return $this->_logo50;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $logo90
     * @return self
     */
    public function setLogo90($logo90)
    {
        $this->_logo90 = $logo90;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getLogo90()
    {
        return $this->_logo90;
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
     * @param string $shopListName
     * @return self
     */
    public function setShopListName($shopListName)
    {
        $this->_shopListName = $shopListName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopListName()
    {
        return $this->_shopListName;
    }

    /**
     * @param string $shopName
     * @return self
     */
    public function setShopName($shopName)
    {
        $this->_shopName = $shopName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopName()
    {
        return $this->_shopName;
    }

    /**
     * @param string $shopUrl
     * @return self
     */
    public function setShopUrl($shopUrl)
    {
        $this->_shopUrl = $shopUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopUrl()
    {
        return $this->_shopUrl;
    }
}