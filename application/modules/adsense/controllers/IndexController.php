<?php
/**
 *
 */
class AdSense_IndexController extends Zend_Controller_Action
{
    /**
     * test adsense Action
     */
    public function testAction()
    {
        $options = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel = new AdSense_Model_Finder($options['adsense']);
        $oModel->getCriteria()->setPage($this->_getParam('page', 1));

        $list = $oModel->findProducts('phone');
        $this->view->list = print_r($list, true);

    } // function testAction

} // class AdSense_IndexController