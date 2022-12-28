<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php $oldUserId = array(); ?>
        <?php foreach ($userData as $user): ?>
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
                                class="btn btn-primary">Visit page</a>
                            <?php endif;?>
                           
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-2"></div>