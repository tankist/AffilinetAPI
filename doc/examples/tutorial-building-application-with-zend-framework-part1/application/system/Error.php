<?php

/**
 * Error
 * 
 * Ручной обработчик ошибок
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Error 
{

    /**
     * Управление ошибками
     *
     * @param exception $exception Перехватываемое исключение
     */
    public static function catchException(Exception $exception) 
    {

        // Получение текста ошибки
        $message = $exception->getMessage();
        // Получение трейса ошибки как строки
        $trace = $exception->getTraceAsString();
        $str = 'ERROR: ' . $message . "\n" . $trace;

        $config = Zend_Registry::get('config');

        // Если включен режим отладки отображаем сообщение о ошибке на экран
        if($config->debug->on) {
            Zend_Debug::dump($str);
        } 
        // Иначе выводим сообщение об ошибке 
        else {
            // Здесь может происходить логирование ошибки, уведомление вебмастера и т д
            die('System error! Please try later');
        }
    }
}