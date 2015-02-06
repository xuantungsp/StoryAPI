<h2><?php echo $post->title ?></h2>
 
<p>
    <strong>Posted: </strong><?php echo date('nS F, Y', $post->created_at) ?> (<?php echo Date::time_ago($post->created_at)?>)
    by <?php echo $post->user->username ?>
</p>
 
<p><?php echo nl2br($post->body) ?></p>

<hr />
<h3 id="comments">Comments</h3>
<?php foreach($post->comments as $comment): ?>
<p><?php echo Html::anchor($comment->website, $comment->name) ?> said "<?php echo $comment->message; ?>" </p>
<?php endforeach; ?>

<h3>Write Comment</h3>
<fieldset>
    <?php echo Form::open(array("class"=>"form-horizontal", 'action' => 'blog/comment/'.$post->slug));?>
    <div class="form-group">
        <?php echo Form::label('Name', 'name', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10"><?php echo Form::input('name', '', array('class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <?php echo Form::label('Website', 'website', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10"><?php echo Form::input('website', '', array('class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <?php echo Form::label('Email', 'email', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10"><?php echo Form::input('email', '', array('class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <?php echo Form::label('Comment', 'comment', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10"><?php echo Form::textarea('message', '', array('class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10"><?php echo Form::submit('submit', 'Comment', array('class' => 'btn btn-primary')) ?></div>
    </div>
    <?php echo Form::close(); ?>
</fieldset>
