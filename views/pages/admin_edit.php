<h3>Page Edit</h3>
<br>
<form action="" method="post" style="width:400px">
    <input class="form-control" type="hidden" name="id" value="<?php echo $data['page']['id']; ?>">
    <input class="form-control" name="alias" placeholder="Alias" value="<?php echo $data['page']['alias']; ?>"><br>
    <input class="form-control" name="title" placeholder="Title" value="<?php echo $data['page']['title']; ?>"><br>
    <textarea class="form-control" name="content" placeholder="Content"><?php echo $data['page']['content']; ?></textarea><br>
    <div style="float: right" class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="is_published" value="1" <?php echo $data['page']['is_published'] == 1 ? 'checked' : ''?>>
            is_published?
        </label>
    </div>
    <input type="submit" value="Save" class="btn btn-sm btn-success">
</form>