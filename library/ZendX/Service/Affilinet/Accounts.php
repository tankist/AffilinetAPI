<?php

class ZendX_Service_Affilinet_Accounts extends ZendX_Service_Affilinet_Abstract
{

    const TYPE = 'Publisher';

    /**
     * @var string
     */
    protected $_wsdlPath = 'AccountService.svc?wsdl';

    protected $_serviceType = self::TYPE;

    public function getPublisherDetails()
    {
        $response = $this->_request('GetPublisherSummary');
    }

    public function getLinkedAccounts()
    {
        $accounts = array();
        $response = $this->_request('GetLinkedAccounts');
        if ($response && isset($response->LinkedAccountCollection)) {
            $accounts = $response->LinkedAccountCollection;
            if (is_object($accounts)) {
                $accounts = array($accounts);
            }
        }
        return new ZendX_Service_Affilinet_Collection_Accounts($accounts);
    }

}
