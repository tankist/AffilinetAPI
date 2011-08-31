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
        $oCriteria = $oModel->getCriteria();
        $oCriteria->setCategories(array(6001));
        //$oCriteria->setPage($this->_getParam('page', 1));

        $this->view->list = $oModel->findProducts('');
        //$this->view->list = $oModel->findProducts('phone');

    }
}