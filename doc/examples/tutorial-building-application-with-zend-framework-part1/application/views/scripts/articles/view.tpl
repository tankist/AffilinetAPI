<div id = "block">
    <div id = "title">
        <b><?php echo $this->article->title ?></b>
    </div>
    <div id = "title">
        <b>Добавил: <?php echo $this->article->name ?></b>
    </div>
    <div id = "text">
        <?php echo nl2br($this->article->text) ?>
    </div>
</div>