<?php

class Ebay_IndexController extends Zend_Controller_Action
{
    /**
     * test ebay Action
     */
    public function testAction()
    {
        $options = $this->getInvokeArg('bootstrap')->getOptions();

        $nPage = $this->_getParam('page');

//echo '<pre>'; print_r($options); echo '</pre>';

        $oModel = new Ebay_Model_Find($options['ebay']);
        $oModel->setMinPriceFilter(10);

        $this->view->list = print_r($oModel->findProductsByKeywords('phone', $nPage), true);
        //$this->view->list = print_r($oModel->findItemsAdvanced('phone'), true);
        //$this->view->list = print_r($oModel->findProductsByCategory(6001), true);
        //$this->view->list = print_r($oModel->findProductsInEbayStores('phone'), true);
        //$this->view->list = print_r($oModel->findProductById(99978429), true);

    }
}