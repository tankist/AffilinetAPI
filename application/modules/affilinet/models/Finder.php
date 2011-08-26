<?php

class Affilinet_Model_Finder extends Model_Finder_Abstract
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
     * @param Model_Criteria $modelCriteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $modelCriteria = null)
    {
        if (!$modelCriteria) {
            $modelCriteria = $this->getCriteria();
        }
        $criteria = $this->_modifyOptions($modelCriteria);
        $criteria->setQuery($sKeyword);

        $products = $this->_affilinetService->searchProducts($criteria);

        $shopProducts = array();
        foreach ($products as /** @var ZendX_Service_Affilinet_Item_Product $product */$product) {
            $shopProducts[] = Affilinet_Model_Product::convertAffilinetProduct($product);
        }

        return $shopProducts;
    }

    /**
     * @param Model_Criteria $modelCriteria
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    protected function _modifyOptions(Model_Criteria $modelCriteria)
    {
        $criteria = new ZendX_Service_Affilinet_Criteria_Product();

        foreach (array(
            'getMinPrice' => 'setMinPrice',
            'getMaxPrice' => 'setMaxPrice',
            'getWithImages' => 'setWithImages',
            'getPage' => 'setCurrentPage',
            'getItemsPerPage' => 'setPageSize',
            'getSortBy' => 'setSortBy',
            'getSortOrder' => 'setSortOrder'
        ) as $getter => $setter) {
            if (method_exists($modelCriteria, $getter) && method_exists($criteria, $setter)) {
                call_user_func(array($criteria, $setter), call_user_func(array($modelCriteria, $getter)));
            }
        }

        if ($categories = $modelCriteria->getCategories()) {
            foreach ($categories as $category_id) {
                if (is_int($category_id)) {
                    $category = new ZendX_Service_Affilinet_Item_Category();
                    $category->setCategoryId($category_id);
                    $criteria->addCategory($category);
                }
            }
        }

        return $criteria;
    }

}