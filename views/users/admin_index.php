<h3>Users</h3>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Login</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($data['users'] as $user) : ?>
    <tr>
        <td><?php echo $user['login']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
            <a href="/admin/users/edit/<?php echo $user['id']; ?>">
                <button class="btn btn-sm btn-primary">edit</button>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<br>
<a href="/admin/users/add">
    <button class="btn btn-sm btn-success">New User</button>
</a>
