<div class="starter-template">
    <?php if (!empty($data['errors'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($data['errors'] as $error) {
            echo $error . '<br>';
        }
        ?>
    </div>
    <?php else : ?>
    <div class="alert alert-success" role="alert">
    <?php echo $data['message']; ?>
    </div>
    <?php endif; ?>
</div>