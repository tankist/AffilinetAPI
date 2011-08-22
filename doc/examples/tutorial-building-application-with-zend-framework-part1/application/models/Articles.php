<?php

/**
 * Articles
 * 
 * Работа с статьями
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class Articles extends Zend_Db_Table_Abstract 
{

    /**
     * Имя таблицы
     * @var string 
     */        
    protected $_name = 'articles';
    
    /**
     * Получить все статьи или одну
     *
     * @param int $articleId Идентификатор статьи
     * @return array
     */
    public function getArticles($articleId = null) 
    {

        // Создаем объект Zend_Db_Select
        $select = $this->getAdapter()->select()
            // Таблица из которой делается выборка
            ->from($this->_name)
            // Добавление таблицы с помощью join, указывается поле связи
            ->join('users', 'users.id = articles.author_id', array('name'))
            // Порядок сортировки
            ->order('id DESC')
            // Количество возвращаемых записей
            ->limit(2)
            ;

        if (!is_null($articleId)) {
            
            // Условие на выборку
            $select->where("articles.id = ?", $articleId); 
            // Выполнение запроса
            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде объекта, по умолчанию в виде ассоциативного массива
            $result = $stmt->fetch(Zend_Db::FETCH_OBJ);


        }
        else {

            $stmt = $this->getAdapter()->query($select);
            // Получение данных в виде массива объектов, по умолчанию в виде массива ассоциативных массивов
            $result = $stmt->fetchAll(Zend_Db::FETCH_OBJ);    

        }

        return $result;

    }

}