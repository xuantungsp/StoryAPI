<h2>Viewing #<?php echo $post->id; ?></h2>
<p>
	<strong>Title:</strong>
	<?php echo $post['title'] ?></p>
	<strong>Content:</strong>
	<?php echo $post['content'] ?></p>
<p>
	<strong>Story id:</strong>
	<?php echo $post['story_id'] ?></p>

<?php echo Html::anchor('admin/posts/edit/'.$post->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/posts', 'Back'); ?>