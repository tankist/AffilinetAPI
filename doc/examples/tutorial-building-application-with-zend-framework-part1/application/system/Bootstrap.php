<?php

require 'Zend/Loader.php';

/**
 * Bootstrap
 * 
 * Главный системный класс, используется для настройки и запуска приложения
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Bootstrap 
{
    /**
     * Объект конфигурации
     *
     * @var Zend_Config
     */
    private $_config = null;

    /**
     * Запуск приложения
     *
     * @var array $config Конфигурация
     */
    public function run($config) 
    {
        try {
            // Настройка загрузчика
            $this->setLoader();
                        
            // Настройка конфигурации
            $this->setConfig($config);

            // Настройка Вида
            $this->setView();
            
            // Подключение к базе данных
            $this->setDbAdapter();

            // Подключение маршрутизации
            $router = $this->setRouter();
            
            // Создание объекта front контроллера 
            $front = Zend_Controller_Front::getInstance();

            // Настройка front контроллера, указание базового URL, правил маршрутизации 
            $front->setBaseUrl($this->_config->url->base)
                  ->throwexceptions(true)
                  ->setRouter($router);

            // Запуск приложения, в качестве параметра передаем путь к папке с контроллерами
            Zend_Controller_Front::run($this->_config->path->controllers);

        } 
        catch (Exception $e) {
            // Перехват исключений 
            Error::catchException($e);
        }
    }
    
    /**
     * Настройка загрузчика
     */
    public function setLoader() 
    {
        // Запуск автозагрузки
        Zend_Loader::registerAutoload();
    }

    /**
     * Настройка конфигурации
     * 
     * @param array $config Настройки
     */
    public function setConfig($config)
    {
        $config = new Zend_Config($config);
        $this->_config = $config;
        Zend_Registry::set('config', $config);
    } 
    
    /**
     * Настройка вида
     */    
    public function setView() 
    {
        // Инициализация Zend_Layout, настройка пути к макетам, а также имени главного макета.
        // Параметр layout указан лишь для примера, по умолчанию имя макета именно "layout"
        Zend_Layout::startMvc(array(
            'layoutPath' => $this->_config->path->layouts,
            'layout' => 'layout',
        ));

        // Получение объекта Zend_Layout
        $layout = Zend_Layout::getMvcInstance();

        // Инициализация объекта Zend_View
        $view = $layout->getView();

        // Настройка расширения макетов
        $layout->setViewSuffix('tpl');

        // Задание базового URL
        $view->baseUrl = $this->_config->url->base;

        // Задание пути для view части
        $view->setBasePath($this->_config->path->views);

        // Установка объекта Zend_View
        $layout->setView($view);

        // Настройка расширения view скриптов с помощью Action помошников
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer
            ->setView($view)
            ->setViewSuffix('tpl');

        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }
            
    /**
     * Установка соединения с базой данных и помещение его объекта в реестр.
     */
    public function setDbAdapter() 
    {
        // Подключение к БД, так как Zend_Db "понимает" Zend_Config, нам достаточно передать специально сформированный объект конфигурации в метод factory
        $db = Zend_Db::factory($this->_config->db);
        
        // Задание адаптера по умолчанию для наследников класса Zend_Db_Table_Abstract 
        Zend_Db_Table_Abstract::setDefaultAdapter($db);    

        // Занесение объекта соединения c БД в реестр
        Zend_Registry::set('db', $db);
    }

    /**
     * Настройка маршрутов
     */
    public function setRouter() 
    {
        // Подключение файла правил маршрутизации
        require($this->_config->path->system . 'routes.php');

        // Если переменная router не является объектом Zend_Controller_Router_Abstract, выбрасываем исключение
        if (!($router instanceof Zend_Controller_Router_Abstract)) {
            throw new Exception('Incorrect config file: routes');
        }
        
        return $router;
    }
        
}