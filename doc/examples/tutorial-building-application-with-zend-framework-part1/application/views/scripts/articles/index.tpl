<ul>
    <?php foreach ($this->articles as $article): ?>
       <li><a href = "<?php echo $this->url(array('articleId' => $article->id),'articles'); ?>"><?php echo $article->title; ?></a></li>
    <?php endforeach; ?>
</ul>

