<?php

class Ebay_IndexController extends Zend_Controller_Action
{
    /**
     * test ebay Action
     */
    public function testAction()
    {
        $options = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel = new Ebay_Model_Find($options['ebay']);
        $criteria = new Model_Criteria();
        $criteria->setPage($this->_getParam('page', 1));

        $this->view->list = $oModel->findProducts('phone', $criteria);
        //$this->view->list = print_r($oModel->findItemsAdvanced('phone'), true);
        //$this->view->list = print_r($oModel->findProductsByCategory(6001), true);
        //$this->view->list = print_r($oModel->findProductsInEbayStores('phone'), true);
        //$this->view->list = print_r($oModel->getProductById(99978429), true);

    }
}