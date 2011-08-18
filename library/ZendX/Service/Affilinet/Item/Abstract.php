<?php

class ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var array
     */
    protected $_attribs = array();

    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    public function setOptions($options = array())
    {
        foreach ($options as $name => $option) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($this, $setter)) {
                call_user_func(array($this, $setter), $option);
            }
            else {
                $this->setAttrib($name, $option);
            }
        }
        return $this;
    }

    public function setAttribs(array $attribs)
    {
        $this->_attribs = $attribs;
        return $this;
    }

    public function getAttribs()
    {
        return $this->_attribs;
    }

    public function setAttrib($name, $value)
    {
        $this->_attribs[$name] = $value;
        return $this;
    }

    public function getAttrib($name)
    {
        if (!array_key_exists($name, $this->_attribs)) {
            return false;
        }
        return $this->_attribs[$name];
    }

    public function removeAttrib($name)
    {
        if (array_key_exists($name, $this->_attribs)) {
            unset($this->_attribs[$name]);
        }
        return $this;
    }

}