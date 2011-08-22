<?php
/**
 * Конфигурационный файл
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */

// Физический путь к корню сайта
$root=dirname(__FILE__);
$root .= '/../../';

// Физический путь к document_root
$rootPublic = $root . 'public/';

// Базовый URL.
// Если вы хотите положить сайт в отдельную папку а не в корень виртуального хоста, этот параметр необходимо  изменить на /dir_name/
$baseUrl = '/';

// Масив настроек
$config = array (
    // Настройки соединения с БД
    'db'    => array (
        // Адаптер    
        'adapter'   => 'PDO_MYSQL',
        // Параметры
        'params'    => array( 
            // Сервер БД
            'host'          => 'localhost',
            // Имя пользователя 
            'username'      => 'root',
            // Пароль пользователя
            'password'      => 'root',
            // Имя базы
            'dbname'        => 'ilovezf',
            // Опции драйвера
            'driver_options'=> array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'),
            // Профайлер БД
            'profiler'      => false,
        ),
    ),
    // Настройки URL адресов
    'url'   => array (
         // Базовый URL
         'base'         => $baseUrl,
         // Адрес папки где собраны открытые для доступа из вне файлы
         'public'       => $baseUrl . 'public',
         // Адрес папки где лежат графические изображения для дизайна
         'img'          => $baseUrl . 'img',
         // Адрес папки где лежат css файлы
         'css'          => $baseUrl . 'css',
     ),
    // Физические пути
    'path'  => array (
        // Физический путь к корню сайта
        'root'         => $root,
        // Путь к приложениям
        'application'  => $root . 'application/',
        // Путь к библиотекам
        'library'      => $root . 'library/',
        // Путь к моделям
        'models'       => $root . 'application/models/',
        // Путь к контроллерам
        'controllers'  => $root . 'application/controllers/',
        // Путь к видам
        'views'        => $root . 'application/views/',
        // Путь к layouts
        'layouts'      => $root . 'application/views/scripts/',
        // Путь к системным файлам
        'system'       => $root . 'application/system/',
        // Путь к конфигурационным файлам
        'settings'     => $root . 'application/settings/',
     ),
    // Общие настройки
    'common' => array (
         // Кодировка сайта
         'charset'      => 'utf-8',
     ),
     // Настройки дебага
    'debug' => array (
         // Статус дебага, включен или нет
         'on'           => true,
     ),
);

// Настройки локали
date_default_timezone_set("Europe/Kiev");
