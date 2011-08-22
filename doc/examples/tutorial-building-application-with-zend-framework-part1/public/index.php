<?php

/**
 * Точка входа
 *
 * Файл на который перенаправляются все запросы к сайту, подключает ядро сайта и запускает приложение
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */

// Подключаем файл настроек
require '../application/settings/config.php';

// Создаем строку путей
$paths = implode(PATH_SEPARATOR, 
    array(
        $config['path']['library'], 
        $config['path']['models'], 
        $config['path']['system']
    ));

// Устанавливаем пути по которым происходит поиск подключаемых файлов, это папка библиотек, моделей и системных файлов
set_include_path($paths);

// Подключение главного системного класса
require 'Bootstrap.php';

// Запуск приложения
$bootstrap = new Bootstrap();
$bootstrap->run($config);