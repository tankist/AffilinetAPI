<?php

class Ebay_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initEbayRoutes()
    {
        $this->bootstrap('frontController');

        /**
         * @var Zend_Controller_Router_Rewrite $router
         */
        $router = $this->getResource('frontController')->getRouter();

        $router->addRoute('ebay',
                          new Zend_Controller_Router_Route('ebay/testebay/:page',
                              array('controller' => 'index', 'action' => 'testebay', 'module' => 'ebay', 'page' => 1))
        );

        $router->addRoute('shoppingcom',
                          new Zend_Controller_Router_Route('ebay/shoppingcom/:page',
                              array('controller' => 'index', 'action' => 'testShoppingCom', 'module' => 'ebay', 'page' => 1))
        );
    }

}