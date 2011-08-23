<?php

class AdSense_Bootstrap extends Zend_Application_Module_Bootstrap
{

    protected function _initAdSenseRoutes()
    {
        $this->bootstrap('frontController');

        /**
         * @var Zend_Controller_Router_Rewrite $router
         */
        $router = Zend_Controller_Front::getInstance()->getRouter();

        $router->addRoute('adsense',
                new Zend_Controller_Router_Route('adsense/test/:page',
                    array(
                        'controller' => 'index',
                        'action'     => 'test',
                        'module'     => 'adsense',
                        'page'       => 1
                    )
                )
        );
    }

}