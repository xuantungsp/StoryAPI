<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($post) ? $post["title"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'title')); ?>

		</div>
		
		<div class="form-group">
			<?php echo Form::label('Content', 'content', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('content', Input::post('content', isset($post) ? $post["content"] : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'content')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Story id', 'story_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('story_id', Input::post('story_id', isset($post) ? $post["story_id"] : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'story_id')); ?>

		</div>
            
            
            
            
            
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>