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
        $oCriteria = $oModel->getCriteria();
        //$oCriteria->setCategories(array(6001));
        //$oCriteria->setPage($this->_getParam('page', 1));

        //$this->view->list = $oModel->findProducts('');
        //$this->view->list = $oModel->findProducts('phone');
        //$this->view->debug = $oModel->findProducts('phone');
        $this->view->show = (string)$oModel->findProducts('phone')->return;
    } // function testAction

} // class AdSense_IndexController