<h3>New User</h3>
<br>
<form action="" method="post" style="width:400px">
    <input class="form-control" name="login" placeholder="Login" value="<?php echo $_POST['login'] ?? ''?>"><br>
    <input class="form-control" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ''?>"><br>
    <input class="form-control" name="password" placeholder="Password" value=""><br>
    <input class="form-control" name="password2" placeholder="Repeat password" value=""><br>
    <input type="submit" value="Save" class="btn btn-sm btn-success">
</form>