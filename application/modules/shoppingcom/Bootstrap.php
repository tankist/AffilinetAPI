<?php

class Shoppingcom_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initShoppingcomRoutes()
    {
        $this->bootstrap('frontController');

        /**
         * @var Zend_Controller_Router_Rewrite $router
         */
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $router->addRoute('shoppingcom',
                new Zend_Controller_Router_Route('shoppingcom/test/:page',
                    array(
                        'controller' => 'index',
                        'action'     => 'test',
                        'module'     => 'shoppingcom',
                        'page'       => 1
                    )
                )
        );
    }

}