<?php

class Shoppingcom_IndexController extends Zend_Controller_Action
{
    /**
     * test shoppingcom Action
     */
    public function testAction()
    {
        $aOptions  = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel    = new Shoppingcom_Model_Finder($aOptions['shoppingCom']);
        $oModel->getCriteria()->setPage($this->_getParam('page', 1));

        $aList = $oModel->findProducts('phone');
        //$aList = $oModel->findProductsByCategory(419);
        $this->view->list = $aList;
        //$this->view->debug = $aList;

    }

}