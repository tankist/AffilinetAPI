<?php

abstract class Model_Finder_Soap extends Model_Finder_Abstract
{

    /**
     * @var Zend_Soap_Client
     */
    protected $_client;

    /**
     * @var string
     */
    protected $_wsdl = '';

    /**
     * @param Zend_Soap_Client $client
     * @return self
     */
    public function setClient($client)
    {
        $this->_client = $client;
        return $this;
    }

    /**
     * @return \Zend_Soap_Client
     */
    public function getClient()
    {
        if (!$this->_client) {
            $soapOptions = (array_key_exists('soapOptions', $this->_options))?$this->_options['soapOptions']:array();
            $this->_client = new Zend_Soap_Client($this->_wsdl, $soapOptions);
        }
        return $this->_client;
    }

    protected function _request($operation, $options = array())
    {
        $response = call_user_func(array($this->_client, $operation), $options);
        return $this->_parseResponse($response);
    }

    protected function _parseResponse($response)
    {
        return $response;
    }

}