<?php

class Shoppingcom_IndexController extends Zend_Controller_Action
{
    /**
     * test shoppingcom Action
     */
    public function testAction()
    {
        $options = $this->getInvokeArg('bootstrap')->getOptions();

        $nPage = $this->_getParam('page');

        $oModel = new Shoppingcom_Model_Find($options['shoppingCom']);

        $list = $oModel->findProducts('phone', $nPage);
        $this->view->list = print_r($list, true);

    }

}