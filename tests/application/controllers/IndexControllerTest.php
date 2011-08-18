<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $action = 'index';
        $controller = 'index';
        $module = 'default';

        $urlParams = $this->urlizeOptions(array(
            'action' => $action,
            'controller' => $controller,
            'module' => $module
        ));

        $url = $this->url($urlParams);

        $this->dispatch($url);

        $this->assertModule($module);
        $this->assertController($controller);
        $this->assertAction($action);
    }

}

