<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * abstract class for findShopProduct
 *
 * @author Alex
 */
abstract class Model_FindShopProduct
{
    /**
     * Current config
     * @var array
     */
    protected $_options;

    /**
     * Rest Client
     * @var Zend_Rest_Client
     */
    protected $_client;

    /**
     * Sourse data of Request result
     * @var array
     */
    protected $_sourceData = array();

    /**
     * Adjusted data of products
     * @var array
     */
    protected $_data = array();

    /**
     * @param array $options
     */
    function __construct($options = array()) {
        $this->_options = $options;
    }

    /**
     * @abstract
     * @param string $sKeyword
     * @param Model_Criteria $criteria
     * @return void
     */
    abstract public function findProducts($sKeyword, Model_Criteria $criteria);

    /**
     * Get Source Data
     * @return array
     */
    public function getSourseData()
    {
        return $this->_sourceData;
    } // function getSourseData

    /**
     * Get Adjusted data
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Get Config data
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @return Zend_Rest_Client
     */
    public function getClient()
    {
        if (!$this->_client instanceof Zend_Rest_Client) {
            require_once 'Zend/Rest/Client.php';
            $this->_client = new Zend_Rest_Client();
        }
        return $this->_client;
    }


    /**
     * @param  array  $aOptions
     * @param  string $sOperation
     * @return DOMDocument
     */
    protected function _requestRest($sOperation, array $aOptions)
    {
        // do request
        $oClient   = $this->_getRestClient();
        $oClient->getHttpClient()->resetParameters();
        $oResponse = $oClient->setUri($this->_options['URL'])
                            ->restGet($this->_options['path'][$sOperation], $aOptions);

        return $this->_parseRestResponse($oResponse);
    }

    /**
     * Get Rest Client
     * @return Zend_Rest_Client
     */
    protected function _getRestClient()
    {
        if (!$this->_client instanceof Zend_Rest_Client) {
            require_once 'Zend/Rest/Client.php';
            $this->_client = new Zend_Rest_Client();
        }
        return $this->_client;
    }

    /**
     * Search for error from request.
     *
     * If any error is found a DOMDocument is returned, this object contains a
     * DOMXPath object as "ebayFindingXPath" attribute.
     *
     * @param  Zend_Http_Response $oResponse
     * @return DOMDocument
     */
    protected function _parseRestResponse(Zend_Http_Response $oResponse)
    {
        // error message
        $message = '';

        // first trying, loading XML
        $oDom = new DOMDocument();
        if (!@$oDom->loadXML($oResponse->getBody())) {
            $message = 'It was not possible to load XML returned.';
        }

        // second trying, check request status
        if ($oResponse->isError()) {
            $message = $oResponse->getMessage()
                     . ' (HTTP status code #' . $oResponse->getStatus() . ')';
        }

        // throw exception when an error was detected
        if (strlen($message) > 0) {
            // ToDo: throw Exception there
        }

        return $oDom;
    }

} // class findShoppingCom
?>