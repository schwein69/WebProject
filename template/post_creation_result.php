<?php if(count($errMsgs) == 0): ?>
    <h2>Il post è stato caricato con successo!<h2>
<?php else: ?>
    <h2>Il post è stato creato ma sono stati riscontrati alcuni problemi</h2>
    <div class="text-danger">
        <?php foreach($errMsgs as $err): ?>
            <p><?php echo $err;?></p>
        <?php endforeach; ?>
    </div>
<?php endif;?>