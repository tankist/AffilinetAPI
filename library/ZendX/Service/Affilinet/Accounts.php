<?php

class ZendX_Service_Affilinet_Accounts extends ZendX_Service_Affilinet_Abstract
{

    const TYPE = 'Publisher';

    /**
     * @var string
     */
    protected $_wsdlPath = 'AccountServices.svc?wsdl';

    protected $_serviceType = self::TYPE;

}
