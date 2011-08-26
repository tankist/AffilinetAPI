<?php

class Ebay_IndexController extends Zend_Controller_Action
{
    /**
     * test ebay Action
     */
    public function testAction()
    {
        $aOptions  = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel    = new Ebay_Model_Finder($aOptions['ebay']);
        $oCriteria = new Model_Criteria();
        $oCriteria->setPage($this->_getParam('page', 1));
        //$oModel->getCriteria()->setPage($this->_getParam('page', 1));

        $this->view->list = $oModel->findProducts('phone', $oCriteria);
        //$this->view->list = print_r($oModel->findItemsAdvanced('phone'), true);
        //$this->view->list = print_r($oModel->findProductsByCategory(6001), true);
        //$this->view->list = print_r($oModel->findProductsInEbayStores('phone'), true);
        //$this->view->list = print_r($oModel->getProductById(99978429), true);

    }
}