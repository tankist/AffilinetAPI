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
        $oCriteria = $oModel->getCriteria();
        $oCriteria->setCategories(array(419));
        //$oCriteria->setPage($this->_getParam('page', 1));

        $aList = $oModel->findProducts('');
        //$aList = $oModel->findProducts('phone');
        $this->view->list = $aList;
    }

}