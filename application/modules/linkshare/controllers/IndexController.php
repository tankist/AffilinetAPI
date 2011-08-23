<?php
/**
 *
 */
class Linkshare_IndexController extends Zend_Controller_Action
{
    /**
     * test linkshare Action
     */
    public function testAction()
    {
        $options = $this->getInvokeArg('bootstrap')->getOptions();

        $nPage = $this->_getParam('page');

        $oModel = new Linkshare_Model_Find($options['linkshare']);

        $list = $oModel->findProductsByKeywords('phone', $nPage);
        $this->view->list = print_r($list, true);

    } // function testAction

} // class Linkshare_IndexController