<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php foreach ($posts as $post): ?>
        <article class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-header">
                    <div class="row mt-2">
                        <div class="col-4"> <img class="img-fluid avatar" src="<?php echo $post["fotoProfilo"] ?>"
                                alt="foto profilo di <?php echo $post["username"] ?>" />
                        </div>
                        <div class="col-4">
                            <h2 style="font-size: 2vw">
                                <?php echo $post["username"] ?>
                            </h2>
                        </div>
                        <div class="col-4"> <button value="<?php echo $post["idUtente"] ?>" type="button"
                                class="btn btn-light btn-md border border-dark" style="box-shadow: none;">Segui</button>
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

                    <?php if (count($immaginiPost) != 1): ?>

                    <div id="carousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">

                            <?php foreach ($immaginiPost as $immagine): ?>
                            <?php if ($active) {
                        echo "<div class='carousel-item active'>";
                        $active = false;
                    } else {
                        echo "<div class='carousel-item'>";
                    } ?>
                            <img class="card-img-bottom my-2 mx-auto" src="<?php echo $immagine["percorso"] ?>"
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
                <?php else: ?>

                <img class="card-img-bottom my-2 mx-auto" src="<?php echo $immaginiPost[0]["percorso"] ?>"
                    alt="<?php echo $immaginiPost[0]["descrizione"] ?>" />
                <?php endif; ?>


                <a href="#" value="<?php echo $post["idPost"] ?>" class="btn btn-primary ms-auto"
                    style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <?php $post_data = $dbh->getPostData($post["idPost"]);
            $post_data["liked"] = $dbh->isPostLiked($_SESSION["idUtente"], $post["idPost"]);
            ?>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" id="like<?php echo $post["idPost"] ?>" class="btn btn-light">
                            <img src="<?php echo $post_data["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>"
                                alt="Like post" />
                        </button>
                        <span>
                            <?php if ($post_data['numLike'] > 0) {
                echo $post_data['numLike'];
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
    <?php endforeach; ?>
</div>
<div class="col-md-2"></div>
</div>

<script>
    const btns = document.querySelectorAll('button[id^=like]')
    btns.forEach(btn => {
        btn.addEventListener('click', like);
    });
</script>