<?php

class Ebay_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initEbayRoutes()
    {
        $this->bootstrap('frontController');

        /**
         * @var Zend_Controller_Router_Rewrite $router
         */
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $router->addRoute('ebay',
                new Zend_Controller_Router_Route('ebay/test/:page',
                    array(
                        'controller' => 'index',
                        'action'     => 'test',
                        'module'     => 'ebay',
                        'page'       => 1
                    )
                )
        );

    }

}