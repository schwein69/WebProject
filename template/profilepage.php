<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <section class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mx-2">
                            <figure class="figure m-2">
                                <img class="figure-img img-fluid avatar"
                                    src="<?php echo UPLOAD_DIR . $userData["idUtente"] . "/profile.png" ?>"
                                    alt="foto profilo di <?php echo $userData["username"] ?>" />
                                <figcaption class="figure-caption">
                                    <?php echo $userData["username"] ?>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="nav-item mt-2">
                            <span class="bi bi-folder-fill"></span>
                            <br>Posts<br>
                            <?php echo $numPosts ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-person-heart"></span>
                            <a href="followerList.php<?php echo $userData["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $userData["idUtente"] : "" ?>"
                                class="profileLink"><br>Seguiti<br></a>
                            <?php echo $numFollower ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-people-fill"></span>
                            <a href="followedList.php<?php echo $userData["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $userData["idUtente"] : "" ?>"
                                class="profileLink"><br>Seguaci<br></a>
                            <?php echo $numFollowed ?>
                        </li>
                    </ul>
                    <p class="card-text">
                        <?php echo $userData["descrizione"] ?>
                    </p>
                    <?php if(isset($_GET["idUtente"])) : ?>
                    <p class="card-text">
                        <?php $userData["followedByMe"] = $dbh->isFollowedByMe($userData["idUtente"], $_SESSION["idUtente"]); ?>
                        <button type="button" id="follower<?php echo $userData["idUtente"] ?>" class="btn btn-primary"
                            style="box-shadow: none;">
                            <?php echo $userData["followedByMe"] ? "seguito" : "segui" ?>
                        </button>
                    </p>
                    <?php endif ;?>
                </div>
            </div>
        </section>

        <?php foreach ($posts as $post): ?>
        <article class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">

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
                <?php elseif (count($immaginiPost) == 1): ?>

                <img class="card-img-bottom my-2 mx-auto" src="<?php echo $immaginiPost[0]["nomeImmagine"] ?>"
                    alt="<?php echo $immaginiPost[0]["descrizione"] ?>" />
                <?php endif; ?>


                <a href="post.php?postid=<?php echo $post["idPost"] ?>" value="<?php echo $post["idPost"] ?>"
                    class="btn btn-primary ms-auto" style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <?php
        $post["liked"] = $dbh->isPostLiked($_SESSION["idUtente"], $post["idPost"]);
        ?>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2"> <button type="button" id="like<?php echo $post["idPost"] ?>"
                            class="btn btn-light">
                            <img src="<?php echo $post["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>"
                                alt="Like post" />
                        </button>
                        <span>
                            <?php if ($post['numLike'] > 0) {
            echo $post['numLike'];
        } ?>
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" class="btn btn-light"><img
                                src="../imgs/icons/chat.svg" alt="Commenta post" /></button></li>
                    <li class="nav-item mx-2"> <button type="button" class="btn btn-light"><img
                                src="../imgs/icons/star.svg" alt="Salva post" /></button></li>
                </ul>
            </div>
    </div>
    </article>
    <?php endforeach; ?>
</div>

<div class="col-md-2"></div>
</div>