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

        $nPage = $this->_getParam('page');

        $oModel = new AdSense_Model_Finder($options['adsense']);

        $list = $oModel->findProducts('phone', $nPage);
        $this->view->list = print_r($list, true);

    } // function testAction

} // class AdSense_IndexController