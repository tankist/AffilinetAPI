<?php

/**
 * Pages
 * 
 * Работа с страницами
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Pages extends Zend_Db_Table_Abstract 
{
    /**
     * Имя таблицы
     * @var string 
     */  
    protected $_name = 'pages';

    /**
     * Получить одну страницу
     *
     * @param int $pageId Идентификатор страницы
     * @return array
     */
    public function getPage($pageId) 
    {
        // Создание объекта Zend_Db_Table_Select, 
        // Нам не нужно указывать название таблицы как в Zend_Db_Select
        $select = $this->select()
            // Накладываем условие
            ->where('id = ?', $pageId);
        
        // Выполняем запрос и получаем объект Zend_Db_Table_Row в результате 
        // Нам не нужно предварительно выполнять запрос методом query, как в Zend_Db_Select
        $result = $this->fetchRow($select);

        return $result;
    }
}