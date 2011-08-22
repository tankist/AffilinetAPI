<?php echo $this->doctype(Zend_View_Helper_Doctype::XHTML1_TRANSITIONAL); ?>
<html>
 <head>
  <?php echo $this->headTitle('I LOVE ZEND FRAMEWORK!'); ?>
  <?php echo $this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8'); ?>
  <?php echo $this->headLink()->appendStylesheet($this->baseUrl . 'design/css/style.css'); ?>
  <?php echo $this->headScript(); ?>
</head>
<body>
    <div id="menu">
        <?php echo $this->partial('menu.tpl'); ?>
    </div>
    <div id="main">
        <div id="left">
            <div style = "margin:5px;">Лучшие статьи:</div>
            <?php echo $this->action('index', 'articles'); ?>
            <div id = "copy">(c) San <a href = "http://zendframework.ru">http://zendframework.ru</a></div>
        </div>
        <div id="content"><?php echo $this->layout()->content; ?></div>
    </div>
</body>
</html>