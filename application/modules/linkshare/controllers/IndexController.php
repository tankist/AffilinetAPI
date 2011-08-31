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
        $aOptions  = $this->getInvokeArg('bootstrap')->getOptions();

        $oModel    = new Linkshare_Model_Finder($aOptions['linkshare']);
        $oCriteria = $oModel->getCriteria();
        $oCriteria->setCategories(array(419));
        //$oCriteria->setPage($this->_getParam('page', 1));

        //$this->view->list = $oModel->findProducts('');
        $this->view->list = $oModel->findProducts('phone');
    } // function testAction

} // class Linkshare_IndexController