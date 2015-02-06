<h2>Danh sách Story</h2>
<br>
<?php if ($story): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Number View</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($story as $item): ?>		
                <tr>
                    <td><?php echo Html::img('files/' . $item->image, array("alt" => $item->title, 'width' => "150px")); ?></td>
                    <td><?php echo $item->title; ?></td>
                    <td><?php echo $item->number_view; ?></td>
                    <td>
                        <?php echo Html::anchor('admin/story/edit/' . $item->id, 'Edit'); ?> |
                        <?php echo Html::anchor('admin/story/delete/' . $item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
                    </td>
                </tr>
            <?php endforeach; ?>	
         
        </tbody>
    </table>

<?php else: ?>
    <p>No Story.</p>

<?php endif; ?><p>
       <?php $pagi = Pagination::instance('paginate'); ?>
            <?php echo $pagi->render(); ?>
</p>
<p>
    <?php echo Html::anchor('admin/story/create', 'Add new Post', array('class' => 'btn btn-success')); ?>
</p>
