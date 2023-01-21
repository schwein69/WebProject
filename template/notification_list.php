<div class="row row col-12 col-md-8 mx-auto">
    <?php if($templateParams["numNotifications"] > 0): ?>
        <ul class="list-group">
        <?php foreach($templateParams["notifications"] as $notif):?>
        <li class="list-group-item"> 
        <div class="row">
        <div class="col-3">
        <a href="profile.php?idUtente=<?php echo $notif["idUtenteNotificante"];?>">
        <img class="img-fluid avatar chatAvatar" src="<?php echo $notif["fotoProfilo"];?>" alt="<?php echo getProfilePicAlt($notif["username"]);?>"/>
        </a>
        </div>
        <div class="my-auto col-9">
        <p>
            <a href="<?php echo isPostNotification($notif["nomeTipo"]) ?
                            "post.php?postid=".$notif["idPostRiferimento"]
                            : "profile.php?idUtente=".$notif["idUtenteNotificante"];?>">
                <?php echo $notif["username"].$lang["notification_".$notif["nomeTipo"]];?>
            </a>
        </p>
        <p class="text-end small"><?php echo $notif["notifTimestamp"];?></p>
        </div>
        </div>
        </li>
        <?php endforeach;?>
        </ul>
    <?php else: ?>
        <p><?php echo $lang["notification_noNotif"];?></p>
    <?php endif; ?>
</div>