<?php

/**
 * ArticlesController
 * 
 * Работа с статьями
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */
class ArticlesController extends Zend_Controller_Action 
{
    /**
     * Список статей
     */
    public function indexAction() 
    {
        $modelArticles = new Articles();
        $articles = $modelArticles->getArticles();
        $this->view->articles = $articles;
    }

    /**
     * Выбранная статья
     */    
    public function viewAction() 
    {
        // Получение параметра пришедшего от пользователя
        $articleId = $this->_getParam('articleId');

        // Создание объекта модели, благодаря autoload нам нет необходимости подключать класс через require
        $modelArticles = new Articles();

        // Выполнения метода модели по получению информации о статье
        $article = $modelArticles->getArticles($articleId);
        
        // Определение переменных для вида
        $this->view->article = $article;
    }
}
