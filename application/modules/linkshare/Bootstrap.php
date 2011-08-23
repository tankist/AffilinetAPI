<?php

class Linkshare_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initLinkshareRoutes()
    {
        $this->bootstrap('frontController');

        /**
         * @var Zend_Controller_Router_Rewrite $router
         */
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $router->addRoute('linkshare',
                new Zend_Controller_Router_Route('linkshare/test/:page',
                    array(
                        'controller' => 'index',
                        'action'     => 'test',
                        'module'     => 'linkshare',
                        'page'       => 1
                    )
                )
        );
    }

}