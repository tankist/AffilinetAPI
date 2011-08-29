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
file_put_contents('E:/temp/soap_request.xml',  $sRequest);
file_put_contents('E:/temp/soap_response.xml', $sResponse);

return $oAcc;

        return $this->getData();
    } // function findProducts

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