<?php

class Ebay_IndexController extends Zend_Controller_Action
{

    /**
     * Отображает главную страницу
     */
    public function indexAction()
    {
        $this->view->content = '<h1>ZEND FRAMEWORK ISN\'T LIKED FOR ME!</h1>';
    }

    /**
     * Страница из меню
     */
    public function testebayAction()
    {

        $nPage = $this->_getParam('page');

        $oModel = new Ebay_Model_FindEbay();

        $oModel->setMinPriceFilter(10);

        $this->view->list = print_r($oModel->findProductsByKeywords('phone', $nPage), true);
        //$this->view->list = print_r($oModel->findItemsAdvanced('phone'), true);
        //$this->view->list = print_r($oModel->findProductsByCategory(6001), true);
        //$this->view->list = print_r($oModel->findProductsInEbayStores('phone'), true);
        //$this->view->list = print_r($oModel->findProductById(99978429), true);

    }

    /**
     * Страница из меню
     */
    public function testshoppingcomAction()
    {

        $nPage = $this->_getParam('page');

        $oModel = new findShoppingCom();
        $list = $oModel->findProductsByKeywords('phone', $nPage);
        $this->view->list = print_r($list, true);

    }

}