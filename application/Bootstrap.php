<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

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

}