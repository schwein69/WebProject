<?php $oldPostId = array();?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php foreach ($posts as $post): ?>
        <article class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-header">
                    <div class="row mt-2">
                        <div class="col-4"><a href="../src/profile.php?idUtente=<?php echo $post["idUtente"]?>"> <img class="img-fluid avatar" src="<?php echo UPLOAD_DIR.$post["idUtente"]."/profile.".$post["formatoFotoProfilo"] ?>"
                                alt="foto profilo di <?php echo $post["username"] ?>" /></a>
                        </div>
                        <div class="col-4">
                            <h2 style="font-size: 2vw">
                                <?php echo $post["username"] ?>
                            </h2>
                        </div>
                        <div class="col-4"> 
                        <?php $post["followedByMe"] = $dbh->isFollowedByMe($post["idUtente"],$_SESSION["idUtente"]); ?>
                            <button type="button" id="follower<?php echo $post["idUtente"] ?>" class="btn btn-primary" style="box-shadow: none;">
                                <?php echo $post["followedByMe"]  ? "seguito" :  "segui" ?>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="card-text">
                        <?php echo $post["testo"] ?>
                    </p>
                    <p class="card-text"><small class="text-muted">
                            <?php echo $post["dataPost"] ?>
                        </small></p>

                    <?php $immaginiPost = $dbh->getPostContents($post["idPost"]) ?>
                    <?php $active = true; ?>

                    <?php if (count($immaginiPost) > 1): ?>

                    <div id="carousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">

                            <?php foreach ($immaginiPost as $immagine): ?>
                            <?php if ($active) {
                        echo "<div class='carousel-item active'>";
                        $active = false;
                    } else {
                        echo "<div class='carousel-item'>";
                    } ?>
                            <img class="card-img-bottom my-2 mx-auto" src="<?php echo $immagine["nomeImmagine"] ?>"
                                alt="<?php echo $immagine["descrizione"] ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark"></span>
                    </a>
                    <a class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark"></span>
                    </a>
                </div>
                <?php elseif(count($immaginiPost) == 1): ?>
                <img class="card-img-bottom my-2 mx-auto" src="<?php echo $immaginiPost[0]["nomeImmagine"] ?>"
                    alt="<?php echo $immaginiPost[0]["descrizione"] ?>" />
                <?php endif; ?>

                <a href="#" value="<?php echo $post["idPost"] ?>" class="btn btn-primary ms-auto"
                    style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <?php 
            $post["liked"] = $dbh->isPostLiked($_SESSION["idUtente"], $post["idPost"]);
            ?>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" id="like<?php echo $post["idPost"] ?>" class="btn btn-light">
                            <img src="<?php echo $post["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>"
                                alt="Like post" />
                        </button>
                        <span>
                            <?php if ($post['numLike'] > 0) {
                echo $post['numLike'];
            } ?>
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" id="chat<?php echo $post["idPost"] ?>"
                            class="btn btn-light">
                            <img src="../imgs/icons/chat.svg" alt="Commenta post" /></button></li>
                    <li class="nav-item mx-2"> <button type="button" id="save<?php echo $post["idPost"] ?>"
                            class="btn btn-light">
                            <img src="../imgs/icons/star.svg" alt="Salva post" /></button></li>
                </ul>
            </div>
    </div>
    </article>
    <?php array_push($oldPostId,$post["idPost"]);?>
    <?php endforeach; ?>
</div>
<div class="col-md-2"></div>
</div>
<script>
const oldId = <?php echo json_encode($oldPostId)?>;
</script>