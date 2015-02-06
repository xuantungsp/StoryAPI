<h2>Recent Posts</h2>
<?php foreach ($posts as $p): ?>
    <h3><?php echo Html::anchor('blog/view/'.$p->slug, $p->title); ?></h3>
    <p><?php echo $p->summary; ?></p>
<?php endforeach; ?>




