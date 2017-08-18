<h3>Pages</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Updated</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($data['pages'] as $page) : ?>
    <tr>
        <td><?php echo $page['id']; ?></td>
        <td><?php echo $page['message']; ?></td>
        <td><?php echo $page['updated']; ?></td>
        <td>
            <a href="/admin/notifications/delete/<?php echo $page['id']; ?>" onclick="return confirmDelete();">
                <button class="btn btn-sm btn-warning">delete</button>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>