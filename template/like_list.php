<?php foreach ($templateParams["likes"] as $user): ?>
<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <div class="card col-12 mx-auto">
            <div class="row g-0">
                <div class="col-4 my-auto">
                    <img src="<?php echo UPLOAD_DIR.$user["idUtente"]."/profile.".$user["formatoFotoProfilo"] ?>" class="img-fluid avatar"
                        alt="<?php echo getProfilePicAlt($user["username"]); ?>"/>
                </div>
                <div class="col-8 my-auto">
                    <div class="card-body">
                        <h2 class="card-title">
                            <?php echo $user["username"] ?>
                        </h2>
                        <p class="card-text">
                            <?php if($user["idUtente"] != $_SESSION["idUtente"]):?>
                            <a href="../src/profile.php?idUtente=<?php echo $user["idUtente"] ?>"
                                class="btn"><?php echo $lang["VisitPage"]?></a>
                            <?php endif;?>
                           
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<?php endforeach; ?>
