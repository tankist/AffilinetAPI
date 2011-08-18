<?php

class ZendX_Service_Affilinet_Products extends ZendX_Service_Affilinet_Abstract
{

    const TYPE = 'Product';

    /**
     * @var string
     */
    protected $_wsdlPath = 'ProductServices.svc?wsdl';

    protected $_serviceType = self::TYPE;

    public function getShops()
    {
        $shops = array();
        $response = $this->_request('GetShopList');
        if ($response && $response->Records > 0) {
            $shops = $response->Shops->Shop;
        }
        return new ZendX_Service_Affilinet_Collection_Shops($shops);
    }

}