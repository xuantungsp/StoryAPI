<h2>Danh sách Chap</h2>
<br>
<?php if ($posts): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>

                <th>Content</th>
                <th>Story id</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $item): ?>		<tr>

                    <td><?php echo $item->title; ?></td>

                    <td style="
                        width: 800px;
                        "><?php echo $item->content; ?></td>
                    <td><?php echo $item->story_id; ?></td>
                    <td>
                        <?php echo Html::anchor('admin/posts/view/' . $item->id, 'View'); ?> |
                        <?php echo Html::anchor('admin/posts/edit/' . $item->id, 'Edit'); ?> |
                        <?php echo Html::anchor('admin/posts/delete/' . $item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

                    </td>
                </tr>
            <?php endforeach; ?>	</tbody>
    </table>

<?php else: ?>
    <p>No Chap.</p>

<?php endif; ?>
<p>
    <?php $pagi = Pagination::instance('paginate'); ?>
    <?php echo $pagi->render(); ?>
</p>
<p>
    <?php echo Html::anchor('admin/posts/create', 'Add new chap', array('class' => 'btn btn-success')); ?>

</p>
