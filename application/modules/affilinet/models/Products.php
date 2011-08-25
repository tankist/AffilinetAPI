<?php

class Affilinet_Model_Products extends Model_FindShopProduct
{

    /**
     * @var ZendX_Service_Affilinet_Products
     */
    protected $_affilinetService;

    function __construct($options = array())
    {
        if (!array_key_exists('username', $options)) {
            throw new Model_Exception('Username is required to logon to affili.net');
        }
        if (!array_key_exists('password', $options)) {
            throw new Model_Exception('Password is required to logon to affili.net');
        }
        parent::__construct($options);
        $this->_affilinetService = new ZendX_Service_Affilinet_Products($options);
    }

    /**
     * @param string $sKeyword
     * @param array $aOptions
     * @return array
     */
    public function findProductsByKeywords($sKeyword, $aOptions = array())
    {
        $criteria = new ZendX_Service_Affilinet_Criteria_Product();
        $criteria->setQuery($sKeyword);

        foreach ($aOptions as $name => $value) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($criteria, $setter)) {
                call_user_func(array($criteria, $setter), $value);
            }
        }

        $products = $this->_affilinetService->searchProducts($criteria);

        $shopProducts = array();
        foreach ($products as /** @var ZendX_Service_Affilinet_Item_Product $product */$product) {
            $shopProducts[] = Affilinet_Model_Product::convertAffilinetProduct($product);
        }

        return $shopProducts;
    }

    public function getFindProductsPaginator($sKeyword, $aOptions = array())
    {
        $criteria = new ZendX_Service_Affilinet_Criteria_Product();
        $criteria->setQuery($sKeyword);

        foreach ($aOptions as $name => $value) {
            $setter = 'set' . ucfirst($name);
            if (method_exists($criteria, $setter)) {
                call_user_func(array($criteria, $setter), $value);
            }
        }

        return $this->_affilinetService->getSearchProductsPaginator($criteria);
    }

}