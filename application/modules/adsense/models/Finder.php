<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of findAdSense
 *
 * @author Alex
 */
class AdSense_Model_Finder extends Model_Finder_Soap
{

    /**
     * @param array $options
     */
    public function __construct($options = array()) {
        parent::__construct($options);
    }

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param Model_Criteria|null $criteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $oCriteria = null)
    {
        if (!$oCriteria) {
            $oCriteria = $this->getCriteria();
        }

        $aOptions = $this->_getOptions($oCriteria);

        $this->_wsdl = $this->_options['AccountWSDL'];
        $oSoap = $this->getClient();

        $oSoap->setOptions(array(
            'trace'      => 1,
            'exceptions' => true,
            'features'   => SOAP_WAIT_ONE_WAY_CALLS,
            //'features'   => 0,
        ));
        $this->_setHeader($oSoap);

        try {
            $oAcc  = $oSoap->associateAccount(array(
                'loginEmail'   => 'mschulze@runashop.com',
                'postalCode'   => '10115',
                'phone'        => '39853',
                'developerUrl' => 'http://www.runashop.com/'
            ));
        } catch (SoapFault $oFault) {
            echo '!!!!!!!!!!!!!';
            $oAcc = $oFault;
        }
$sRequest  = $oSoap->getLastRequest();
$sResponse = $oSoap->getLastResponse();
file_put_contents(APPLICATION_PATH . '/../temp/soap_request.xml',  $sRequest);
file_put_contents(APPLICATION_PATH . '/../temp/soap_response.xml', $sResponse);

return $oAcc;

        return $this->getData();
    } // function findProducts

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param Model_Criteria|null $criteria
     * @return array
     */
    public function findProducts1($sKeyword, Model_Criteria $oCriteria = null)
    {
        if (!$oCriteria) {
            $oCriteria = $this->getCriteria();
        }

        $aOptions = $this->_getOptions($oCriteria);

        $aSoapOpt = array(
            'trace'      => 1,
            'exceptions' => false,
            'features'   => SOAP_WAIT_ONE_WAY_CALLS,
            //'features'   => 0,
        );
        $oClient = new testSoapClient($this->_options['AccountWSDL'], $aSoapOpt);

        $oClient->__setSoapHeaders(array(
            new SoapHeader(
                'http://www.google.com/api/adsense/v3',
                'developer_email',
                'mschulze@runashop.com'
            ),
            new SoapHeader(
                'http://www.google.com/api/adsense/v3',
                'developer_password',
                'dizzie'
            ),
        ));
        try {
            $oAcc = $oClient->associateAccount(array(
                'loginEmail'   => 'mschulze@runashop.com',
                'postalCode'   => '10115',
                'phone'        => '39853',
                'developerUrl' => 'http://www.runashop.com/'
            ));
        } catch (SoapFault $oFault) {
            echo '!!!!!!!!!!!!!';
            $oAcc = $oFault;
        }
$sRequest  = $oClient->__getLastRequest();
$sResponse = $oClient->__getLastResponse();
file_put_contents(APPLICATION_PATH . '/../temp/soap_request.xml',  $sRequest);
file_put_contents(APPLICATION_PATH . '/../temp/soap_response.xml', $sResponse);

return $oAcc;
    } // function findProducts1

    /**
     * @param string $sOperation
     * @param int $nPage
     * @param array $aOptions
     * @return DOMDocument
     */
    protected function _setHeader(Zend_Soap_Client $oSoap)
    {
        $oSoap->addSoapInputHeader(new SoapHeader(
                $this->_options['headerNamespace'],
                'developer_email',
                $this->_options['developer_email']
        ));
        $oSoap->addSoapInputHeader(new SoapHeader(
                $this->_options['headerNamespace'],
                'developer_password',
                $this->_options['developer_password']
        ));

    }

    /**
     * @param string $sOperation
     * @param int $nPage
     * @param array $aOptions
     * @return DOMDocument
     */
    protected function _findItems($sOperation, $nPage, array $aOptions)
    {
        if (!isset($aOptions['numItems'])) {
            $aOptions['numItems'] = $this->_options['item_qtt'];
        }
        if (!isset($aOptions['pageNumber'])) {
            $aOptions['pageNumber'] = $nPage;
        }

        // do request
        $oDom = $this->_request($sOperation, $aOptions);
        return $oDom;
    }

    /**
     * @param Model_Criteria $modelCriteria
     * @return array
     */
    protected function _getOptions($oCriteria)
    {
        $aOptions = array();
        if (is_null($oCriteria)) {
            $oCriteria = $this->getCriteria();
        }
        // @todo Add modify options code here
        return $aOptions;
    }

}
