<?php

abstract class Model_Finder_Rest extends Model_Finder_Abstract
{

    /**
     * Rest Client
     * @var Zend_Rest_Client
     */
    protected $_client;


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

}