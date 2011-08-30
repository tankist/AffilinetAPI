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
     * @var Zend_Soap_Client
     */
    protected $_client = null;

    /**
     * @var string
     */
    protected $_locale = null;

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

        $this->_wsdl   = $this->_options['AccountWSDL'];
        $this->_client = $this->getClient();
        $this->_client->setSoapVersion(SOAP_1_1);

        $this->_setHeader();

        try {
            $oAcc = $this->_client->createAccount(array(
                '' => '',
            ));
        } catch (SoapFault $oFault) {
            $oAcc = $oFault;
        }
/*
        try {
            $oAcc = $this->_client->associateAccount(array(
                'loginEmail'   => 'mschulze@runashop.com',
                'postalCode'   => '10115',
                'phone'        => '39853',
                'developerUrl' => 'http://www.runashop.com/'
            ));
        } catch (SoapFault $oFault) {
            $oAcc = $oFault;
        }
 */
$sRequest  = $this->_client->getLastRequest();
$sResponse = $this->_client->getLastResponse();
file_put_contents(APPLICATION_PATH . '/../temp/soap_request.xml',  $sRequest);
file_put_contents(APPLICATION_PATH . '/../temp/soap_response.xml', $sResponse);

return $oAcc;

        return $this->getData();
    } // function findProducts

    /**
     * Set Locale value
     * @param string $sLocale
     */
    public function setLocale($sLocale)
    {
        $this->_locale = $sLocale;
    } // function setLocale

    /**
     * Set SOAP Headers
     * @param boolean $bSetClient
     * @param boolean $bSetLocale
     */
    protected function _setHeader($bSetClient = false, $bSetLocale = true)
    {
        $sNS = $this->_options['namespace'];
        $aHV = $this->_options['header'];
        $this->_client->addSoapInputHeader(new SoapHeader(
                $sNS,
                'developer_email',
                $aHV['developer_email']
        ));
        $this->_client->addSoapInputHeader(new SoapHeader(
                $sNS,
                'developer_password',
                $aHV['developer_password']
        ));

        if ($bSetClient) {
            $this->_client->addSoapInputHeader(new SoapHeader(
                    $sNS,
                    'client_id',
                    $aHV['client_id']
            ));
        }

        if ($bSetLocale) {
            $this->_client->addSoapInputHeader(new SoapHeader(
                    $sNS,
                    'display_locale',
                    empty($this->_locale) ? $aHV['display_locale'] : $this->_locale
            ));
        }

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
