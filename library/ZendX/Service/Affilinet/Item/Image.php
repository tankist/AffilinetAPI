<?php

class ZendX_Service_Affilinet_Item_Image extends ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var int
     */
    protected $_height;

    /**
     * @var int
     */
    protected $_width;

    /**
     * @var string
     */
    protected $_imageURL;

    /**
     * @param $height
     * @return self
     */
    public function setHeight($height)
    {
        $this->_height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @param $imageURL
     * @return self
     */
    public function setImageURL($imageURL)
    {
        $this->_imageURL = $imageURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageURL()
    {
        return $this->_imageURL;
    }

    /**
     * @param $width
     * @return self
     */
    public function setWidth($width)
    {
        $this->_width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->_width;
    }

}