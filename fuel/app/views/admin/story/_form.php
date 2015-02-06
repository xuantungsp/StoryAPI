<?php echo Form::open(array("class"=>"form-horizontal", 'enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <div class="form-group">
                <?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>
            <?php echo Form::input('title', Input::post('title', isset($post) ? $post["title"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Image', 'image', array('class'=>'control-label')); ?><p></p>
            <?php if(isset($post)): echo Html::img("files/".$post["image"], array("width"=>"150px", "alt" => $post["title"])); endif; ?>
            <?php echo Form::file('file_name', array('class' => 'col-md-8 form-control')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		
        </div>
    </fieldset>
<?php echo Form::close(); ?>