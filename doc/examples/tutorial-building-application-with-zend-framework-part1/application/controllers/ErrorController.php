<?php

/**
 * ErrorController
 * 
 * Обработчик ошибок
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class ErrorController extends Zend_Controller_Action 
{

    /**
     * Обработка ошибки 404 либо 500
     */
    public function errorAction() 
    {

        $errors = $this->_getParam('error_handler');

        switch ($errors->type) {

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // Ошибка 404 - не найден контроллер или действие
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                $errorMsg = 'HTTP/1.1 404 Not Found';
                break;
            default:
                // Ошибка приложения
                $errorMsg = "System error! Please try later!";
                break;

        }

        // Удаление добавленного ранее содержимого
        $this->getResponse()->clearBody();

        $this->view->content = $errorMsg;

    }

}

