<?php

class ZendX_Service_Affilinet_Item_Product extends ZendX_Service_Affilinet_Item_Abstract
{

    protected $_id;
    protected $_affilinetCategoryId;
    protected $_articleNumber;
    protected $_brand;
    protected $_categoryPath;
    protected $_currencySymbol;
    protected $_deepLink1;
    protected $_deepLink2;
    protected $_description;
    protected $_descriptionShort;
    protected $_displayPrice;
    protected $_displayShipping;
    protected $_distributor;
    protected $_EAN;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image120;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image180;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image30;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image60;

    /**
     * @var ZendX_Service_Affilinet_Item_Image
     */
    protected $_image90;
    protected $_keywords;
    protected $_manufacturer;
    protected $_merchantCategoryId;
    protected $_price;
    protected $_priceOld;
    protected $_pricePrefix;
    protected $_priceSuffix;
    protected $_rank;
    protected $_shipping;
    protected $_shippingPrefix;
    protected $_shippingSuffix;

    /**
     * @var ZendX_Service_Affilinet_Item_ShopInformation
     */
    protected $_shopInformation;
    protected $_title;
    
    public function __construct($options = array())
    {
        foreach (array(
            'Image' => 'ZendX_Service_Affilinet_Item_Image',
            'Image30' => 'ZendX_Service_Affilinet_Item_Image',
            'Image60' => 'ZendX_Service_Affilinet_Item_Image',
            'Image90' => 'ZendX_Service_Affilinet_Item_Image',
            'Image120' => 'ZendX_Service_Affilinet_Item_Image',
            'Image180' => 'ZendX_Service_Affilinet_Item_Image',
            'ShopInformation' => 'ZendX_Service_Affilinet_Item_ShopInformation'
        ) as $name => $class) {
            if (array_key_exists($name, $options)) {
                $options[$name] = new $class($options[$name]);
            }
        }
        parent::__construct($options);
    }
    
    public function setEAN($EAN)
    {
        $this->_EAN = $EAN;
        return $this;
    }

    public function getEAN()
    {
        return $this->_EAN;
    }

    public function setAffilinetCategoryId($affilinetCategoryId)
    {
        $this->_affilinetCategoryId = $affilinetCategoryId;
        return $this;
    }

    public function getAffilinetCategoryId()
    {
        return $this->_affilinetCategoryId;
    }

    public function setArticleNumber($articleNumber)
    {
        $this->_articleNumber = $articleNumber;
        return $this;
    }

    public function getArticleNumber()
    {
        return $this->_articleNumber;
    }

    public function setBrand($brand)
    {
        $this->_brand = $brand;
        return $this;
    }

    public function getBrand()
    {
        return $this->_brand;
    }

    public function setCategoryPath($categoryPath)
    {
        $this->_categoryPath = $categoryPath;
        return $this;
    }

    public function getCategoryPath()
    {
        return $this->_categoryPath;
    }

    public function setCurrencySymbol($currencySymbol)
    {
        $this->_currencySymbol = $currencySymbol;
        return $this;
    }

    public function getCurrencySymbol()
    {
        return $this->_currencySymbol;
    }

    public function setDeepLink1($deepLink1)
    {
        $this->_deepLink1 = $deepLink1;
        return $this;
    }

    public function getDeepLink1()
    {
        return $this->_deepLink1;
    }

    public function setDeepLink2($deepLink2)
    {
        $this->_deepLink2 = $deepLink2;
        return $this;
    }

    public function getDeepLink2()
    {
        return $this->_deepLink2;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescriptionShort($descriptionShort)
    {
        $this->_descriptionShort = $descriptionShort;
        return $this;
    }

    public function getDescriptionShort()
    {
        return $this->_descriptionShort;
    }

    public function setDisplayPrice($displayPrice)
    {
        $this->_displayPrice = $displayPrice;
        return $this;
    }

    public function getDisplayPrice()
    {
        return $this->_displayPrice;
    }

    public function setDisplayShipping($displayShipping)
    {
        $this->_displayShipping = $displayShipping;
        return $this;
    }

    public function getDisplayShipping()
    {
        return $this->_displayShipping;
    }

    public function setDistributor($distributor)
    {
        $this->_distributor = $distributor;
        return $this;
    }

    public function getDistributor()
    {
        return $this->_distributor;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setKeywords($keywords)
    {
        $this->_keywords = $keywords;
        return $this;
    }

    public function getKeywords()
    {
        return $this->_keywords;
    }

    public function setManufacturer($manufacturer)
    {
        $this->_manufacturer = $manufacturer;
        return $this;
    }

    public function getManufacturer()
    {
        return $this->_manufacturer;
    }

    public function setMerchantCategoryId($merchantCategoryId)
    {
        $this->_merchantCategoryId = $merchantCategoryId;
        return $this;
    }

    public function getMerchantCategoryId()
    {
        return $this->_merchantCategoryId;
    }

    public function setPrice($price)
    {
        $this->_price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->_price;
    }

    public function setPriceOld($priceOld)
    {
        $this->_priceOld = $priceOld;
        return $this;
    }

    public function getPriceOld()
    {
        return $this->_priceOld;
    }

    public function setPricePrefix($pricePrefix)
    {
        $this->_pricePrefix = $pricePrefix;
        return $this;
    }

    public function getPricePrefix()
    {
        return $this->_pricePrefix;
    }

    public function setPriceSuffix($priceSuffix)
    {
        $this->_priceSuffix = $priceSuffix;
        return $this;
    }

    public function getPriceSuffix()
    {
        return $this->_priceSuffix;
    }

    public function setRank($rank)
    {
        $this->_rank = $rank;
        return $this;
    }

    public function getRank()
    {
        return $this->_rank;
    }

    public function setShipping($shipping)
    {
        $this->_shipping = $shipping;
        return $this;
    }

    public function getShipping()
    {
        return $this->_shipping;
    }

    public function setShippingPrefix($shippingPrefix)
    {
        $this->_shippingPrefix = $shippingPrefix;
        return $this;
    }

    public function getShippingPrefix()
    {
        return $this->_shippingPrefix;
    }

    public function setShippingSuffix($shippingSuffix)
    {
        $this->_shippingSuffix = $shippingSuffix;
        return $this;
    }

    public function getShippingSuffix()
    {
        return $this->_shippingSuffix;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_ShopInformation $shopInformation
     * @return ZendX_Service_Affilinet_Item_Product
     */
    public function setShopInformation(ZendX_Service_Affilinet_Item_ShopInformation $shopInformation)
    {
        $this->_shopInformation = $shopInformation;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_ShopInformation
     */
    public function getShopInformation()
    {
        return $this->_shopInformation;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image
     * @return self
     */
    public function setImage($image)
    {
        $this->_image = $image;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image120
     * @return self
     */
    public function setImage120($image120)
    {
        $this->_image120 = $image120;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage120()
    {
        return $this->_image120;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image180
     * @return self
     */
    public function setImage180($image180)
    {
        $this->_image180 = $image180;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage180()
    {
        return $this->_image180;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image30
     * @return self
     */
    public function setImage30($image30)
    {
        $this->_image30 = $image30;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage30()
    {
        return $this->_image30;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image60
     * @return self
     */
    public function setImage60($image60)
    {
        $this->_image60 = $image60;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage60()
    {
        return $this->_image60;
    }

    /**
     * @param ZendX_Service_Affilinet_Item_Image $image90
     * @return self
     */
    public function setImage90($image90)
    {
        $this->_image90 = $image90;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Item_Image
     */
    public function getImage90()
    {
        return $this->_image90;
    }
}