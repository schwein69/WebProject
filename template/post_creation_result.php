<h2><?php echo $templateParams["pageHeader"];?></h2>
<div class="text-danger">
    <?php foreach($errMsgs as $err): ?>
        <p><?php echo htmlspecialchars($err);?></p>
    <?php endforeach; ?>
</div>
