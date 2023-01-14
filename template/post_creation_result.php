<?php if(count($errMsgs) == 0): ?>
    <h2><?php echo $lang["createPost_success"];?><h2>
<?php else: ?>
    <h2><?php echo $lang["createPost_error"]; ?></h2>
    <div class="text-danger">
        <?php foreach($errMsgs as $err): ?>
            <p><?php echo htmlspecialchars($err);?></p>
        <?php endforeach; ?>
    </div>
<?php endif;?>