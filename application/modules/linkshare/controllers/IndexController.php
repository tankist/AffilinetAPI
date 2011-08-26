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

        $oModel    = new Linkshare_Model_Find($aOptions['linkshare']);
        $oCriteria = new Model_Criteria();
        $oCriteria->setPage($this->_getParam('page', 1));

        $aList = $oModel->findProducts('phone', $oCriteria);
        //$aList = $oModel->findProductsByCategory(419, $nPage);
        $this->view->list = print_r($aList, true);

    } // function testAction

} // class Linkshare_IndexController