<?php

class Affilinet_ProductsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $affilinetModel = new Affilinet_Model_Products(array(
                'publisherId' => 403233,
                'username' => 'Users.1.2621',
                'password' => 'v39Gryshko',
                'isSandbox' => true
            ));
        $this->view->products = $affilinetModel->findProductsByKeywords('jeans', 1);
    }


}

