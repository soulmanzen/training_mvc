<table class="table table-striped">
    <thead>
    <tr>
        <th>Id</th>
        <th>Alias</th>
        <th>Title</th>
        <th>Content</th>
        <th>Is Published</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['pages'] as $page) : ?>
        <tr>
            <td><?php echo $page['id']; ?></td>
            <td><?php echo $page['alias']; ?></td>
            <td><?php echo $page['title']; ?></td>
            <td><?php echo $page['content']; ?></td>
            <td><?php echo $page['is_published'] == 1 ? 'yes' : 'no'; ?></td>
            <td>
                <a href="/admin/pages/edit/<?php echo $page['id']; ?>">
                    <button class="btn btn-sm btn-primary">edit</button>
                </a>
                <a href="/admin/pages/delete/<?php echo $page['id']; ?>" onclick="return confirmDelete();">
                    <button class="btn btn-sm btn-warning">delete</button>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="bs-example">
    <ul class="pagination">
        <?php
        foreach ($data['pagilinks'] as $link) {
            echo '<li><a href = "#" class="pagination" data-page= "'.$link.'" title = "Next" >' . $link . '</a ></li>';
        }
        ?>
    </ul>
</div>