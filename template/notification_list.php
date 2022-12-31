<!-- TODO infinite scroll (?) -->

<div class="row row col-12 col-md-8 mx-auto">
    <?php if($templateParams["numNotifications"] > 0): ?>
        <ul class="list-group">
        <?php foreach($templateParams["notifications"] as $notif):?>
        <li class="list-group-item"> 
        <a href="profile.php?idutente=<?php echo $notif["idUtenteNotificante"];?>">
        <img class="notificationAvatar" src="<?php echo $notif["fotoProfilo"];?>" alt="<?php echo getProfilePicAlt($notif["username"]);?>"/>
        </a>
        <p>
            <a href="<?php echo isPostNotification($notif["nomeTipo"]) ?
                            "post.php?postid=".$notif["idPostRiferimento"]
                            : "profile.php?idutente=".$notif["idUtenteNotificante"];?>">
                <?php echo $notif["username"].$lang["notification_".$notif["nomeTipo"]];?>
            </a>
        </p>
        </li>
        <?php endforeach;?>
        </ul>
    <?php else: ?>
        <p><?php echo $lang["notification_noNotif"];?></p>
    <?php endif; ?>
</div>