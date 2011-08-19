<?php

require_once 'ZendX/Service/Affilinet/Abstract.php';

class ZendX_Service_Affilinet_Products extends ZendX_Service_Affilinet_Abstract
{

    const TYPE = 'Product';

    /**
     * @var string
     */
    protected $_wsdlPath = 'ProductServices.svc?wsdl';

    protected $_serviceType = self::TYPE;

    /**
     * @return ZendX_Service_Affilinet_Collection_Shops
     */
    public function getShops()
    {
        $shops = array();
        $response = $this->_request('GetShopList');
        if ($response && $response->Records > 0) {
            $shops = $response->Shops->Shop;
            if (is_object($shops)) {
                $shops = array($shops);
            }
        }
        return new ZendX_Service_Affilinet_Collection_Shops($shops);
    }

    /**
     * @param int $shop_id
     * @return ZendX_Service_Affilinet_Collection_Categories
     */
    public function getCategories($shop_id)
    {
        $categories = array();
        $response = $this->_request('GetCategoryList', array(
            'GetCategoryListRequestMessage' => array(
                'ShopId' => $shop_id
            )
        ));
        if ($response && $response->CategoryResult->Records > 0) {
            $categories = $response->CategoryResult->Categories->Category;
            if (is_object($categories)) {
                $categories = array($categories);
            }
        }
        return new ZendX_Service_Affilinet_Collection_Categories($categories);
    }

    /**
     * @param int $category_id
     * @param int $shop_id
     * @return ZendX_Service_Affilinet_Collection_Categories
     */
    public function getCategoryPath($category_id, $shop_id)
    {
        $categories = array();
        $response = $this->_request('GetCategoryPath', array(
            'GetCategoryPathRequestMessage' => array(
                'CategoryId' => $category_id,
                'ShopId' => $shop_id
            )
        ));
        if ($response && $response->CategoryResult->Records > 0) {
            $categories = $response->CategoryResult->Categories->Category;
            if (is_object($categories)) {
                $categories = array($categories);
            }
        }
        return new ZendX_Service_Affilinet_Collection_Categories($categories);
    }

}