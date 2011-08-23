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
        if ($response && isset($response->Shops) && $response->Records > 0) {
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
        if ($response && isset($response->CategoryResult) && $response->CategoryResult->Records > 0) {
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
        if ($response && isset($response->CategoryResult) && $response->CategoryResult->Records > 0) {
            $categories = $response->CategoryResult->Categories->Category;
            if (is_object($categories)) {
                $categories = array($categories);
            }
        }
        return new ZendX_Service_Affilinet_Collection_Categories($categories);
    }

    public function searchProducts(ZendX_Service_Affilinet_Criteria_Product $criteria)
    {
        $products = array();
        $criteriaArray = $criteria->toArray();
        if (array_key_exists('CategoryIds', $criteriaArray)) {
            $response = $this->_request('SearchProductsInCategories', array(
                'SearchProductsInCategoriesRequestMessage' => $criteriaArray
            ));
            if ($response && isset($response->ProductSearchResult->Products) && $response->ProductSearchResult->Records > 0) {
                $products = $response->ProductSearchResult->Products->Product;
            }
        }
        elseif (array_key_exists('CategoryId', $criteriaArray)) {
            $response = $this->_request('SearchProductsInCategory', array(
                'SearchProductsInCategoryRequestMessage' => $criteriaArray
            ));
            if ($response && isset($response->ProductSearchResult->Products) && $response->ProductSearchResult->Records > 0) {
                $products = $response->ProductSearchResult->Products->Product;
            }
        }
        else {
            $response = $this->_request('SearchProducts', array(
                'SearchProductsRequestMessage' => $criteriaArray
            ));
            if ($response && isset($response->Products) && $response->Records > 0) {
                $products = $response->Products->Product;
            }
        }
        if (is_object($products)) {
            $products = array($products);
        }
        return new ZendX_Service_Affilinet_Collection_Products($products);
    }

    public function searchProductsCount(ZendX_Service_Affilinet_Criteria_Product $criteria)
    {
        /**
         * @var ZendX_Service_Affilinet_Criteria_Product $countCriteria
         */
        $countCriteria = clone $criteria;
        $countCriteria->setCurrentPage(1)->setPageSize(10);
        $response = $this->_request('SearchProducts', array(
            'SearchProductsRequestMessage' => $countCriteria->toArray()
        ));
        if ($response && isset($response->TotalRecords)) {
            return (int)$response->TotalRecords;
        }
        return 0;
    }

    public function getSearchProductsPaginator(ZendX_Service_Affilinet_Criteria_Product $criteria)
    {
        return new Zend_Paginator(new ZendX_Service_Affilinet_Paginator_Adapter_Products($this, $criteria));
    }

    public function getProductById($product_id)
    {
        
    }

}