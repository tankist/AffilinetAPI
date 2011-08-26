<?php

class Shoppingcom_IndexController extends Zend_Controller_Action
{
    /**
     * test shoppingcom Action
     */
    public function testAction()
    {
        $aOptions  = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel    = new Shoppingcom_Model_Find($aOptions['shoppingCom']);
        $oCriteria = new Model_Criteria();
        $oCriteria->setPage($this->_getParam('page', 1));

        $aList = $oModel->findProducts('phone', $oCriteria);
        //$aList = $oModel->findProductsByCategory(419, $nPage);
        $this->view->list = $aList;

    }

}