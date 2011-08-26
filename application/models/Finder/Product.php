<?php
/*
 * Shop Product class.
 *
 * For set main property use:
 *     $prod->setTitle($title)
 *
 * For set extra property use only:
 *     $prod->setAttribs(array('some_ptop' =>$some_val));
 *
 * For get any property use:
 *     $prod->propertyName;
 * If you want to define default value for main property use:
 *     $prod->get_propertyName($mDefaultValue);
 *
 */
abstract class Model_Finder_Product
{

    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_title = '';

    /**
     * @var string
     */
    protected $_description = '';

    /**
     * @var string
     */
    protected $_url = '';

    /**
     * @var float
     */
    protected $_price = 0;

    /**
     * @var float
     */
    protected $_shippingPrice = 0;

    /**
     * @var
     */
    protected $_currency;

    /**
     * @var array
     */
    protected $_images = array();

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
     * @param string $currency
     * @return Model_Finder_Product
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param string $description
     * @return Model_Finder_Product
     */
    public function setDescription($description)
    {
        $this->_description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param int $id
     * @return Model_Finder_Product
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param array $images
     * @return Model_Finder_Product
     */
    public function setImages($images)
    {
        $this->_images = (array)$images;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->_images;
    }

    /**
     * @param $image
     * @return Model_Finder_Product
     */
    public function addImage($image)
    {
        $this->_images[] = $image;
        return $this;
    }

    /**
     * @param float $price
     * @return Model_Finder_Product
     */
    public function setPrice($price)
    {
        $this->_price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param float $shippingPrice
     * @return Model_Finder_Product
     */
    public function setShippingPrice($shippingPrice)
    {
        $this->_shippingPrice = $shippingPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingPrice()
    {
        return $this->_shippingPrice;
    }

    /**
     * @param string $title
     * @return Model_Finder_Product
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

    /**
     * @param string $url
     * @return Model_Finder_Product
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
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

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getAttrib($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return Model_Finder_Product
     */
    function __set($name, $value)
    {
        return $this->setAttrib($name, $value);
    }


}