<?php

class Affilinet_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $affilinet = new ZendX_Service_Affilinet_Products(array(
                'publisherId' => 403233,
                'username' => 'Users.1.2621',
                'password' => 'v39Gryshko',
                'isSandbox' => true
            ));
        $criteria = new ZendX_Service_Affilinet_Criteria_Product();
        $criteria->setQuery('jeans');

        $this->view->products = $affilinet
                ->getSearchProductsPaginator($criteria)
                ->setCurrentPageNumber($this->getRequest()->getParam('page', 1))
                ->setItemCountPerPage(10);
    }


}

