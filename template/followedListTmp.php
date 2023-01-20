<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <?php $oldUserId = array(); ?>
        <?php foreach ($templateParams["followed"] as $user): ?>
        <div class="card col-12 mx-auto">
            <div class="row g-0">
                <div class="col-4 my-auto">
                    <img src="<?php echo UPLOAD_DIR.$user["idUtente"]."/profile.".$user["formatoFotoProfilo"] ?>" class="img-fluid rounded searchAvatar"
                        alt="foto profilo di <?php echo $user["username"] ?>">
                </div>
                <div class="col-8 my-auto">
                    <div class="card-body">
                        <h2 class="card-title">
                            <?php echo $user["username"] ?>
                        </h2>
                        <p class="card-text">
                            <?php echo $user["descrizione"] ?>
                        </p>
                        <p class="card-text">
                            <?php if($user["idUtente"] != $_SESSION["idUtente"]):?>
                            <a href="../src/profile.php?idUtente=<?php echo $user["idUtente"] ?>"
                                class="btn"><?php echo $lang["VisitPage"]?></a>
                            <?php endif;?>
                            <?php if(!isset($_GET["idUtente"])):?>                              
                            <button type="button" id="follower<?php echo $user["idUtente"] ?>" class="btn">
                            <?php echo $user["followedByMe"]  ? $lang["userFollowed"] :  $lang["userNotFollowed"]; ?>
                            </button>
                            <?php endif;?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>