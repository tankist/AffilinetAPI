<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initModule()
    {
        $loader = new Zend_Application_Module_Autoloader(array(
                'namespace' => '',
                'basePath' => APPLICATION_PATH,
            ));
        return $loader;
    }

    protected function _initCache()
    {
        $this->bootstrap('cachemanager');
        /**
         * @var Zend_Cache_Manager $cacheManager
         */
        $cacheManager = $this->getResource('cachemanager');
        if ($cacheManager->hasCache('affilinet')) {
            ZendX_Service_Affilinet_Abstract::setCache($cacheManager->getCache('affilinet'));
        }
    }

    protected function _initPaginator()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator.phtml');
    }

    protected function _initRoutes()
    {
        $this->bootstrap('frontController');
        /**
         * @var Zend_Controller_Front $front
         */
        $front = $this->getResource('frontController');
        $front->getRouter()->addDefaultRoutes();
    }

}