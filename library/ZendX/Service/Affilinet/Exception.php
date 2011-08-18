<?php

class ZendX_Service_Affilinet_Exception extends Zend_Service_Exception
{

    protected $_soapException;

    public function setSoapException($soapException)
    {
        $this->_soapException = $soapException;
        return $this;
    }

    public function getSoapException()
    {
        return $this->_soapException;
    }
}