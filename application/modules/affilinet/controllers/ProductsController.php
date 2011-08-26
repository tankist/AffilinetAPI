<?php

class Affilinet_ProductsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $affilinetModel = new Affilinet_Model_Finder(array(
                'publisherId' => 403233,
                'username' => 'Users.1.2621',
                'password' => 'v39Gryshko',
                'isSandbox' => true
            ));

        $criteria = new Model_Criteria();
        $criteria
            ->setSortBy(ZendX_Service_Affilinet_Criteria_Product::SORT_PRICE)
            ->setSortOrder(ZendX_Service_Affilinet_Criteria_Product::SORT_TYPE_ASCENDING);

        $this->view->products = $affilinetModel->findProducts('jeans', $criteria);
    }

}